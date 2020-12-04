<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/admon/home';

    public function showLoginForm(): View
    {
        return view('auth.admin.login');
    }

    protected function guard(): StatefulGuard
    {
        return Auth::guard('admin');
    }
}
