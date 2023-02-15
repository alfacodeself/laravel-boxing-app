@extends('layouts.admin.app')
@section('title', 'Absent')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        @include('layouts.admin.alert')
        <div class="row">
            <div class="col-md-12">
                <x-admin.card :title="'All Member'">
                    <div class="table-responsive">
                        <table class="table table-bordered dt-responsive table-responsive nowrap" id="memberTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Member</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @dd($members) --}}
                                @foreach ($members as $member)
                                    <tr>
                                        <x-admin.table.td>{{ $loop->iteration }}</x-admin.table.td>
                                        <x-admin.table.td>{{ $member->member->nama }}</x-admin.table.td>
                                        <x-admin.table.td>{{ Str::upper($member->keterangan) }}</x-admin.table.td>
                                        <x-admin.table.td>
                                            <button data-bs-toggle="modal" onclick="keterangan('{{ route('admin.absent.member.absent', [$id, $member->id]) }}')" data-bs-target="#modal"
                                                class="btn btn-info btn-sm rounded waves-effect waves-light"
                                                title="Ubah-Keterangan">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>
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
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Tambah Galeri</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <x-admin.form.form :method="'PATCH'" :route="route('admin.gallery.store')" id="modal-form">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <select name="keterangan" id="keterangan" class="form-control">
                            <option value="masuk">Masuk</option>
                            <option value="izin">Izin</option>
                            <option value="sakit">Sakit</option>
                            <option value="tanpa keterangan">Tanpa Keterangan</option>
                        </select>
                        <br>
                        <x-admin.form.submit classes="btn-dark rounded-3" name="Ubah Keterangan" />
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
        $('#memberTable').DataTable();

        function keterangan(url) {
            let modal = document.getElementById('modal');
            let modalTitle = modal.querySelector('.modal-title');
            let modalBody = modal.querySelector('.modal-body');
            $('#modal-form').attr('action', url);
            modalTitle.textContent = 'Ubah Keterangan Absen';
            $('#modal').modal('show')
        }
    </script>
@endpush
