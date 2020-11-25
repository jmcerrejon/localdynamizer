<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;

class SubmitLandingFormController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // NOTE: This controller is excluded from csrf-token verification at app/Http/Middleware/VerifyCsrfToken.php
        dispatch(new SendEmailJob($request->all()));

        return view('landing-mail-sent');
    }
}
