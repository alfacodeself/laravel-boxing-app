<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function index()
    {
        $account = auth()->user();
        return view('app.admin.account', compact('account'));
    }
    public function store(Request $request)
    {
        $user = auth()->user();
        $data = $request->validate([
            'email' => 'required|unique:users,email,' . $user->id,
            'old_password' => 'nullable',
            'new_password' => 'nullable|min:5|confirmed',
        ], [
            'email.required' => 'Email tidak boleh kosong!',
            'email.unique' => 'Email sudah digunakan!',
            'new_password.min' => 'Password minimal 5 karakter!',
            'new_password.confirmed' => 'Konfirmasi password tidak cocok!',
        ]);
        if ($request->has('old_password') && $request->old_password != null && $request->new_password == null) {
            return back()->withErrors(['new_password' => 'Password baru harus di isi']);
        }
        try {
            if ($data['old_password'] == null) {
                unset($data['old_password']);
            } else {
                if (!Hash::check($data['old_password'], $user->password)) {
                    return back()->withErrors(['old_password' => 'Password lama anda salah']);
                }
            }
            if ($data['new_password'] == null) {
                unset($data['new_password']);
            } else {
                $data['password'] = bcrypt($data['new_password']);
                unset($data['new_password']);
            }
            $user->updateOrFail($data);
            return redirect()->route('admin.member.index')->with('success', 'Akun admin - ' . $user->admin->nama . ' - berhasil diubah!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
