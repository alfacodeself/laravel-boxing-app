@extends('layouts.admin.app')
@section('title', 'Galleries')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        @include('layouts.admin.alert')
        <div class="row">
            <div class="col-md-12">
                <x-admin.card :title="'All Galleries'">
                    <button class="btn btn-dark rounded mb-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="mdi mdi-plus me-1"></i>
                        Tambah Galeri
                    </button>
                    <div class="table-responsive">
                        <table class="table table-bordered dt-responsive table-responsive nowrap" id="memberTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Gambar</th>
                                    <th>Catatan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($galleries as $gallery)
                                    <tr>
                                        <x-admin.table.td>{{ $loop->iteration }}</x-admin.table.td>
                                        <x-admin.table.td>
                                            <img src="{{ url($gallery->gambar) }}" alt="gallery" width="150">
                                        </x-admin.table.td>
                                        <x-admin.table.td>{{ $gallery->catatan }}</x-admin.table.td>
                                        <x-admin.table.td>
                                            <form action="{{ route('admin.gallery.destroy', $gallery->id) }}" method="post"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-danger btn-sm rounded waves-effect waves-light"
                                                    title="Hapus-Gallery">
                                                    <i class="mdi mdi-trash-can"></i>
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
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Galeri</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <x-admin.form.form :method="'POST'" :route="route('admin.gallery.store')" enctype="multipart/form-data">
                        <x-admin.form.input type="file" label='Gambar' name="gambar" placeholder="Gambar" />
                        <x-admin.form.input label='Catatan' name="catatan" placeholder="Catatan" />
                        <x-admin.form.submit classes="btn-dark rounded-3" name="Tambahkan Galeri" />
                    </x-admin.form.form>
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
