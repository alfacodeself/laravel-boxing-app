<?php

namespace App\Http\Controllers\Admin;

use App\Models\Day;
use App\Models\Trainer;
use Illuminate\Support\Str;
use App\Models\ProgramClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ImageHandlerService;
use App\Models\ProgramClassHasTrainer;
use App\Http\Requests\Program\ProgramStoreRequest;
use App\Http\Requests\Program\ProgramUpdateRequest;
use App\Models\Schedule;
use App\Models\Time;

class ProgramClassController extends Controller
{
    public function index()
    {
        $programs = ProgramClass::select('slug', 'nama', 'deskripsi', 'harga_per_bulan AS harga', 'status')->get();
        return view('app.admin.program.index', compact('programs'));
    }
    public function create()
    {
        return view('app.admin.program.create');
    }
    public function store(ProgramStoreRequest $request)
    {
        $data = $request->only('nama', 'deskripsi', 'harga_per_bulan', 'thumbnail');
        try {
            $data['thumbnail'] = ImageHandlerService::fileStoreHandler($request->thumbnail, 'public/img/program', 'thumb-');
            $data['slug'] = Str::slug($data['nama']) . now();
            $data['status'] = 'aktif';
            ProgramClass::create($data);
            return redirect()->route('admin.program.index')->with('success', 'Berhasil membuat program');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    public function edit(ProgramClass $programClass)
    {
        return view('app.admin.program.edit', compact('programClass'));
    }
    public function update(ProgramUpdateRequest $request, ProgramClass $programClass)
    {
        $data = $request->only('nama', 'deskripsi', 'harga_per_bulan', 'thumbnail');
        // dd($data);
        try {
            if ($request->has('thumbnail')) {
                ImageHandlerService::fileDeleteHandler($programClass->thumbnail);
                $data['thumbnail'] = ImageHandlerService::fileStoreHandler($request->thumbnail, 'public/img/program', 'thumb-');
            }else {
                $data['thumbnail'] = $programClass->thumbnail;
            }
            if ($request->has('nama')) {
                $data['slug'] = Str::slug($data['nama']) . now();
            }
            $programClass->updateOrFail($data);
            return redirect()->route('admin.program.index')->with('success', 'Berhasil mengubah program');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    public function destroy(ProgramClass $programClass)
    {
        try {
            $programClass->status == 'aktif' ? $status = 'tidak aktif' : $status = 'aktif';
            $programClass->updateOrFail(['status' => $status]);
            return redirect()->route('admin.program.index')->with('success', 'Berhasil mengubah status program');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    public function show(ProgramClass $programClass)
    {
        $programClass->thumbnail = url($programClass->thumbnail);
        $programClass->harga_per_bulan = 'Rp. ' . number_format($programClass->harga_per_bulan);
        return view('app.admin.program.show.show', compact('programClass'));
    }
    public function member(ProgramClass $programClass)
    {
        $programMembers = $programClass->memberHasProgramClass->where('status', 'aktif');
        return view('app.admin.program.show.member', compact('programMembers'));
    }
    public function trainer(ProgramClass $programClass)
    {
        $uuid = $programClass->slug;
        $programTrainers = $programClass->programClassHasTrainer;
        $filter = $programClass->programClassHasTrainer;
        $filterId = [];
        foreach ($filter as $f) {
            array_push($filterId, $f->trainer->id);
        }
        // dd($filterId);
        $trainers = Trainer::whereNotIn('id',  $filterId)->select('uuid', 'nama', 'foto', 'nomor_hp')->get();
        // dd($trainers);
        return view('app.admin.program.show.trainer', compact('programTrainers', 'trainers', 'uuid'));
    }
    public function addTrainerProgram(Request $request, ProgramClass $programClass)
    {
        $request->validate([
            'trainer' => 'required|array'
        ]);
        try {
            $trainers = Trainer::whereIn('uuid', $request->trainer)->get();
            if ($trainers->count() != count($request->trainer)) {
                return back()->with('error', 'Data trainer bermasalah');
            }
            foreach ($trainers as $trainer) {
                $programClass->programClassHasTrainer()->create([
                    'trainer_id' => $trainer->id,
                    'status' => 'aktif'
                ]);
            }
            return redirect()->route('admin.program.index')->with('success', 'Berhasil menambah pelatih program');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    public function deleteTrainerProgram(ProgramClass $programClass, ProgramClassHasTrainer $trainerProgram)
    {
        try {
            $trainerProgram->deleteOrFail();
            return redirect()->route('admin.program.index')->with('success', 'Berhasil menghapus pelatih program');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    public function transaction(ProgramClass $programClass)
    {
        $transactions = [];
        foreach ($programClass->memberHasProgramClass as $memperProgramClass) {
            foreach ($memperProgramClass->transactions as $transaction) {
                array_push($transactions, $transaction);
            }
        }
        return view('app.admin.program.show.transaction', compact('transactions'));
    }
    public function schedule(ProgramClass $programClass)
    {
        $uuid = $programClass->slug;
        $data = $programClass->load('schedules.day', 'schedules.time')->schedules->groupBy(['day_id' => fn ($q) => $q->day->hari]);
        // dd($data);
        return view('app.admin.program.show.schedule', compact('data', 'uuid'));
    }
    public function reschedule(ProgramClass $programClass)
    {
        $days = Day::get();
        $times = Time::get();
        $slug = $programClass->slug;
        if ($programClass->schedules->count() > 0) {
            $schedules = $programClass->schedules;
            return view('app.admin.program.show.reschedule', compact('days', 'times', 'slug', 'schedules'));
        }
        else {
            return view('app.admin.program.show.reschedule', compact('days', 'times', 'slug'));
        }
    }
    public function addSchedule(Request $request, ProgramClass $programClass)
    {

        $days = Day::get();
        foreach ($days as $day) {
            $request->validate([
                $day->id => 'nullable|array',
                $day->id . '.*' => 'required|integer'
            ]);
        }
        try {
            if ($programClass->schedules->count() != 0) {
                foreach ($programClass->schedules as $schedule) {
                    $schedule->deleteOrFail();
                }
            }
            foreach ($days as $day) {
                if ($request->has($day->id)) {
                    $id = $day->id;
                    foreach ($request->$id as $time) {
                        $programClass->schedules()->create([
                            'day_id' => $id,
                            'time_id' => $time,
                            'catatan' => 'Tidak ada keterangan'
                        ]);
                    }
                }
            }
            return redirect()->route('admin.program.schedule', $programClass->slug)->with('success', 'Berhasil mengatur jadwal program');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    public function editScheduleNote(ProgramClass $programClass, Schedule $schedule, Request $request)
    {
        $request->validate([
            'catatan' => 'required'
        ]);
        try {
            $schedule->updateOrFail(['catatan' => $request->catatan]);
            return redirect()->route('admin.program.schedule', $programClass->slug)->with('success', 'Berhasil mengubah catatan jadwal program');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    public function generateTrainerAbsen(ProgramClass $programClass)
    {
        
    }
}
