<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Store;
use App\Models\Service;
use App\Models\Activity;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class StoreController extends Controller
{
    /**
     * WARNING!: The next class is not optimized. Use it on your own risk. ;)
     */
    private const MAX_RESOLUTION_WIDTH = 1024;
    private const HAS_SIGNATURE_STAMP = true;
    private const MAX_CHAR_MD = 5;
    private const REGEX_VALID_TIME_24_HOURS = '/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/';

    private $store;

    public function __construct(Store $store)
    {
        $this->store = $store;
    }

    public function index() : View
    {
        return view('stores/index');
    }

    public function create() : View
    {
        [$payment_methods, $services, $categories, $allActivities] = $this->getCommonModels();

        return view('stores.edit', compact('payment_methods', 'services', 'categories', 'allActivities'));
    }

    public function store(StoreRequest $request) : RedirectResponse
    {
        $validated = $request->validated();
        $activities = $validated['taggles'];
        $validated['user_id'] = auth()->id();
        $validated['logo_path'] = ($request->has('logo_file') && (!empty($request->file('logo_file'))))
        ? $this->saveResizedImageFile2Disk($request->file('logo_file'), $validated['user_id'])
        : null;

        $validated['location_id'] = $this->getLocationId($validated['postal_code']);
        unset($validated['logo_file'], $validated['taggles']);

        try {
            $newStore = $this->store->create($validated);
            $activityIds = $this->saveTaggles($activities);
            $newStore->activities()->sync($activityIds);
        } catch (Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return redirect()->route('establecimientos.index')->with('message', 'Establecimiento guardado.');
    }

    public function show(int $id) : View
    {
        $store = $this->store->findOrFail($id);
        [$payment_methods, $services, $categories, $allActivities] = $this->getCommonModels();

        return view('stores.edit', compact('store', 'payment_methods', 'services', 'categories', 'allActivities'));
    }

    public function update(StoreRequest $request, int $id) : RedirectResponse
    {
        $validated = $request->validated();
        $activities = $validated['taggles'];
        $validated['user_id'] = auth()->id();
        $store = $this->store->findOrFail($id);
        $validated['logo_path'] = ($request->has('logo_file') && (!empty($request->file('logo_file'))))
        ? $this->saveResizedImageFile2Disk($request->file('logo_file'), $store->id)
        : null;

        $validated['location_id'] = $this->getLocationId($validated['postal_code']);
        unset($validated['logo_file'], $validated['taggles']);

        if ($validated['logo_path'] !== null) {
            $this->delFile($store->logo_path);
        }

        // TODO put inside a transaction
        try {
            $store
            ->fill($validated)
            ->save();
            $activityIds = $this->saveTaggles($activities);
            $store->activities()->sync($activityIds);
        } catch (Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return redirect()->route('establecimientos.index');
    }

    public function destroy(int $id) : RedirectResponse
    {
        $store = $this->store->findOrFail($id);
        $logoPath = $store->logo_path;
        if ($store->delete()) {
            $this->delFile($logoPath);
        }

        return redirect()->back();
    }

    /**
     * Process datatables ajax request.
     */
    public function anyData() : JsonResponse
    {
        return datatables()->eloquent($this->store->query())
            ->addColumn('service_name', function (Store $store) {
                $serviceName = Service::find($store->service_id)->description;
                return $serviceName;
            })
            ->addColumn('actions', function (Store $store) {
                return '<div class="btn-group">
                    <form action="' . route('establecimientos.show', $store->id) . '" method="get">
                        <div class="btn-group">
                            <button type="submit" class="btn btn-default btn-sm" title="Editar">
                                <i class="fa fa-pen"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal" onclick="modifyDeleteAction(' . $store->id . ',\'' . $store->commercial_name . '\')" title="Eliminar">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </form>
                </div>';
            })
            ->rawColumns(['actions', 'active', 'visible'])
            ->toJson();
    }

    public function showOpening(int $id) : View
    {
        $store = $this->store->findOrFail($id);
        $exceptions = [];
        $opening_hours = [];
        $tempOpeningHours = $store->opening_hours;

        if (!empty($tempOpeningHours)) {
            // Remember: Arr::pull remove 'exceptions' from $tempOpeningHours
            $tempExceptions = Arr::pull($tempOpeningHours, 'exceptions');
            $opening_hours = $this->setOpeningHoursFormatted($tempOpeningHours);
            $exceptions = $this->setExceptionsFormatted($tempExceptions);
        }

        return view('stores.opening', compact('store', 'opening_hours', 'exceptions'));
    }

    private function setOpeningHoursFormatted(array $openingHours) : array
    {
        foreach ($openingHours as $dayIndex => $openingHour) {
            foreach ($openingHour as $rangeIndex => $timeRange) {
                if (empty($timeRange)) {
                    continue;
                }
                $openingHours[$dayIndex][$rangeIndex] = explode('-', $timeRange);
            }
        }

        return $openingHours;
    }
    private function setExceptionsFormatted(array $openingHours) : array
    {
        $result = [];
        foreach ($openingHours as $dayIndex => $timeRange) {
            $result[] = $this->getValidJoinedDateAndRange($dayIndex, $timeRange);
        }
        return $result;
    }

    public function saveOpening(Request $request)
    {
        $daysOfWeek = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
        $daysOfWeekWithRange = [];
        $exceptions = [];

        foreach ($daysOfWeek as $key => $value) {
            $daysOfWeekWithRange[$value] = $this->normalizeOpeningHoursFormat($request->day_range[$key]);
        }
        $exceptions = $this->normalizeExceptionsFormat($request->taggles);

        $store = Store::findOrFail($request->id);
        $store->opening_hours = array_merge($daysOfWeekWithRange, $exceptions);
        $store->save();

        return redirect()->route('establecimientos.show-opening', $request->id);
    }

    private function saveResizedImageFile2Disk(\Illuminate\Http\UploadedFile $file, int $storeId) : string
    {
        if (!$file) {
            return null;
        }

        return saveImageResized($file, 'images/establecimientos', self::MAX_RESOLUTION_WIDTH, self::HAS_SIGNATURE_STAMP, $storeId)['filePath'];
    }

    private function saveTaggles(array $activities) : array
    {
        $activityIds = [];

        foreach ($activities as $activityName) {
            if ($activityName === '') {
                continue;
            }
            $normalizedHashactivity = Str::title($activityName);
            $result = Activity::firstOrCreate(['name' => $normalizedHashactivity]);
            $activityIds[] = $result->id;
        }

        return $activityIds;
    }

    private function getLocationId(int $postalCode) : int
    {
        $result = Location::where('postal_code', $postalCode)->first();

        return $result->id;
    }

    private function normalizeOpeningHoursFormat(array $unformatTimeRange) : array
    {
        $validValues = $this->getValidHours($unformatTimeRange);

        if (empty($validValues)) {
            return [];
        }

        // Add end time if value is not mod by 2
        if ((count($validValues) % 2) != 0) {
            $validValues[] = '24:00';
        }

        // split in pairs to implode
        return array_map(function($item) {
            return implode('-', $item);
        }, array_chunk($validValues, 2));
    }

    private function getValidHours(array $unformatTimeRange) : array
    {
        return Arr::where($unformatTimeRange, function ($value) {
            return preg_match(self::REGEX_VALID_TIME_24_HOURS, $value);
        });
    }

    private function normalizeExceptionsFormat(array $checkTimeRanges) : array
    {
        if (empty($checkTimeRanges)) {
            return [];
        }

        $result = [];
        $validFormats = [
            'd/m',
            'd/m,H:i-H:i',
            'd/m,H:i-H:i,H:i-H:i',
            'd/m/Y',
            'd/m/Y,H:i-H:i',
            'd/m/Y,H:i-H:i,H:i-H:i',
        ];

        foreach ($checkTimeRanges as $dateTimeRange) {
            $isValidDateTimeRange = true;
            foreach ($validFormats as $validFormat) {
                try {
                    \Carbon\Carbon::createFromFormat($validFormat, $dateTimeRange);
                    $dateFormat = (Str::of($validFormat)->contains(',')) ? explode(',', $validFormat)[0] : $validFormat;
                    [$keyDate, $valueRange] = $this->getValidDateRange($dateFormat, $dateTimeRange);
                    $result[$keyDate[0]] = $valueRange[0];
                    break;
                } catch (\Carbon\Exceptions\InvalidFormatException $exp) {
                    $isValidDateTimeRange = false;
                }
            }
            if (!$isValidDateTimeRange) {
                // TODO What should we do?
            }
        }

        return  [
            'exceptions' => $result
        ];
    }

    private function getValidDateRange(string $dateFormat, string $dateTimeRange) : array
    {
        $arrDateRanges = (Str::of($dateTimeRange)->contains(',')) ? explode(',', $dateTimeRange) : [$dateTimeRange];
        $validDateRange = \Carbon\Carbon::createFromFormat($dateFormat, $arrDateRanges[0])->format(strrev($dateFormat));
        $countArrDateRanges = count($arrDateRanges);
        if ($countArrDateRanges > 1) {
            // We remove the first value, the date
            array_shift($arrDateRanges);
        }

        return Arr::divide([$validDateRange => ($countArrDateRanges === 1) ? [] : $arrDateRanges]);
    }

    private function getValidJoinedDateAndRange(string $dayIndex, array $dateRange) : string
    {
        $dateFormat = (strlen($dayIndex) <= self::MAX_CHAR_MD) ? 'm/d' : 'Y/m/d';
        $dateFormatted = \Carbon\Carbon::createFromFormat($dateFormat, $dayIndex)->format(strrev($dateFormat));
        $arrDateRangeJoined = Arr::prepend($dateRange, $dateFormatted);

        return collect($arrDateRangeJoined)->join(',');
    }

    private function getCommonModels() : array
    {
        return [
            PaymentMethod::get(),
            Service::get(),
            Category::get(),
            Activity::pluck('name'),
        ];
    }
}
