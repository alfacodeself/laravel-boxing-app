<?php

namespace App\Http\Controllers\Member;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MemberHasProgramClass;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $member = auth()->user()->member;
        $programActive = MemberHasProgramClass::where('member_id', $member->id)->where('status', 'aktif')->first();
        // dd($programActive);
        if ($programActive) {
            $data['schedule'] = $programActive->programClass->load('schedules.day', 'schedules.time')->schedules->groupBy(['day_id' => fn ($q) => $q->day->hari]);
        }else {
            $data['schedule'] = null;
        }
        $data['allProgramMember'] = MemberHasProgramClass::where('member_id', $member->id)->whereNotNull('tanggal_kadaluarsa')->get();
        return view('app.member.dashboard', $data);
    }
}
