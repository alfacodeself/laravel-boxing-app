@extends('layouts.admin.app')
@section('title', 'Program Class')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        @include('layouts.admin.alert')
        <div class="row">
            @forelse ($programs as $program)
                <div class="col-md-6 col-xl-4">
                    <div class="card">
                        <img class="card-img-top img-fluid" src="{{ url($program->programClass->thumbnail) }}" alt="Card image cap">
                        <div class="card-body">
                            <h4 class="card-title">{{ $program->programClass->nama }}</h4>
                            <p class="card-text">{{ $program->programClass->deskripsi }}</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">{{ 'Rp. ' . number_format($program->programClass->harga_per_bulan) }}</li>
                            <li class="list-group-item"> {{ $program->programClass->memberHasProgramClass->count() }} Anggota
                            </li>
                        </ul>
                        <div class="card-body">
                            <a href="{{ route('trainer.program.member', $program->programClass->slug) }}" class="d-block w-100 btn btn-outline-dark">
                                <i class="mdi mdi-account-multiple-check me-1 font-15"></i>
                                Detail Member
                            </a>
                        </div>
                    </div>

                </div>
            @empty
                <div class="card">
                    <div class="card-body">Tidak ada program!</div>
                </div>
            @endforelse
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
@push('js')
    <script>
    </script>
@endpush
