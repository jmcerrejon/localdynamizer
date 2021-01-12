<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    public function sendResponse(String $message, $result = []) : array
    {
        return [
            'success' => true,
            'message' => $message,
            'data'    => $result
        ];
    }

    public function sendError(String $errorMessages, $code = 404) : void
    {
        abort($code, $errorMessages);
    }
}
