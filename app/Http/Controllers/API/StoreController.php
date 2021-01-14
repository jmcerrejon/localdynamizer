<?php

namespace App\Http\Controllers\API;

use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends BaseController
{
    public function __invoke($id, Request $request, Store $stores) : array
    {
        $seedId = $request->seed_id ?? '';
        $queryStores = $stores->select('id', 'service_id', 'category_id', 'commercial_name', 'slogan', 'logo_path')
            ->whereLocationId($id)
            ->active()
            ->search($request->only(['commercial_name', 'category_id']));

        $data = (clone $queryStores)
            ->randomPremium($seedId)->get()->toBase()
            ->merge(
                (clone $queryStores)->randomBasic($seedId)->get()->toBase()
            );

        // INFO Check AppServiceProvider to see this custom paginate()
        return $this->sendResponse(
            "store list from $id",
            $data->paginate(config('app.pagination_size'))
        );

    }
}
