@extends('layouts.admin.app')
@section('title', 'All Members')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        @include('layouts.admin.alert')
        <div class="row">
            <div class="col-md-12">
                <x-admin.card :title="'All Members'">
                    <div class="table-responsive">
                        <table class="table table-bordered dt-responsive table-responsive nowrap" id="memberTable">
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
                                @forelse ($members as $member)
                                    <tr>
                                        <x-admin.table.td>{{ $loop->iteration }}</x-admin.table.td>
                                        <x-admin.table.td>{{ $member->nama }}</x-admin.table.td>
                                        <x-admin.table.td>{{ $member->tempat_lahir }}, {{ $member->tanggal_lahir }}
                                        </x-admin.table.td>
                                        <x-admin.table.td>{{ $member->nomor_hp }}</x-admin.table.td>
                                        <x-admin.table.td>
                                            <x-admin.table.button.href
                                                href="{{ route('admin.member.account', $member->uuid) }}"
                                                classes="btn-outline-primary btn-sm rounded" attr="title=Akun-Member">
                                                <i class="mdi mdi-account"></i>
                                            </x-admin.table.button.href>
                                            <button onclick="transaction('{{ $member->uuid }}')"
                                                class="btn btn-outline-success btn-sm rounded waves-effect waves-light"
                                                title="Transaksi-Member">
                                                <i class="mdi mdi-credit-card-check-outline"></i>
                                            </button>
                                            <button onclick="program('{{ $member->uuid }}')"
                                                class="btn btn-outline-dark btn-sm rounded waves-effect waves-light"
                                                title="Program-Kelas-Member">
                                                <i class="mdi mdi-equal-box"></i>
                                            </button>
                                            <x-admin.table.button.href
                                                href="{{ route('admin.member.edit', $member->uuid) }}"
                                                classes="btn-outline-info btn-sm rounded" attr="title=Edit-Member">
                                                <i class="mdi mdi-pencil"></i>
                                            </x-admin.table.button.href>
                                            <x-admin.table.button.href
                                                href="{{ route('admin.member.show', $member->uuid) }}"
                                                classes="btn-outline-warning btn-sm rounded" attr="title=Detail-Member">
                                                <i class="mdi mdi-eye"></i>
                                            </x-admin.table.button.href>
                                            {{-- @dd($member->user) --}}
                                            <form action="{{ route('admin.member.account.status', $member->uuid) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <button 
                                                    type="submit" class="btn btn-outline-danger btn-sm rounded waves-effect waves-light"
                                                    title="{{ $member->user->verifikasi_pada == null ? 'Aktifkan' : 'Nonaktifkan' }}-Akun-Member">
                                                    <i class="mdi mdi-power"></i>
                                                </button>
                                            </form>
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
        <div class="modal-dialog modal-xl modal-scrollable" role="document">
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
        $('#memberTable').DataTable();

        function transaction(uuid) {
            let url = "{{ route('admin.member.transaction', ':id') }}";
            url = url.replace(':id', uuid);
            $.ajax({
                url,
                success: function(res) {
                    let modal = document.getElementById('modal');
                    let modalTitle = modal.querySelector('.modal-title');
                    let modalBody = modal.querySelector('.modal-body');
                    $('#bodyModal').html(res);
                    $('#trxTable').DataTable()
                    modalTitle.textContent = 'Transaction Member';
                    $('#modal').modal('show')
                },
                error: function(err) {
                    console.log(err);
                    alert(err.responseJSON.message)
                }
            })
        }
        function program(uuid) {
            let url = "{{ route('admin.member.program', ':id') }}";
            url = url.replace(':id', uuid);
            $.ajax({
                url,
                success: function(res) {
                    let modal = document.getElementById('modal');
                    let modalTitle = modal.querySelector('.modal-title');
                    let modalBody = modal.querySelector('.modal-body');
                    $('#bodyModal').html(res);
                    $('#trxTable').DataTable()
                    modalTitle.textContent = 'Program Classes Member';
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
