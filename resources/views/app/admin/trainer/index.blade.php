@extends('layouts.admin.app')
@section('title', 'All Trainers')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        @include('layouts.admin.alert')
        <div class="row">
            <div class="col-md-12">
                <x-admin.card :title="'All Trainers'">
                    <div class="table-responsive">
                        <table class="table table-bordered dt-responsive table-responsive nowrap" id="trainerTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>TTL</th>
                                    <th>Telpon</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($trainers as $trainer)
                                    <tr>
                                        <x-admin.table.td>{{ $loop->iteration }}</x-admin.table.td>
                                        <x-admin.table.td>{{ $trainer->nama }}</x-admin.table.td>
                                        <x-admin.table.td>{{ $trainer->tempat_lahir }}, {{ $trainer->tanggal_lahir }}
                                        </x-admin.table.td>
                                        <x-admin.table.td>{{ $trainer->nomor_hp }}</x-admin.table.td>
                                        <x-admin.table.td>
                                            <x-admin.table.button.href
                                                href="{{ route('admin.trainer.account', $trainer->uuid) }}"
                                                classes="btn-outline-primary btn-sm rounded" attr="title=Akun-Trainer">
                                                <i class="mdi mdi-account"></i>
                                            </x-admin.table.button.href>
                                            <button onclick="program('{{ $trainer->uuid }}')"
                                                class="btn btn-outline-dark btn-sm rounded waves-effect waves-light"
                                                title="Program-Kelas-Trainer">
                                                <i class="mdi mdi-equal-box"></i>
                                            </button>
                                            <x-admin.table.button.href
                                                href="{{ route('admin.trainer.edit', $trainer->uuid) }}"
                                                classes="btn-outline-danger btn-sm rounded" attr="title=Edit-Trainer">
                                                <i class="mdi mdi-pencil"></i>
                                            </x-admin.table.button.href>
                                            <x-admin.table.button.href
                                                href="{{ route('admin.trainer.show', $trainer->uuid) }}"
                                                classes="btn-outline-warning btn-sm rounded" attr="title=Detail-Trainer">
                                                <i class="mdi mdi-eye"></i>
                                            </x-admin.table.button.href>
                                        </x-admin.table.td>
                                    </tr>
                                @empty
                                    <tr>
                                        <x-admin.table.td classes="text-center" attr="colspan=5">There's no any data!
                                        </x-admin.table.td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </x-admin.card>
            </div>
        </div>
    </div>

    {{-- Modal Section --}}
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="bodyModal">
                    Body
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
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
        $('#trainerTable').DataTable();
        function program(uuid) {
            let url = "{{ route('admin.trainer.program', ':id') }}";
            url = url.replace(':id', uuid);
            $.ajax({
                url,
                success: function(res) {
                    let modal = document.getElementById('modal');
                    let modalTitle = modal.querySelector('.modal-title');
                    let modalBody = modal.querySelector('.modal-body');
                    $('#bodyModal').html(res);
                    $('#trxTable').DataTable()
                    modalTitle.textContent = 'Program Classes Trainer';
                    $('#modal').modal('show')
                },
                error: function(err) {
                    console.log(err);
                    alert(err.responseJSON.message)
                }
            })
        }
    </script>
@endpush
