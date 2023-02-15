<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\AuthenticationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register()
    {
        return view('app.landingpage.auth.register');
    }
    public function registration(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'level' => 'required',
        ], [
            'nama.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Format email salah',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 8 karakter',
            'level.required' => 'Level tidak boleh kosong',
        ]);
        if ($validate->fails()) {
            return back()->with('error', $validate->errors());
        }
        try {
            AuthenticationService::registration($request->nama, $request->email, $request->password, $request->level);
            return redirect()->route('login')->with('success', 'Berhasil mendaftar! Harap menunggu persetujuan admin');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
