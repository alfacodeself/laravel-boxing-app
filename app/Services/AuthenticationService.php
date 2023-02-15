<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthenticationService
{
    public static function login($email, $password)
    {
        $user = User::where('email', $email)->first();
        if (!$user) {
            abort(Response::HTTP_NOT_FOUND, 'User not found! Please check your email');
        }
        if (!Hash::check($password, $user->password)) {
            abort(Response::HTTP_UNPROCESSABLE_ENTITY, 'Wrong Password');
        }
        Auth::login($user, true);
        return auth()->user();
    }
    public static function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
    }
    public static function registration($nama, $email, $password, $level)
    {
        User::create([
            'nama' => $nama,
            'email' => $email,
            'password' => bcrypt($password),
            'level' => $level
        ]);
    }
}
