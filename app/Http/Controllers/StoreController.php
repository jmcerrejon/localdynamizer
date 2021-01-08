<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Store;
use App\Models\Service;
use App\Models\Activity;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Support\Str;
use App\Models\PaymentMethod;
use App\Http\Requests\StoreRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class StoreController extends Controller
{
    private const MAX_RESOLUTION_WIDTH = 1024;
    private const HAS_SIGNATURE_STAMP = true;

    private $store;

    public function __construct(Store $store)
    {
        $this->store = $store;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Just for test until we get the Datatables
        $totalStores = $this->store->limit(10)->get();
        return view('stores/index', compact('totalStores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $payment_methods = PaymentMethod::get();
        $services = Service::get();
        $categories = Category::get();
        $allActivities = Activity::get()->pluck('name');

        return view('stores.edit', compact('payment_methods', 'services', 'categories', 'allActivities'));
    }

    public function store(StoreRequest $request) : RedirectResponse
    {
        $validated = $request->validated();
        $activities = $validated['taggles'];
        $validated['user_id'] = Auth::user()->id;
        $validated['logo_path'] = ($request->has('logo_file') && (!empty($request->file('logo_file'))))
        ? $this->saveResizedImageFile2Disk($request->file('logo_file'), $validated['user_id'])
        : null;

        $validated['location_id'] = $this->getLocationId($validated['postal_code']);
        unset($validated['logo_file']);
        unset($validated['taggles']);

        try {
            $newStore = $this->store->create($validated);
            $activityIds = $this->saveTaggles($activities);
            $newStore->activities()->sync($activityIds);
        } catch (Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return redirect()->route('establecimientos.index')->with('message', 'Establecimiento guardado.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $store = $this->store->findOrFail($id);
        $payment_methods = PaymentMethod::get();
        $services = Service::get();
        $categories = Category::get();
        $allActivities = Activity::get()->pluck('name');

        return view('stores.edit', compact('store', 'payment_methods', 'services', 'categories', 'allActivities'));
    }

    public function update(StoreRequest $request, int $id) : RedirectResponse
    {
        $validated = $request->validated();
        $activities = $validated['taggles'];
        $validated['user_id'] = Auth::user()->id;
        $store = $this->store->findOrFail($id);
        $validated['logo_path'] = ($request->has('logo_file') && (!empty($request->file('logo_file'))))
        ? $this->saveResizedImageFile2Disk($request->file('logo_file'), $validated['store_id'])
        : null;

        $validated['location_id'] = $this->getLocationId($validated['postal_code']);

        unset($validated['logo_file']);
        unset($validated['taggles']);

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $store = $this->store->findOrFail($id);

        $this->delFile($store->logo_path);

        $store->delete();

        return redirect()->back();
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData()
    {
        return datatables()->eloquent($this->store->query())
            ->addColumn('active', function (Store $store) {
                $active = ($store->is_active) ? "label-success" : "label-danger";
                $active_txt = ($store->is_active) ? "Si" : "No";
                return "<span class='label $active'>$active_txt</span>";
            })
            ->addColumn('actions', function (Store $store) {
                return '<div class="btn-group">
                    <form action="' . route('establecimientos.show', $store->id) . '" method="get">
                        <div class="btn-group">
                            <button type="submit" class="btn btn-default btn-sm" title="Editar">
                                <i class="fa fa-pen"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal" onclick="modifyDeleteAction(' . $store->id . ',\'' . $store->comercial_name . '\')" title="Eliminar">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </form>
                </div>';
            })
            ->rawColumns(['actions', 'active', 'visible'])
            ->toJson();
    }

    private function saveResizedImageFile2Disk(\Illuminate\Http\UploadedFile $file, int $storeId) : string
    {
        if (!$file) {
            return null;
        }

        return saveImageResized($file, 'images/establecimientos', self::MAX_RESOLUTION_WIDTH, self::HAS_SIGNATURE_STAMP, $storeId)['filePath'];
    }

    private function saveTaggles($activities) : array
    {
        $activitiesIds = [];
        
        foreach ($activities as $activityName) {
            if ($activityName === '') {
                continue;
            }
            $normalizedHashactivity = Str::title($activityName);
            $result = Activity::firstOrCreate(['name' => $normalizedHashactivity]);
            $activitiesIds[] = $result->id;
        }

        return $activitiesIds;
    }

    private function getLocationId($postalCode) : int
    {
        $result = Location::where('postal_code', $postalCode)->first();

        return $result->id;
    }
}
