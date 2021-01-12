<?php

namespace App\Http\Controllers\API;

use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends BaseController
{
    public function __invoke($id, Request $request, Store $stores) : array
    {
        // TODO Refactorize this
        $storesPremium = $stores
            ->whereLocationId($id)
            ->active()
            ->search($request->only(['commercial_name', 'category_id']))
            ->randomPremium();

        $storesBasic = $stores
            ->whereLocationId($id)
            ->active()
            ->search($request->only(['commercial_name', 'category_id']))
            ->randomBasic();

        // INFO Check AppServiceProvider to see this custom paginate()
        return $this->sendResponse(
            "store list from $id",
            $storesPremium->get()->toBase()->merge($storesBasic->get()->toBase())
            ->paginate(config('app.pagination_size'))
        );
    }
}
