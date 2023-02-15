@extends('layouts.admin.app')
@section('title', 'Members')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        @include('layouts.admin.alert')
        <div class="row">
            <div class="col-md-12">
                <x-admin.card :title="'Members'">
                    <div class="table-responsive">
                        <table class="table table-bordered dt-responsive table-responsive nowrap" id="memberTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Telpon</th>
                                    <th>Status</th>
                                    <th>Tanggal Kadaluarsa</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($members as $member)
                                    <tr>
                                        <x-admin.table.td>{{ $loop->iteration }}</x-admin.table.td>
                                        <x-admin.table.td>{{ $member->member->nama }}</x-admin.table.td>
                                        <x-admin.table.td>{{ $member->member->nomor_hp }}</x-admin.table.td>
                                        <x-admin.table.td>{{ Str::upper($member->status) }}</x-admin.table.td>
                                        <x-admin.table.td>{{ \Carbon\Carbon::parse($member->tanggal_kadaluarsa)->format('d M Y') }}</x-admin.table.td>
                                        <x-admin.table.td>
                                            {{-- @dd($member->member->uuid) --}}
                                            <button onclick="keterangan('{{ route('trainer.program.member.addWeight', [$programs->slug, $member->member->uuid]) }}')"
                                                class="btn btn-dark btn-sm rounded waves-effect waves-light"
                                                title="Berat-Member">
                                                <i class="mdi mdi-weight-kilogram"></i>
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

    {{-- Modal Section --}}
    {{-- Modal --}}
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Tambah Galeri</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBody">
                    
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
        function keterangan(url) {
            // alert(url)
            $.ajax({
                url,
                success: function (res) {
                    let modal = document.getElementById('modal');
                    let modalTitle = modal.querySelector('.modal-title');
                    modalTitle.textContent = 'Berat Badan Member';
                    $('#modalBody').html(res);
                    $('#modal').modal('show')
                },
                error: function (err) {
                    console.log(err);
                }
            })
            // alert(url)
        }
    </script>
@endpush
