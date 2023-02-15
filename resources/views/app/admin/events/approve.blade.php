@extends('layouts.admin.app')
@section('title', 'Pendaftaran Lomba')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        @include('layouts.admin.alert')
        <div class="row">
            <div class="col-md-12">
                <x-admin.card :title="'All Register'">
                    <div class="table-responsive">
                        <table class="table table-bordered dt-responsive table-responsive nowrap" id="memberTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>foto</th>
                                    <th>Nama</th>
                                    <th>Nomor Hp</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @dd($slug) --}}
                                @foreach ($members as $member)
                                    <tr>
                                        <x-admin.table.td>{{ $loop->iteration }}</x-admin.table.td>
                                        <x-admin.table.td>
                                            <img src="{{ url($member->member->foto) }}" alt="foto" width="70">
                                        </x-admin.table.td>
                                        <x-admin.table.td>{{ $member->member->nama }}</x-admin.table.td>
                                        <x-admin.table.td>{{ $member->member->nomor_hp }}</x-admin.table.td>
                                        <x-admin.table.td>{{ $member->status }}</x-admin.table.td>
                                        <x-admin.table.td>
                                            <form action="{{ route('admin.event.approve.accept', [$slug, $member->id]) }}" method="post"
                                                class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="btn btn-dark btn-sm rounded waves-effect waves-light"
                                                    title="Terima-Member">
                                                    <i class="mdi mdi-check-box-multiple-outline"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.event.approve.reject', [$slug, $member->id]) }}" method="post"
                                                class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="btn btn-danger btn-sm rounded waves-effect waves-light"
                                                    title="Terima-Member">
                                                    <i class="mdi mdi-close-box-multiple"></i>
                                                </button>
                                            </form>
                                        </x-admin.table.td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </x-admin.card>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <link href="{{ asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
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
        $('#memberTable').DataTable({
            // scrollX: true,
            // scrollCollapse: true,
            // autoWidth: true,
            // paging: true,
            // columnDefs: [
            //     {
            //         "width": "600px",
            //         "targets": [0]
            //     },
            //     {
            //         "width": "10px",
            //         "targets": [1]
            //     },
            // ]
        });
    </script>
@endpush
