<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TimeRequest;
use App\Http\Requests\WeightClassRequest;
use App\Models\Time;
use App\Models\WeightClass;

class SettingController extends Controller
{
    public function index()
    {
        $weight = WeightClass::get();
        $time = Time::get();
        return view('app.admin.setting.index', compact('weight', 'time'));
    }
    public function addWeight()
    {
        return view('app.admin.setting.weight.create');
    }
    public function editWeight(WeightClass $weightClass)
    {
        return view('app.admin.setting.weight.edit', compact('weightClass'));
    }
    public function storeWeight(WeightClassRequest $request)
    {
        try {
            $data = $request->only('kelas_berat', 'minimal_berat', 'maksimal_berat');
            WeightClass::create($data);
            return redirect()->route('admin.setting.index')->with('success', 'Berhasil menambah kelas berat');
        } catch (\Throwable $th) {
            return redirect()->route('admin.setting.index')->with('error', $th->getMessage());
        }
    }
    public function updateWeight(WeightClassRequest $request, WeightClass $weightClass)
    {
        try {
            $data = $request->only('kelas_berat', 'minimal_berat', 'maksimal_berat');
            $weightClass->updateOrFail($data);
            return redirect()->route('admin.setting.index')->with('success', 'Berhasil mengubah kelas berat');
        } catch (\Throwable $th) {
            return redirect()->route('admin.setting.index')->with('error', $th->getMessage());
        }
    }
    public function destroyWeight(WeightClass $weightClass)
    {
        try {
            foreach ($weightClass->memberHasWeightClass as $member) {
                $member->delete();
            }
            $weightClass->deleteOrFail();
            return redirect()->route('admin.setting.index')->with('success', 'Berhasil menghapus kelas berat');
        } catch (\Throwable $th) {
            return redirect()->route('admin.setting.index')->with('error', $th->getMessage());
        }
    }
    public function addTime()
    {
        return view('app.admin.setting.time.create');
    }
    public function editTime(Time $time)
    {
        return view('app.admin.setting.time.edit', compact('time'));
    }
    public function storeTime(TimeRequest $request)
    {
        try {
            $data = $request->only('waktu', 'jam_mulai', 'jam_selesai');
            Time::create($data);
            return redirect()->route('admin.setting.index')->with('success', 'Berhasil menambah waktu');
        } catch (\Throwable $th) {
            return redirect()->route('admin.setting.index')->with('error', $th->getMessage());
        }
    }
    public function updateTime(TimeRequest $request, Time $time)
    {
        try {
            $data = $request->only('waktu', 'jam_mulai', 'jam_selesai');
            $time->updateOrFail($data);
            return redirect()->route('admin.setting.index')->with('success', 'Berhasil mengubah waktu');
        } catch (\Throwable $th) {
            return redirect()->route('admin.setting.index')->with('error', $th->getMessage());
        }
    }
    public function destroyTime(Time $time)
    {
        try {
            $time->deleteOrFail();
            return redirect()->route('admin.setting.index')->with('success', 'Berhasil menghapus waktu');
        } catch (\Throwable $th) {
            return redirect()->route('admin.setting.index')->with('error', $th->getMessage());
        }
    }
}
