@extends('layouts.admin.app')
@section('title', 'Dashboard Member')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        @include('layouts.admin.alert')
        <div class="row">
            <div class="col-md-5">
                <x-admin.card :title="'Profile'">
                    <div class="text-center card-body">
                        <div>
                            <img src="{{ url($member->foto) }}" class="rounded-circle avatar-xl img-thumbnail mb-2"
                                alt="profile-image">

                            <p class="font-13 mb-3">
                                {{ $member->alamat }}
                            </p>

                            <div class="text-start">
                                <p class="font-13">
                                    <strong>Nama :</strong>
                                    <span class="ms-2">{{ $member->nama }}</span>
                                </p>
                            </div>
                            <div class="text-start">
                                <p class="font-13">
                                    <strong>Tempat, Tanggal Lahir :</strong>
                                    <span class="ms-2">{{ $member->tempat_lahir }},
                                        {{ \Carbon\Carbon::parse($member->tanggal_lahir)->translatedFormat('d F Y') }}</span>
                                </p>
                            </div>
                            <div class="text-start">
                                <p class="font-13">
                                    <strong>Nomor Telepon :</strong>
                                    <span class="ms-2">+628378478934</span>
                                </p>
                            </div>
                            <x-admin.table.button.href classes="btn-dark" href="{{ route('member.profile.edit') }}">
                                <i class="mdi mdi-account"></i> Ubah Profil
                            </x-admin.table.button.href>
                        </div>
                    </div>
                </x-admin.card>
            </div>
            <div class="col-xl-7">
                <div class="card p-2">
                    <canvas id="weightChart"></canvas>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mt-1 header-title">Keranjang Anda</h4>

                        <div class="table-responsive">
                            <table id="trxTable" class="table table-bordered dt-responsive table-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Program Class</th>
                                        <th>Harga Per Bulan</th>
                                        <th>Berlanggan Selama</th>
                                        <th>Total Bayar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carts as $cart)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $cart->programClass->nama }}</td>
                                            <td>{{ 'Rp. ' . number_format($cart->harga_per_bulan) }}</td>
                                            <td>{{ $cart->berlangganan_selama }}</td>
                                            <td>{{ 'Rp. ' . number_format($cart->total_harga) }}</td>
                                            <td>
                                                <a href="{{ route('member.transaction.create', $cart->id) }}"
                                                    class="btn btn-outline-primary btn-sm rounded waves-effect waves-light"
                                                    title="Bayar-Pesanan">
                                                    <i class="mdi mdi-shopping-outline"></i>
                                                </a>
                                                <form action="{{ route('member.program.destroy', $cart->id) }}" class="d-inline" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn btn-outline-danger btn-sm rounded waves-effect waves-light"
                                                        title="Hapus-Keranjang">
                                                        <i class="mdi mdi-trash-can"></i>
                                                    </button>
                                                </form>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $('#trxTable').DataTable();
        const ctx = document.getElementById('weightChart');
        let labels = Object.keys({!! $chart !!})
        let data = Object.values({!! $chart !!})
        console.log(labels)
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Berat Badan Member (Kg)',
                    data: data,
                    fill: true,
                    borderColor: 'rgb(75, 192, 499)',
                    tension: 0.2
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endpush
