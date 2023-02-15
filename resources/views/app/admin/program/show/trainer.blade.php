@extends('layouts.admin.app')
@section('title', 'Program Class Trainer')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        @include('layouts.admin.alert')
        <div class="card">
            <div class="card-body">
                <button onclick="$('#modal').modal('show')" class="btn btn-outline-dark mb-1"><i class="mdi mdi-plus me-1"></i>
                    Tambah Trainer Program
                    Kelas</button>
                <div class="row">
                    @forelse ($programTrainers as $pt)
                        <div class="col-xl-4">
                            <div class="card shadow-lg">
                                <div class="card-body widget-user">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 avatar-lg me-3">
                                            <img src="{{ $pt->trainer->foto == null ? asset('assets/images/default-avatar.png') : url($pt->trainer->foto) }}"
                                                class="img-fluid rounded-circle" alt="user">
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <h5 class="mt-0 mb-1">{{ $pt->trainer->nama }}</h5>
                                            <p class="text-muted mb-2 font-13 text-truncate">{{ $pt->trainer->nomor_hp }}
                                            </p>
                                            <small class="text-warning">
                                                <b>Bergabung {{ $pt->created_at->diffForHumans() }}</b>
                                            </small>
                                            <form action="{{ route('admin.program.trainer.delete', [$uuid, $pt->uuid]) }}" class="d-inline" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm d-block w-100"> <i class="mdi mdi-trash-can me-1"></i> Hapus Trainer</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @empty
                        {{-- <div class="card"> --}}
                        <div class="card-body">Tidak ada pelatih!</div>
                        {{-- </div> --}}
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pelatih Program Kelas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.program.trainer.create', $uuid) }}" method="POST">
                    @csrf
                    <div class="modal-body" id="bodyModal">
                        <div class="row inner-scroll">
                            @forelse ($trainers as $trainer)
                                <div class="col-md-2">
                                    <div class="gallery-card">
                                        <div class="gallery-card-body">
                                            <label class="block-check">
                                                <img src="{{ url($trainer->foto) }}" class="img-responsive" />
                                                <input type="checkbox" name="trainer[]" value="{{ $trainer->uuid }}">
                                                <span class="checkmark"></span>
                                            </label>
                                            <div class="mycard-footer text-light">
                                                {{ $trainer->nama }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                Tidak ada data pelatih!
                            @endforelse
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-dark">Tambahkan Pelatih</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <style>
        .row.inner-scroll {
            height: 445px;
            overflow: auto;
        }

        .mycard-footer {
            height: auto;
            background: #000000;
            font-size: 15px;
            padding: 10px;
            border-radius: 0 0px 4px 4px;
        }

        .gallery-card {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, .125);
            border-radius: .25rem;
            height: 132px;
            margin-bottom: 14px;
        }

        .gallery-card-body {
            -webkit-box-flex: 1;
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            /*padding: 1.25rem;*/
        }

        .gallery-card img {
            height: 100px;
            width: 100%;
        }

        label {
            margin-bottom: 0 !important;
        }

        /*--checkbox--*/

        .block-check {
            display: block;
            position: relative;


            cursor: pointer;
            font-size: 22px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        /* Hide the browser's default checkbox */
        .block-check input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        /* Create a custom checkbox */
        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 25px;
            width: 25px;
            background-color: #eee;
            cursor: pointer;
        }

        /* On mouse-over, add a grey background color */
        .block-check:hover input~.checkmark {
            background-color: #ccc;
        }

        /* When the checkbox is checked, add a blue background */
        .block-check input:checked~.checkmark {
            background-color: #2196F3;
        }

        /* Create the checkmark/indicator (hidden when not checked) */
        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        /* Show the checkmark when checked */
        .block-check input:checked~.checkmark:after {
            display: block;
        }

        /* Style the checkmark/indicator */
        .block-check .checkmark:after {
            left: 9px;
            top: 5px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 3px 3px 0;
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
        }
    </style>
@endpush
