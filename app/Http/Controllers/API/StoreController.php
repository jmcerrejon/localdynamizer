<?php

namespace App\Http\Controllers\API;

use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends BaseController
{
    /**
     *  @OA\Get(
     *      path="/stores/location/{id}",
     *      operationId="getStoresList",
     *      tags={"Stores"},
     *      summary="Get list of stores",
     *      description="Returns list of stores",
     *      @OA\Parameter(
     *          name="id",
     *          description="Location id",
     *          required=true,
     *          in="path",
     *          example="3270",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     *
     */
    public function index($id, Request $request, Store $stores) : array
    {
        $seedId = $request->seed_id ?? '';
        $queryStores = $stores->with('category', 'activities')->select('id', 'service_id', 'category_id', 'commercial_name', 'slogan', 'logo_path')
            ->whereLocationId($id)
            ->active()
            ->search($request->only(['q', 'category_id', 'activity_name']));

        $data = $request->has('sort')
            ? $this->getSortedItems($queryStores, $request->sort)
            : $this->getRandomItems($queryStores, $seedId);

        // INFO Check AppServiceProvider to see this customSimplePaginate()
        return $this->sendResponse(
            "store list from $id",
            collect($data)->customSimplePaginate(config('app.pagination_size'))
        );
    }

        /**
     *  @OA\Get(
     *      path="/stores/{id}",
     *      operationId="getStoresList",
     *      tags={"Stores"},
     *      summary="Get a store by id",
     *      description="Returns a store",
     *      @OA\Parameter(
     *          name="id",
     *          description="Store id",
     *          required=true,
     *          in="path",
     *          example="1",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="No se ha podido encontrar el registro"
     *      )
     * )
     *
     */
    public function show(int $id, Store $stores) : array
    {
        $store = $stores->whereId($id)->firstOrFail();

        return $this->sendResponse(
            "store $id",
            $store
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
                    ->basic()->orderBy('commercial_name', $sortType)->get()->toBase()
            );
    }
}
