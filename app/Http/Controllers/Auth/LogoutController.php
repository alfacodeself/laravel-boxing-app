<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\AuthenticationService;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function __invoke()
    {
        AuthenticationService::logout();
        return redirect()->route('login')->with('success', 'Berhasil Log Out!');
    }
}
