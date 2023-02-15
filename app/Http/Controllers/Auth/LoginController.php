<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\AuthenticationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('app.landingpage.auth.login');
    }
    public function authenticate(Request $request)
    {
        $credential = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:4'
        ]);
        try {
            $user = AuthenticationService::login($credential['email'], $credential['password']);
            if ($user->level == 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Login Berhasil');
            } elseif ($user->level == 'trainer') {
                return redirect()->route('trainer.dashboard')->with('success', 'Login Berhasil');
            } elseif ($user->level == 'member') {
                return redirect()->route('member.dashboard')->with('success', 'Login Berhasil');
            } else {
                abort(500, 'Something went wrong!');
            }
        } catch (\Throwable $th) {
            return redirect()->route('login')->with('error', $th->getMessage());
        }
    }
    public function Register()
    {
        return view('app.landingpage.auth.register');
    }
}
