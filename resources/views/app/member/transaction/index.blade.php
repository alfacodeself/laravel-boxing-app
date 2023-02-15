@extends('layouts.admin.app')
@section('title', 'Dashboard Member')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        @include('layouts.admin.alert')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Data Transaksi</h4>

                        <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Program Class</th>
                                    <th>Harga Per Bulan</th>
                                    <th>Berlanggan Selama</th>
                                    <th>Total Bayar</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $transaction)
                                    <tr>
                                        <td>{{ $transaction->reference }}</td>
                                        <td>{{ $transaction->memberHasProgramClass->programClass->nama }}</td>
                                        <td>{{ 'Rp. ' . number_format($transaction->memberHasProgramClass->harga_per_bulan) }}
                                        </td>
                                        <td>{{ $transaction->memberHasProgramClass->berlangganan_selama }} Bulan</td>
                                        <td>{{ 'Rp. ' . number_format($transaction->memberHasProgramClass->total_harga) }}
                                        </td>
                                        <td>
                                            @if ($transaction->status == 'paid')
                                                <span class="badge px-2 text-uppercase bg-success">{{ $transaction->status }}</span>
                                            @elseif ($transaction->status == 'unpaid')
                                                <span class="badge px-2 text-uppercase bg-warning text-dark">{{ $transaction->status }}</span>
                                            @else
                                                <span
                                                    class="badge px-2 text-uppercase bg-danger">{{ $transaction->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button onclick="show('{{ $transaction->reference }}')"
                                                class="btn btn-outline-info btn-sm rounded waves-effect waves-light"
                                                title="Instruksi-Pembayaran">
                                                <i class="mdi mdi-information-variant"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{-- Modal --}}
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
        $('#datatable').DataTable()
        function show(ref) {
            let url = '{{ route('member.transaction.show', ':id') }}';
            url = url.replace(':id', ref)
            $.ajax({
                url,
                success: function(res) {
                    let modal = document.getElementById('modal');
                    let modalTitle = modal.querySelector('.modal-title');
                    let modalBody = modal.querySelector('.modal-body');
                    $('#bodyModal').html(res);
                    modalTitle.textContent = 'Detail Transaksi';
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
