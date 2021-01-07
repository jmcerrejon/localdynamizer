<?php

namespace App\Http\Controllers\API;

use App\Models\Location;

class LocationController extends BaseController
{
    public function __invoke() : array
    {
        return $this->sendResponse(
            'active mun list',
            Location::whereActive(true)->get()
        );
    }
}
