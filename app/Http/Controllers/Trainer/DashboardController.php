<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use App\Models\ProgramClassHasTrainer;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $programActive = ProgramClassHasTrainer::where('trainer_id', auth()->user()->trainer->id)->where('status', 'aktif')->first();
        if ($programActive) {
            $data['schedule'] = $programActive->programClass->load('schedules.day', 'schedules.time')->schedules->groupBy(['day_id' => fn ($q) => $q->day->hari]);
        }else {
            $data['schedule'] = [];
        }
        // dd($data);
        return view('app.trainer.dashboard', $data);
    }
}
