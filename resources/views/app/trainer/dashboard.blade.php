@extends('layouts.admin.app')
@section('title', 'Dashboard')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        @include('layouts.admin.alert')
        <div class="row">
            {{-- @isset($schedule) --}}
                <h4>Jadwal Anda</h4>
                @forelse ($schedule as $key => $jadwal)
                    <div class="col-md-4">
                        <div class="card shadow-lg">
                            <div class="card-body">
                                <h4 class="header-title mt-0 mb-1">{{ Str::upper($key) }}</h4>
                                <div class="widget-box-2">
                                    <ul>
                                        @foreach ($jadwal as $j)
                                            <li>
                                                {{ $j->time->waktu }}
                                                ({{ \Carbon\Carbon::parse($j->time->jam_mulai)->format('H:i') }}
                                                -
                                                {{ \Carbon\Carbon::parse($j->time->jam_selesai)->format('H:i') }})
                                                <br>
                                                <span><strong>Ket :</strong> {{ $j->catatan }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">Anda belum memiliki jadwal!</div>
                        </div>
                    </div>
                @endforelse
            {{-- @endisset --}}
        </div>
    </div>
@endsection
@push('css')
    <link href="{{ asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-select-bs5/css//select.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
@endpush
@push('js')
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
    <script>
        $('#memberTable').DataTable();
    </script>
@endpush
