<?php

namespace App\Http\Controllers\API;

use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends BaseController
{
    public function __invoke($postal_code, Request $request) : array
    {
        // TODO Add filter by category
        $stores = Store::wherePostalCode($postal_code)->get();

        if ($stores->isEmpty()) {
            abort(404, 'municipality with that postal code not found.');
        }

        return $this->sendResponse(
            "store list from $postal_code",
            Store::wherePostalCode($postal_code)->get()
        );
    }
    
}
