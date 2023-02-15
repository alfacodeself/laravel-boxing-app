@extends('layouts.admin.app')
@section('title', 'Program Class')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        @include('layouts.admin.alert')
        <div class="row">
            @forelse ($events as $event)
                <div class="col-md-6 col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-center">{{ $event->nama }}</h4>

                            <strong>Deskripsi</strong>
                            <p class="card-text">{!! $event->deskripsi !!}</p>
                            <hr>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">{{ $event->tanggal }}</li>
                            @if ($event->catatan != 'Daftar Even')
                                <li class="list-group-item">STATUS : {{ $event->catatan }}</li>
                            @endif
                        </ul>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{ route('member.event.store', $event->slug) }}" method="post"
                                        class="d-inline">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" {{ $event->catatan != 'Daftar Even' ? 'disabled' : '' }}  class="d-block w-100 btn btn-outline-dark">
                                            <i class="mdi mdi-file-document-multiple me-1 font-15"></i>
                                            {{ $event->catatan }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            @empty
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">Tidak ada even!</div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
