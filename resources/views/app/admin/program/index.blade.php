@extends('layouts.admin.app')
@section('title', 'Program Class')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        @include('layouts.admin.alert')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <button onclick="create()" class="btn btn-dark rounded"><i class="mdi mdi-plus me-1"></i> Buat Program
                            Kelas</button>
                        <h4 class="mt-1 header-title">Data Program Kelas</h4>
                        <div class="table-responsive">
                            <table id="programTable" class="table table-bordered dt-responsive table-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Program Kelas</th>
                                        <th>Harga Per Bulan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($programs as $program)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $program->nama }}</td>
                                            <td>Rp. {{ number_format($program->harga) }}</td>
                                            <td>
                                                @if ($program->status == 'aktif')
                                                    <span
                                                        class="badge px-2 text-uppercase bg-info">{{ $program->status }}</span>
                                                @else
                                                    <span
                                                        class="badge px-2 text-uppercase bg-danger">{{ $program->status }}</span>
                                                @endif
                                            </td>
                                            <x-admin.table.td>
                                                <button onclick="transaction('{{ $program->slug }}')"
                                                    class="btn btn-outline-success btn-sm rounded waves-effect waves-light"
                                                    title="Transaksi-Program-Kelas">
                                                    <i class="mdi mdi-credit-card-check-outline"></i>
                                                </button>
                                                <a href="{{ route('admin.program.trainer', $program->slug) }}"
                                                    class="btn btn-outline-info btn-sm rounded waves-effect waves-light"
                                                    title="Trainer-Program-Kelas">
                                                    <i class="mdi mdi-account-star"></i>
                                                </a>
                                                <button onclick="member('{{ $program->slug }}')"
                                                    class="btn btn-outline-dark btn-sm rounded waves-effect waves-light"
                                                    title="Anggota-Program-Kelas">
                                                    <i class="mdi mdi-account-multiple"></i>
                                                </button>
                                                <button onclick="edit('{{ $program->slug }}')"
                                                    class="btn btn-outline-danger btn-sm rounded waves-effect waves-light"
                                                    title="Edit-Program-Kelas">
                                                    <i class="mdi mdi-pencil"></i>
                                                </button>
                                                <button onclick="show('{{ $program->slug }}')"
                                                    class="btn btn-outline-warning btn-sm rounded waves-effect waves-light"
                                                    title="Lihat-Program-Kelas">
                                                    <i class="mdi mdi-eye"></i>
                                                </button>
                                                <a href="{{ route('admin.program.schedule', $program->slug) }}"
                                                    class="btn btn-outline-secondary btn-sm rounded waves-effect waves-light"
                                                    title="Jadwal-Program-Kelas">
                                                    <i class="mdi mdi-calendar"></i>
                                                </a>
                                                <form action="{{ route('admin.program.destroy', $program->slug) }}"
                                                    class="d-inline" method="POST">
                                                    @method('PATCH')
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn btn-outline-primary btn-sm rounded waves-effect waves-light"
                                                        title="Ubah-Status-Program-Kelas">
                                                        <i class="mdi mdi-power"></i>
                                                    </button>
                                                </form>
                                            </x-admin.table.td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Tidak ada data!</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

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
        $('#programTable').DataTable();

        function create() {
            let url = '{{ route('admin.program.create') }}';
            $.ajax({
                url,
                success: function(res) {
                    let modal = document.getElementById('modal');
                    let modalTitle = modal.querySelector('.modal-title');
                    let modalBody = modal.querySelector('.modal-body');
                    $('#bodyModal').html(res);
                    modalTitle.textContent = 'Buat Program Kelas';
                    $('#modal').modal('show')
                },
                error: function(err) {
                    alert(err.responseJSON.message)
                    console.log(err);
                }
            })
        }
        function edit(slug) {
            let url = '{{ route('admin.program.edit', ':id') }}';
            url = url.replace(':id', slug)
            $.ajax({
                url,
                success: function(res) {
                    let modal = document.getElementById('modal');
                    let modalTitle = modal.querySelector('.modal-title');
                    let modalBody = modal.querySelector('.modal-body');
                    $('#bodyModal').html(res);
                    modalTitle.textContent = 'Edit Program Kelas';
                    $('#modal').modal('show')
                },
                error: function(err) {
                    alert(err.responseJSON.message)
                    console.log(err);
                }
            })
        }
        function show(slug) {
            let url = '{{ route('admin.program.show', ':id') }}';
            url = url.replace(':id', slug)
            $.ajax({
                url,
                success: function(res) {
                    let modal = document.getElementById('modal');
                    let modalTitle = modal.querySelector('.modal-title');
                    let modalBody = modal.querySelector('.modal-body');
                    $('#bodyModal').html(res);
                    modalTitle.textContent = 'Detail Program Kelas';
                    $('#modal').modal('show')
                },
                error: function(err) {
                    alert(err.responseJSON.message)
                    console.log(err);
                }
            })
        }
        function member(slug) {
            let url = '{{ route('admin.program.member', ':id') }}';
            url = url.replace(':id', slug)
            $.ajax({
                url,
                success: function(res) {
                    let modal = document.getElementById('modal');
                    let modalTitle = modal.querySelector('.modal-title');
                    let modalBody = modal.querySelector('.modal-body');
                    $('#bodyModal').html(res);
                    modalTitle.textContent = 'Anggota Program Kelas';
                    $('#modal').modal('show')
                },
                error: function(err) {
                    alert(err.responseJSON.message)
                    console.log(err);
                }
            })
        }
        function transaction(slug) {
            let url = '{{ route('admin.program.transaction', ':id') }}';
            url = url.replace(':id', slug)
            $.ajax({
                url,
                success: function(res) {
                    let modal = document.getElementById('modal');
                    let modalTitle = modal.querySelector('.modal-title');
                    let modalBody = modal.querySelector('.modal-body');
                    $('#bodyModal').html(res);
                    $('#trxTable').DataTable();
                    modalTitle.textContent = 'Transaksi Program Kelas';
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
