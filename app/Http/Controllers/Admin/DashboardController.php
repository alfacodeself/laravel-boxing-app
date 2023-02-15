<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Member;
use App\Models\ProgramClass;
use App\Models\Trainer;
use App\Models\Transaction;
use App\Repositories\Admin\Interfaces\MemberRepositoryInterface;
use Carbon\Carbon;

class DashboardController extends Controller
{
    // protected $memberRepository;

    // public function __construct(MemberRepositoryInterface $memberRepository)
    // {
    //     $this->memberRepository = $memberRepository;
    // }
    public function __invoke(Request $request)
    {
        $unverifyAccount = User::where('level', '!=', 'admin')
            ->where('verifikasi_pada', null)
            ->select('uuid', 'nama', 'email', 'created_at AS tanggal_daftar')
            ->get();
        $programs = ProgramClass::count();
        $members = Member::count();
        $trainers = Trainer::count();
        $events = Event::count();
        
        $chart = [];
        $trx = Transaction::where('status', 'paid')->get()->groupBy(fn ($date) => Carbon::parse($date->created_at)->format('M Y'));
        foreach ($trx as $key => $t) {
            $chart[$key] = $t->count();
        }
        $chart = json_encode($chart);
        // dd($chart);
        return view('app.admin.dashboard', compact('unverifyAccount', 'programs', 'members', 'trainers', 'events', 'chart'));
    }
}
