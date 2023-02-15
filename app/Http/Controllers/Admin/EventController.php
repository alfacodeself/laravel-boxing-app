<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MemberHasEvent;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::get();
        return view('app.admin.events.index', compact('events'));
    }
    public function create()
    {
        return view('app.admin.events.create');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'required|date'
        ], [
            'nama.required' => 'Nama tidak boleh kosong!',
            'deskripsi.required' => 'Deskripsi tidak boleh kosong!',
            'tanggal.required' => 'Tanggal tidak boleh kosong!',
            'tanggal.date' => 'Format tanggal salah!'
        ]);
        try {
            $data['slug'] = Str::slug($data['nama']) .'-' . rand(10000, 100000);
            $data['status'] = 'aktif';
            Event::create($data);
            return redirect()->route('admin.event.index')->with('success', 'Berhasil membuat even baru');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    public function edit(Event $event)
    {
        return view('app.admin.events.edit', compact('event'));
    }
    public function update(Event $event, Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'required|date'
        ], [
            'nama.required' => 'Nama tidak boleh kosong!',
            'deskripsi.required' => 'Deskripsi tidak boleh kosong!',
            'tanggal.required' => 'Tanggal tidak boleh kosong!',
            'tanggal.date' => 'Format tanggal salah!'
        ]);
        try {
            $data['slug'] = Str::slug($data['nama']) . '-' . rand(10000, 100000);
            $data['status'] = 'aktif';
            $event->updateOrFail($data);
            return redirect()->route('admin.event.index')->with('success', 'Berhasil mengubah even');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    public function destroy(Event $event)
    {
        try {
            $status = $event->status == 'aktif' ? 'tidak aktif' : 'aktif';
            $event->updateOrFail(['status' => $status]);
            return redirect()->route('admin.event.index')->with('success', 'Berhasil mengubah status even');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    public function members(Event $event)
    {
        $data = $event->memberHasEvent->where('status', 'setuju');
        return view('app.admin.events.member', compact('data'));
    }
    public function approve(Event $event)
    {
        $members = $event->memberHasEvent->where('status','!=', 'setuju');
        $slug = $event->slug;
        return view('app.admin.events.approve', compact('members', 'slug'));
    }
    public function acceptApprove(Event $event, MemberHasEvent $member)
    {
        try {
            $member->updateOrFail([
                'status' => 'setuju',
                'catatan' => 'Anda diterima mengikuti even!'
            ]);
            return redirect()->route('admin.event.approve', $event->slug)->with('success', 'Berhasil menyetujui member');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    public function rejectApprove(Event $event, MemberHasEvent $member, Request $request)
    {
        try {
            $member->updateOrFail([
                'status' => 'ditolak',
                'catatan' => $request->has('catatan') ? $request->catatan : 'Pengajuan ditolak, harap hubungi admin.'
            ]);
            return redirect()->route('admin.event.approve', $event->slug)->with('success', 'Berhasil menolak member');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
