<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\MemberHasEvent;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('status', 'aktif')->get()->map(function($e){
            $e->catatan = 'Daftar Even';
            foreach ($e->memberHasEvent as $memberEvent) {
                if ($memberEvent->member_id == auth()->user()->member->id) {
                    $e->catatan = $memberEvent->catatan;
                }
            }
            return $e;
        });
        // dd($events);
        return view('app.member.event.index', compact('events'));
    }
    public function store(Event $event)
    {
        try {
            $validate = MemberHasEvent::where('member_id', auth()->user()->member->id)->where('event_id', $event->id)->count();
            if ($validate > 0) {
                return back()->with('error', 'Anda sudah mendaftar');
            }
            MemberHasEvent::create([
                'member_id' => auth()->user()->member->id,
                'event_id' => $event->id,
                'catatan' => 'Menunggu persetujuan admin'
            ]);
            return redirect()->route('member.event.index')->with('success', 'Berhasil mendaftar!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    public function show(Event $event)
    {
        $memberEvent = MemberHasEvent::where('member_id', auth()->user()->member->id)->where('event_id', $event->id)->get();

    }
}
