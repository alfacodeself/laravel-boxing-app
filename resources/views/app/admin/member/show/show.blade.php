@extends('layouts.admin.app')
@section('title', 'Detail Member')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        @include('layouts.admin.alert')
        <div class="row">
            <div class="col-md-5">
                <x-admin.card :title="'Profile Member - ' . $member->nama">
                    <div class="text-center card-body">
                        <div>
                            <img src="{{ $member->foto == null ? asset('assets/images/default-avatar.png') : $member->foto }}"
                                class="rounded-circle avatar-xl img-thumbnail mb-2" alt="profile-image">

                            <p class="font-13 mb-3">
                                {!! $member->alamat !!}
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
                                    <span class="ms-2">{{ $member->tempat_lahir }}, {{ $member->tanggal_lahir }}</span>
                                </p>
                            </div>
                            <div class="text-start">
                                <p class="font-13">
                                    <strong>Nomor Telepon :</strong>
                                    <span class="ms-2">{{ $member->nomor_hp }}</span>
                                </p>
                            </div>
                            <x-admin.table.button.href classes="btn-dark" href="{{ route('admin.member.edit', $member->uuid) }}">
                                <i class="mdi mdi-account-edit"></i> Ubah Profil {{ $member->nama }}
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
        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
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
