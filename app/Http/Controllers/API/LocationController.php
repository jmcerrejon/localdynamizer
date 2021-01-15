<?php

namespace App\Http\Controllers\API;

use App\Models\Location;

class LocationController extends BaseController
{
    /**
     * @OA\Get(
     *      path="/locations",
     *      operationId="getLocationsList",
     *      tags={"Locations"},
     *      summary="Get list of active locations",
     *      description="Returns list of locations",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *      )
     *     )
     */
    public function __invoke() : array
    {
        return $this->sendResponse(
            'active mun list',
            Location::whereActive(true)->get()
        );
    }
}
