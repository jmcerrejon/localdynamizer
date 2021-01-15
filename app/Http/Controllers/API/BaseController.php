<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
     /**
     * @OA\Info(
     *      version="1.0.0",
     *      title="Local Dynamizer API Documentation",
     *      description="Based on OpenAPI (ex. Swagger). Author: Jose Manuel Cerrejon Gonzalez.",
     *      @OA\Contact(
     *          email="ulysess@gmail.com"
     *      ),
     *      @OA\License(
     *          name="Commercial License",
     *          url="https://www.eulatemplate.com/live.php?token=6FBO6xmAMpGyYBPRfUYKGhQ8m4CIfn5B"
     *      )
     * )
     *
     * @OA\Server(
     *      url=L5_SWAGGER_CONST_HOST,
     *      description="API Server"
     * )
     */
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
