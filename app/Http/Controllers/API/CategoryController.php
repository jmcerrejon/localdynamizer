<?php

namespace App\Http\Controllers\API;

use App\Models\Category;

class CategoryController extends BaseController
{
    public function __invoke() : array
    {
        return $this->sendResponse(
            'category list',
            Category::get()
        );
    }
}
