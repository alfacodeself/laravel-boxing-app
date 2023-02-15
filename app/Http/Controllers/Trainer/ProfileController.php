<?php

namespace App\Http\Controllers\Trainer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ImageHandlerService;
use App\Http\Requests\Trainer\TrainerStoreRequest;
use App\Http\Requests\Trainer\TrainerUpdateRequest;
use App\Models\Trainer;

class ProfileController extends Controller
{
    public function index()
    {
        $trainer = auth()->user()->trainer;
        return view('app.trainer.profile.index', compact('trainer'));
    }
    public function create()
    {
        return view('app.trainer.profile.create');
    }
    public function edit()
    {
        $trainer = auth()->user()->trainer;
        return view('app.trainer.profile.edit', compact('trainer'));
    }
    public function store(TrainerStoreRequest $request)
    {
        $data = $request->only('nama', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'nomor_hp', 'foto', 'foto_ktp', 'cv');
        try {
            $data['foto'] = ImageHandlerService::fileStoreHandler($request->foto, 'public/img/trainer', 'profile-');
            $data['foto_ktp'] = ImageHandlerService::fileStoreHandler($request->foto_ktp, 'public/img/trainer/ktp', 'ktp-');
            $data['cv'] = ImageHandlerService::fileStoreHandler($request->cv, 'public/img/trainer/cv', 'cv-');
            $data['user_id'] = auth()->id();
            Trainer::create($data);
            return redirect()->route('trainer.profile.index')->with('success', 'Berhasil mengubah profil');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    public function update(TrainerUpdateRequest $request)
    {
        $trainer = auth()->user()->trainer;
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
            return redirect()->route('trainer.profile.index')->with('success', 'Berhasil mengubah profil');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
