<?php

namespace App\Http\Controllers\Member;

use Carbon\Carbon;
use App\Models\Member;
use App\Models\WeightClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MemberHasWeightClass;
use App\Models\MemberHasProgramClass;
use App\Services\ImageHandlerService;
use App\Http\Requests\Member\MemberStoreRequest;
use App\Http\Requests\Member\MemberUpdateRequest;

class ProfileController extends Controller
{
    public function index()
    {
        $member = auth()->user()->member;
        $chart = [];
        foreach ($member->memberHasWeightClass as $weight) {
            $label = Carbon::parse($weight->tanggal_ukur)->translatedFormat('d M Y');
            if (array_key_exists($label, $chart)) {
                $chart[$label .'-'. rand(1, 9)] = $weight->berat_badan;
            } else {
                $chart[$label] = $weight->berat_badan;
            }
        }
        $chart = json_encode($chart);
        
        $carts = MemberHasProgramClass::where('status', 'tidak aktif')->where('tanggal_kadaluarsa', null)->get();
        return view('app.member.profile.index', compact('member', 'chart', 'carts'));
    }
    public function create()
    {
        $weight = WeightClass::get();
        return view('app.member.profile.create', compact('weight'));
    }
    public function edit()
    {
        return view('app.member.profile.edit');
    }
    public function store(MemberStoreRequest $request)
    {
        $request->validate([
            'weight_class' => 'required',
            'tinggi_badan' => 'required',
            'berat_badan' => 'required',
        ]);
        $weight = WeightClass::where('uuid', $request->weight_class)->first();
        if (!$weight) {
            return back()->with('error', 'Kelas berat badan tidak di ketahui');
        }
        if ($request->berat_badan > $weight->maksimal_berat) {
            return back()->with('error', 'Maksimal berat melebihi dari kelas berat yang dipilih');
        }
        if ($request->berat_badan < $weight->minimal_berat) {
            return back()->with('error', 'Minimal berat kurang dari kelas berat yang dipilih');
        }
        try {
            $data = $request->only('nama', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'nomor_hp', 'foto');
            $data['foto'] = ImageHandlerService::fileStoreHandler($request->foto, 'public/img/member', 'profile-');
            $data['user_id'] = auth()->id();
            $member = Member::create($data);
            MemberHasWeightClass::create([
                'member_id' => $member->id,
                'weight_class_id' => $weight->id,
                'tinggi_badan' => $request->tinggi_badan,
                'berat_badan' => $request->berat_badan,
                'keterangan' => 'Awal Mendaftar',
                'tanggal_ukur' => Carbon::now(),
            ]);
            return redirect()->route('member.profile.index')->with('success', 'Berhasil mengatur profil anda');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    public function update(MemberUpdateRequest $request,)
    {
        $data = $request->only('nama', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'nomor_hp', 'foto');
        $member = auth()->user()->member;
        try {
            if ($request->has('foto')) {
                ImageHandlerService::fileDeleteHandler($member->foto);
                $data['foto'] = ImageHandlerService::fileStoreHandler($request->foto, 'public/img/member', 'profile-');
            } else {
                $data['foto'] = $member->foto;
            }
            $member->updateOrFail($data);
            return redirect()->route('member.profile.edit')->with('success', 'Berhasil mengubah member');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
