<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Trainer\TrainerUpdateRequest;
use App\Models\Trainer;
use App\Models\User;
use App\Services\ImageHandlerService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TrainerController extends Controller
{
    public function index()
    {
        try {
            $trainers = Trainer::select('uuid', 'foto', 'nama', 'tempat_lahir', 'tanggal_lahir', 'nomor_hp', 'alamat', 'foto_ktp', 'cv')->get();
            return view('app.admin.trainer.index', compact('trainers'))->with('success', 'Berhasil memuat data');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    public function edit(Trainer $trainer)
    {
        return view('app.admin.trainer.show.edit', compact('trainer'));
    }
    public function update(TrainerUpdateRequest $request, Trainer $trainer)
    {
        $data = $request->only('nama', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'nomor_hp', 'foto', 'foto_ktp', 'cv');
        try {
            if ($request->has('foto')) {
                ImageHandlerService::fileDeleteHandler($trainer->foto);
                $data['foto'] = ImageHandlerService::fileStoreHandler($request->foto, 'public/img/trainer', 'profile-');
            }else {
                $data['foto'] = $trainer->foto;
            }
            if ($request->has('foto_ktp')) {
                ImageHandlerService::fileDeleteHandler($trainer->foto_ktp);
                $data['foto_ktp'] = ImageHandlerService::fileStoreHandler($request->foto_ktp, 'public/img/trainer/ktp', 'ktp-');
            }else {
                $data['foto_ktp'] = $trainer->foto_ktp;
            }
            if ($request->has('cv')) {
                ImageHandlerService::fileDeleteHandler($trainer->cv);
                $data['cv'] = ImageHandlerService::fileStoreHandler($request->cv, 'public/img/trainer/cv', 'cv-');
            }else {
                $data['cv'] = $trainer->cv;
            }
            // dd($data);
            $trainer->updateOrFail($data);
            return redirect()->route('admin.trainer.index')->with('success', 'Berhasil mengubah trainer');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    public function show(Trainer $trainer)
    {
        $trainer->foto = ImageHandlerService::fileShowHandler($trainer->foto);
        $trainer->foto_ktp = ImageHandlerService::fileShowHandler($trainer->foto_ktp);
        $trainer->cv = ImageHandlerService::fileShowHandler($trainer->cv);
        $trainer->tanggal_lahir = Carbon::parse($trainer->tanggal_lahir)->translatedFormat('d F Y');
        return view('app.admin.trainer.show.show', compact('trainer'));
    }
    public function account(Trainer $trainer)
    {
        $nama = $trainer->nama;
        $uuid = $trainer->uuid;
        $account = $trainer->user;
        return view('app.admin.trainer.show.account', compact('nama', 'uuid', 'account'));
    }
    public function updateAccount(Request $request, Trainer $trainer, User $user)
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
            }else {
                $data['password'] = bcrypt($data['new_password']);
                unset($data['new_password']);
            }
            $user->updateOrFail($data);
            return redirect()->route('admin.trainer.index')->with('success', 'Akun trainer - ' . $trainer->nama . ' - berhasil diubah!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    public function program(Trainer $trainer)
    {
        $trainerPrograms = $trainer->programClassHasTrainers;
        return view('app.admin.trainer.show.program',  compact('trainerPrograms'));
    }
}
