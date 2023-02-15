@extends('layouts.admin.app')
@section('title', 'Profil Trainer')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        @include('layouts.admin.alert')
        <div class="row">
            <div class="col-md-5">
                <x-admin.card :title="'Profile Trainer - ' . $trainer->nama">
                    <div class="text-center card-body">
                        <div>
                            <img src="{{ $trainer->foto == null ? asset('assets/images/default-avatar.png') : $trainer->foto }}"
                                class="rounded-circle avatar-xl img-thumbnail mb-2" alt="profile-image">

                            <p class="font-13 mb-3">
                                {!! $trainer->alamat !!}
                            </p>

                            <div class="text-start">
                                <p class="font-13">
                                    <strong>Nama :</strong>
                                    <span class="ms-2">{{ $trainer->nama }}</span>
                                </p>
                            </div>
                            <div class="text-start">
                                <p class="font-13">
                                    <strong>Tempat, Tanggal Lahir :</strong>
                                    <span class="ms-2">{{ $trainer->tempat_lahir }}, {{ $trainer->tanggal_lahir }}</span>
                                </p>
                            </div>
                            <div class="text-start">
                                <p class="font-13">
                                    <strong>Nomor Telepon :</strong>
                                    <span class="ms-2">{{ $trainer->nomor_hp }}</span>
                                </p>
                            </div>
                            <x-admin.table.button.href classes="btn-dark" href="{{ route('trainer.profile.edit') }}">
                                <i class="mdi mdi-account-edit"></i> Ubah Profil {{ $trainer->nama }}
                            </x-admin.table.button.href>
                        </div>
                    </div>
                </x-admin.card>
            </div>
            <div class="col-xl-7">
                <x-admin.card :title="'Dokumen Trainer - ' . $trainer->nama">
                    <ul>
                        <li><a href="{{ $trainer->foto_ktp }}" target="_blank">Foto KTP</a></li>
                        <li><a href="{{ $trainer->cv }}" target="_blank">Currciculum Vitae</a></li>
                    </ul>
                </x-admin.card>
            </div>
        </div>
    </div>
@endsection
