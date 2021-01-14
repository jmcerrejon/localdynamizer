<?php

namespace App\Http\Controllers\API;

use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends BaseController
{
    public function __invoke($id, Request $request, Store $stores) : array
    {
        $seedId = $request->seed_id ?? '';
        $queryStores = $stores->with('category', 'activities')->select('id', 'service_id', 'category_id', 'commercial_name', 'slogan', 'logo_path')
            ->whereLocationId($id)
            ->active()
            ->search($request->only(['q', 'category_id', 'activity_name']));

        $data = $request->has('sort')
            ? $this->getSortedItems($queryStores, $request->sort)
            : $this->getRandomItems($queryStores, $seedId);

        // INFO Check AppServiceProvider to see this custom paginate()
        return $this->sendResponse(
            "store list from $id",
            $data->paginate(config('app.pagination_size'))
        );
    }

    private function getRandomItems($queryStores, $seedId)
    {
        return (clone $queryStores)
            ->premium()->inRandomOrder($seedId)->get()->toBase()
            ->merge(
                (clone $queryStores)
                    ->basic()->inRandomOrder($seedId)->get()->toBase()
            );
    }

    private function getSortedItems($queryStores, $sortType = 'asc')
    {
        return (clone $queryStores)
            ->premium()->orderBy('commercial_name', $sortType)->get()->toBase()
            ->merge(
                (clone $queryStores)
                    ->premium()->orderBy('commercial_name', $sortType)->get()->toBase()
            );
    }
}
