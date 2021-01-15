<?php

namespace App\Http\Controllers\API;

use App\Models\Activity;

class ActivityController extends BaseController
{
         /**
     * @OA\Get(
     *      path="/activities",
     *      operationId="getActivitiesList",
     *      tags={"Activities"},
     *      summary="Get list of activities",
     *      description="Returns list of activities",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *      )
     *     )
     */
    public function __invoke() : array
    {
        return $this->sendResponse(
            'activity list',
            Activity::get()
        );
    }
}