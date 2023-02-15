<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ImageHandlerService;
use App\Http\Requests\Admin\AdminRequest;
use App\Models\Admin;

class ProfileController extends Controller
{
    public function index()
    {
        $admin = auth()->user()->admin;
        if ($admin) {
            return view('app.admin.profile', compact('admin'));
        }
        return view('app.admin.profile');
    }
    public function store(AdminRequest $request)
    {
        $admin = auth()->user()->admin;
        if ($admin) {
            $validate = 'required';
        }
        else {
            $validate = 'nullable';
        }
        $request->validate([
            'foto' => $validate . '|image|mimes:png,jpg,jpeg,gif,jfif|max:5000|dimensions:max_width=600,max_height=600',
        ], [
            'foto.required' => 'Foto tidak boleh kosong!',
            'foto.image' => 'Foto harus berupa gambar!',
            'foto.mimes' => 'Format foto harus berupa png,jpg,jpeg,gif,jfif!',
            'foto.max' => 'Foto maksimal 5MB!',
            'foto.dimensions' => 'Ukuran foto maksimal 600 * 600!',
        ]);
        try {
            $data = $request->only('foto', 'nama', 'alamat', 'nomor_hp');
            $data['user_id'] = auth()->id();
            if ($request->has('foto')) {
                if ($admin) {
                    ImageHandlerService::fileDeleteHandler($admin->foto);
                }
                $data['foto'] = ImageHandlerService::fileStoreHandler($request->foto, 'public/img/admin', 'profile-');
            }
            if ($admin) {
                $admin->updateOrFail($data);
            }
            else {
                Admin::create($data);
            }
            return redirect()->route('admin.profile.index')->with('success', 'Berhasil mengubah profil admin.');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
