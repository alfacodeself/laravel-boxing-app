@extends('layouts.admin.app')
@section('title', 'Dashboard Admin')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        @include('layouts.admin.alert')
        <div class="row">
            <div class="col-md-3">
                <x-admin.widget :title="'Program Kelas'" :value="$programs">
                </x-admin.widget>
            </div>
            <div class="col-md-3">
                <x-admin.widget :title="'Anggota'" :value="$members">
                </x-admin.widget>
            </div>
            <div class="col-md-3">
                <x-admin.widget :title="'Pelatih'" :value="$trainers">
                </x-admin.widget>
            </div>
            <div class="col-md-3">
                <x-admin.widget :title="'Even'" :value="$events">
                </x-admin.widget>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card p-2">
                    <canvas id="trxChart" style="height: 400px"></canvas>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <x-admin.card :title="'Unverify Account'">
                    <div class="table-responsive">
                        <table class="table table-bordered dt-responsive table-responsive nowrap" id="memberTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Tanggal Daftar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($unverifyAccount as $account)
                                    <tr>
                                        <x-admin.table.td>{{ $loop->iteration }}</x-admin.table.td>
                                        <x-admin.table.td>{{ $account->nama }}</x-admin.table.td>
                                        <x-admin.table.td>{{ $account->email }}</x-admin.table.td>
                                        <x-admin.table.td>{{ $account->tanggal_daftar }}</x-admin.table.td>
                                        <x-admin.table.td>
                                            <x-admin.table.button.form
                                                action="{{ route('admin.account.verify', $account->uuid) }}"
                                                classes="btn-outline-dark btn-sm">
                                                <i class="mdi mdi-check-all"></i>
                                            </x-admin.table.button.form>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('trxChart');
        let labels = Object.keys({!! $chart !!})
        let data = Object.values({!! $chart !!})
        console.log(labels)
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Transaksi',
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

    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
    <script>
        $('#memberTable').DataTable();
    </script>
@endpush