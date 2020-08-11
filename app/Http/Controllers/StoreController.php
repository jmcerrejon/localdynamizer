<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Store;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Http\Requests\StoreRequest;
use Illuminate\Support\Facades\Auth;

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
    public function index(Store $stores)
    {
        // Just for test until we get the Datatables
        $totalStores = $stores->limit(10)->get();
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

        return view('stores.edit', compact('payment_methods'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::user()->id;
        $validated['logo_path'] = $request->file('logo_file');

        // TODO Next task: import intervention image and save the image resized

        try {
        	$this->store->create($validated);
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

        return view('stores.edit', compact('store', 'payment_methods'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\StoreRequest  $request
     * @param  Integer  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRequest $request, $id)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::user()->id;
        $store = $this->store->findOrFail($id);
        $file = $request->file('logo_file');
        
        // TODO Next task: import intervention image and save the image resized

        $store
			->fill($validated)
			->save();

		return redirect()->route('establecimientos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Request $request)
    {
        $store = $this->store->findOrFail($request->id);

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
                $active = ($store->is_active) ? "label-success": "label-danger";
                $active_txt = ($store->is_active) ? "Si": "No";
                return "<span class='label $active'>$active_txt</span>";
            })
            ->addColumn('actions', function (Store $store) {
                return '<div class="btn-group">
                    <form action="'. route('establecimientos.show', $store->id).'" method="get">
                        <div class="btn-group">
                            <button type="submit" class="btn btn-default btn-sm" title="Editar">
                                <i class="fa fa-pen"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal" onclick="modifyDeleteAction('.$store->id.',\''. $store->comercial_name .'\')" title="Eliminar">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </form>
                </div>';
            })
            ->rawColumns(['actions', 'active', 'visible'])
            ->toJson();
    }
}
