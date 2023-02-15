<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Member\MemberUpdateRequest;
use App\Models\Member;
use App\Models\MemberHasProgramClass;
use App\Models\User;
use App\Services\ImageHandlerService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        try {
            $members = Member::with('user')->select('uuid', 'foto', 'nama', 'tempat_lahir', 'tanggal_lahir', 'nomor_hp', 'alamat', 'user_id')->get();
            return view('app.admin.member.index', compact('members'))->with('success', 'Berhasil memuat data');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    public function edit(Member $member)
    {
        return view('app.admin.member.show.edit', compact('member'));
    }
    public function update(MemberUpdateRequest $request, Member $member)
    {
        $data = $request->only('nama', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'nomor_hp', 'foto');
        try {
            if ($request->has('foto')) {
                ImageHandlerService::fileDeleteHandler($member->foto);
                $data['foto'] = ImageHandlerService::fileStoreHandler($request->foto, 'public/img/member', 'profile-');
            } else {
                $data['foto'] = $member->foto;
            }
            $member->updateOrFail($data);
            return redirect()->route('admin.member.index')->with('success', 'Berhasil mengubah member');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    public function show(Member $member)
    {
        $member->foto = ImageHandlerService::fileShowHandler($member->foto);
        $member->tanggal_lahir = Carbon::parse($member->tanggal_lahir)->translatedFormat('d F Y');
        $chart = [];
        foreach ($member->memberHasWeightClass as $weight) {
            $label = Carbon::parse($weight->tanggal_ukur)->translatedFormat('d M Y');
            if (array_key_exists($label, $chart)) {
                $chart[$label .'-'. rand(1, 9)] = $weight->berat_badan;
            } else {
                $chart[$label] = $weight->berat_badan;
            }
        }
        // dd($chart);
        $chart = json_encode($chart);

        return view('app.admin.member.show.show', compact('member', 'chart'));
    }
    public function account(Member $member)
    {
        $nama = $member->nama;
        $uuid = $member->uuid;
        $account = $member->user;
        return view('app.admin.member.show.account', compact('nama', 'uuid', 'account'));
    }
    public function updateAccount(Request $request, Member $member, User $user)
    {
        $data = $request->validate([
            'email' => 'required|unique:users,email,' . $user->id,
            'new_password' => 'nullable|min:5|confirmed'
        ], [
            'email.required' => 'Email tidak boleh kosong!',
            'email.unique' => 'Email sudah digunakan!',
            'new_password.min' => 'Password minimal 5 karakter!',
            'new_password.confirmed' => 'Konfirmasi password tidak cocok!',
        ]);
        try {
            if ($data['new_password'] == null) {
                unset($data['new_password']);
            } else {
                $data['password'] = bcrypt($data['new_password']);
                unset($data['new_password']);
            }
            $user->updateOrFail($data);
            return redirect()->route('admin.member.index')->with('success', 'Akun member - ' . $member->nama . ' - berhasil diubah!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    public function transaction(Member $member)
    {
        $transactions = [];
        foreach ($member->memberHasProgramClass as $memperProgramClass) {
            foreach ($memperProgramClass->transactions as $transaction) {
                array_push($transactions, $transaction);
            }
        }
        return view('app.admin.member.show.transaction', compact('transactions'));
    }
    public function program(Member $member)
    {
        $programs = $member->memberHasProgramClass;
        return view('app.admin.member.show.program', compact('programs'));
    }
    public function setStatusAccount(Member $member)
    {
        try {
            $user = $member->user;
            if ($user->verifikasi_pada == null) {
                $data = ['verifikasi_pada' => Carbon::now()];
                $message = 'diaktifkan';
            }else {
                $data = ['verifikasi_pada' => null];
                $message = 'dinonaktifkan';
            }
            $user->update($data);
            return redirect()->route('admin.member.index')->with('success', 'Akun member - ' . $member->nama . ' - berhasil '. $message.'!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
