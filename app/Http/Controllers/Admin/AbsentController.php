<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absent;
use App\Models\AbsentHasMember;
use App\Models\AbsentHasTrainer;
use App\Models\MemberHasProgramClass;
use App\Models\ProgramClass;
use App\Models\ProgramClassHasTrainer;
use Illuminate\Http\Request;

class AbsentController extends Controller
{
    public function index()
    {
        $absents = Absent::orderBy('status', 'ASC')->latest()->get();
        return view('app.admin.absent.index', compact('absents'));
    }
    public function create()
    {
        $programs = ProgramClass::where('status', 'aktif')->get();
        return view('app.admin.absent.create', compact('programs'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'program_class_slug' => 'required',
            'catatan' => 'required'
        ], [
            'program_class_slug.required' => 'Program kelas tidak boleh kosong!',
            'catatan.required' => 'Catatan absen tidak boleh kosong!',
        ]);
        try {
            $program = ProgramClass::where('slug', $request->program_class_slug)->firstOrFail();
            foreach ($program->absents as $absent) {
                if ($absent->status == 'aktif') {
                    return back()->with('error', 'Program kelas sudah memiliki absen aktif! Silakan lihat absensi dengan catatan ' . $absent->catatan . '!');
                }
            }
            $absent = Absent::create([
                'program_class_id' => $program->id,
                'catatan' => $request->catatan
            ]);
            $member = MemberHasProgramClass::where('status', 'aktif')->get();
            foreach ($member as $m) {
                $absent->absentHasMember()->create([
                    'member_id' => $m->member_id,
                ]);
            }
            $trainer = ProgramClassHasTrainer::where('status', 'aktif')->get();
            foreach ($trainer as $t) {
                $absent->absentHasTrainer()->create([
                    'trainer_id' => $t->trainer_id,
                ]);
            }
            return redirect()->route('admin.absent.index')->with('success', 'Berhasil membuat absensi');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    public function edit(Absent $absent)
    {
        return view('app.admin.absent.create', compact('programs', 'absent'));
    }
    public function update(Absent $absent, Request $request)
    {
        $request->validate(['catatan' => 'required'], [
            'catatan.required' => 'Catatan absen tidak boleh kosong!',
        ]);
        try {
            $absent->updateOrFail(['catatan' => $request->catatan]);
            return redirect()->route('admin.absent.index')->with('success', 'Berhasil mengubah absensi');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    public function destroy(Absent $absent)
    {
        try {
            $status = $absent->status == 'aktif' ? 'tidak aktif' : 'aktif';
            $absent->updateOrFail(['status' => $status]);
            return redirect()->route('admin.absent.index')->with('success', 'Berhasil mengubah status absensi');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    public function member(Absent $absent)
    {
        if ($absent->status == 'tidak aktif') {
            return back()->with('error', 'Absen sudah tidak aktif');
        }
        $id = $absent->id;
        $members = $absent->absentHasMember;
        return view('app.admin.absent.member', compact('members', 'id'));
    }
    public function memberAbsent(Absent $absent, AbsentHasMember $member, Request $request)
    {
        if ($absent->status == 'tidak aktif') {
            return back()->with('error', 'Absen sudah tidak aktif');
        }
        $request->validate(['keterangan' => 'required']);
        try {
            $member->updateOrFail(['keterangan' => $request->keterangan]);
            return redirect()->route('admin.absent.member', $absent->id)->with('success', 'Berhasil mengubah keterangan');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    public function trainer(Absent $absent)
    {
        if ($absent->status == 'tidak aktif') {
            return back()->with('error', 'Absen sudah tidak aktif');
        }
        $id = $absent->id;
        $trainers = $absent->absentHasTrainer;
        return view('app.admin.absent.trainer', compact('trainers', 'id'));
    }
    public function trainerAbsent(Absent $absent, AbsentHasTrainer $trainer, Request $request)
    {
        if ($absent->status == 'tidak aktif') {
            return back()->with('error', 'Absen sudah tidak aktif');
        }
        $request->validate(['keterangan' => 'required']);
        try {
            $trainer->updateOrFail(['keterangan' => $request->keterangan]);
            return redirect()->route('admin.absent.trainer', $absent->id)->with('success', 'Berhasil mengubah keterangan');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
