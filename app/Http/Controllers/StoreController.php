<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
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
        return view('home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Store $store)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        //
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
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal" onclick="modifyDeleteAction('.$store->id.',\''. $store->name .'\')" title="Eliminar">
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
