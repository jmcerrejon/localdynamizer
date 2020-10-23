<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\LandingFormReceived;
use Illuminate\Support\Facades\Mail;

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
        Mail::send(new LandingFormReceived($request->all()));

        return view('landing-mail-sent');
    }
}
