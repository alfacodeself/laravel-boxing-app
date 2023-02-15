<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\MemberHasProgramClass;
use App\Models\ProgramClass;
use Illuminate\Http\Request;

class ProgramClassController extends Controller
{
    public function index()
    {
        $programs = ProgramClass::withCount('memberHasProgramClass', 'programClassHasTrainer')->where('status', 'aktif')->get();
        // dd($programs);
        return view('app.member.programs.index', compact('programs'));
    }
    public function show(ProgramClass $programClass)
    {
        if (request()->ajax()) {
            $data = [];
            if (request()->type == 'anggota') {
                $members = $programClass->memberHasProgramClass;
                foreach ($members as $member) {
                    array_push($data, $member->member);
                }
            }else{
                $trainers = $programClass->programClassHasTrainer;
                foreach ($trainers as $trainer) {
                    array_push($data, $trainer->trainer);
                }
            }
        }
        return view('app.member.programs.show', compact('data'));
    }
    public function create(ProgramClass $programClass)
    {
        return view('app.member.programs.create', compact('programClass'));
    }
    public function store(ProgramClass $programClass, Request $request)
    {
        $request->validate(['berlangganan_selama' => 'required|numeric|min:1'], [
            'berlangganan_selama.required' => 'Lama langganan tidak boleh kosong',
            'berlangganan_selama.numeric' => 'Lama langganan harus berupa angka',
            'berlangganan_selama.min' => 'Lama langganan minimal 1 bulan',
        ]);
        $member = auth()->user()->member;
        if ($member->memberHasProgramClass->where('program_class_id', $programClass->id)->where('tanggal_kadaluarsa', null)->count() > 0) {
            return back()->with('error', 'Anda telah memesan kelas - ' . $programClass->nama . ' - dan belum melakukan pembayaran! Harap lakukan pembayaran terlebih dahulu');
        }
        if ($member->memberHasProgramClass->where('status', 'aktif')->count() > 0) {
            return back()->with('warning', 'Anda sudah memiliki kelas yang sedang aktif! Harap selesaikan terlebih dahulu kelas aktif anda!');
        }
        try {
            MemberHasProgramClass::create([
                'member_id' => $member->id,
                'program_class_id' => $programClass->id,
                'harga_per_bulan' => $programClass->harga_per_bulan,
                'berlangganan_selama' => $request->berlangganan_selama,
                'total_harga' => $programClass->harga_per_bulan * $request->berlangganan_selama,
                'status' => 'tidak aktif',
                'expired' => null
            ]);
            return redirect()->route('member.program.index')->with('success', 'Berhasil memesan program kelas. Program kelas anda dapat dilihat pada keranjang di profil anda');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    public function destroy(MemberHasProgramClass $memberHasProgramClass)
    {
        try {
            // dd($memberHasProgramClass);
            $memberHasProgramClass->deleteOrFail();
            return redirect()->route('member.profile.index')->with('success', 'Berhasil menghapus keranjang anda!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
