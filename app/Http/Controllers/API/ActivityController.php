<?php

namespace App\Http\Controllers\API;

use App\Models\Activity;

class ActivityController extends BaseController
{
    public function __invoke() : array
    {
        return $this->sendResponse(
            'activity list',
            Activity::get()
        );
    }
}