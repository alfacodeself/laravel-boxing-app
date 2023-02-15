<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberAccountController extends Controller
{
    public function verifyAccount(User $user)
    {
        try {
            $user->update(['verifikasi_pada' => Carbon::now()]);
            return redirect()->route('admin.dashboard')->with('success', 'Verifikasi akun ' . $user->nama . ' berhasil!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
