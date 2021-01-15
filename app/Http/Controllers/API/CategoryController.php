<?php

namespace App\Http\Controllers\API;

use App\Models\Category;

class CategoryController extends BaseController
{
    /**
     * @OA\Get(
     *      path="/categories",
     *      operationId="getCategoriesList",
     *      tags={"Categories"},
     *      summary="Get list of categories",
     *      description="Returns list of categories",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *      )
     *     )
     */
    public function __invoke() : array
    {
        return $this->sendResponse(
            'category list',
            Category::get()
        );
    }
}
