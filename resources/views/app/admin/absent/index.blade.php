@extends('layouts.admin.app')
@section('title', 'Absent')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        @include('layouts.admin.alert')
        <div class="row">
            <div class="col-md-12">
                <x-admin.card :title="'All Absent'">
                    <button class="btn btn-dark rounded mb-1" onclick="create()">
                        <i class="mdi mdi-plus me-1"></i>
                        Tambah Absensi
                    </button>
                    <div class="table-responsive">
                        <table class="table table-bordered dt-responsive table-responsive nowrap" id="memberTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Program Kelas</th>
                                    <th>Catatan</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($absents as $absent)
                                    <tr>
                                        <x-admin.table.td>{{ $loop->iteration }}</x-admin.table.td>
                                        <x-admin.table.td>{{ $absent->programClass->nama }}</x-admin.table.td>
                                        <x-admin.table.td>{{ $absent->catatan }}</x-admin.table.td>
                                        <x-admin.table.td>{{ $absent->created_at->translatedFormat('d F Y H:i:s') }}</x-admin.table.td>
                                        <x-admin.table.td>{{ Str::upper($absent->status) }}</x-admin.table.td>
                                        <x-admin.table.td>
                                            <a href="{{ route('admin.absent.member', $absent->id) }}" class="btn btn-dark btn-sm rounded waves-effect waves-light"
                                                title="Absensi-Member">
                                                <i class="mdi mdi-file-edit"></i>
                                            </a>
                                            <a href="{{ route('admin.absent.trainer', $absent->id) }}" class="btn btn-dark btn-sm rounded waves-effect waves-light"
                                                title="Absensi-Trainer">
                                                <i class="mdi mdi-file-document-edit-outline"></i>
                                            </a>
                                            <form action="{{ route('admin.absent.destroy', $absent->id) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="btn btn-danger btn-sm rounded waves-effect waves-light"
                                                    title="Ubah-Status">
                                                    <i class="mdi mdi-power"></i>
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

    {{-- Modal --}}
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="bodyModal">
                    Body
                </div>
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
        $('#memberTable').DataTable();

        function create() {
            let url = '{{ route('admin.absent.create') }}';
            $.ajax({
                url,
                success: function(res) {
                    let modal = document.getElementById('modal');
                    let modalTitle = modal.querySelector('.modal-title');
                    let modalBody = modal.querySelector('.modal-body');
                    $('#bodyModal').html(res);
                    modalTitle.textContent = 'Buat Absensi Program Kelas';
                    $('#modal').modal('show')
                },
                error: function(err) {
                    alert(err.responseJSON.message)
                    console.log(err);
                }
            })
        }
    </script>
@endpush
