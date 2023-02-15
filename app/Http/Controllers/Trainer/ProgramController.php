<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\MemberHasWeightClass;
use App\Models\ProgramClass;
use App\Models\ProgramClassHasTrainer;
use App\Models\WeightClass;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = ProgramClassHasTrainer::where('trainer_id', auth()->user()->trainer->id)->get();
        // dd($programs[0]->programClass);
        return view('app.trainer.programs.index', compact('programs'));
    }
    public function member(ProgramClass $programs)
    {
        $members = $programs->memberHasProgramClass;
        // dd($members);
        return view('app.trainer.programs.member', compact('programs', 'members'));
    }
    public function addWeightMember(ProgramClass $programs, Member $member)
    {
        $weight = WeightClass::get();
        return view('app.trainer.programs.add-weight', compact('programs', 'member', 'weight'));
    }
    public function storeWeightMember(ProgramClass $programs, Member $member, Request $request)
    {
        $validate = Validator::make($request->all(), [
            'tinggi_badan' => 'required',
            'berat_badan' => 'required',
            'keterangan' => 'required',
            'weight_class' => 'required',
        ]);
        if ($validate->fails()) {
            return back()->with('error', $validate->errors());
        }
        $weightClass = WeightClass::where('uuid', $request->weight_class)->first();
        if (!$weightClass) {
            return back()->with('error', 'Kelas berat badan tidak terdaftar. Hubungi admin.');
        }
        if ($request->berat_badan > $weightClass->maksimal_berat) {
            return back()->with('error', 'Maksimal berat melebihi dari kelas berat yang dipilih');
        }
        if ($request->berat_badan < $weightClass->minimal_berat) {
            return back()->with('error', 'Minimal berat kurang dari kelas berat yang dipilih');
        }
        try {
            MemberHasWeightClass::create([
                'member_id' => $member->id,
                'weight_class_id' => $weightClass->id,
                'tinggi_badan' => $request->tinggi_badan,
                'berat_badan' => $request->berat_badan,
                'keterangan' => $request->keterangan,
                'tanggal_ukur' => Carbon::now(),
            ]);
            return redirect()->route('trainer.program.member', $programs->slug)->with('success', 'Berhasli menambah berat badan anggota');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
