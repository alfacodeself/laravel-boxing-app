@extends('layouts.admin.app')
@section('title', 'Program Class')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        @include('layouts.admin.alert')
        <div class="row">
            <div class="col-12">
                <a class="btn btn-dark rounded mb-1" href="{{ route('admin.event.create') }}">
                    <i class="mdi mdi-plus me-1"></i>
                    Tambah Even
                </a>
            </div>
            @forelse ($events as $event)
                <div class="col-md-6 col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-center">{{ $event->nama }}</h4>

                            <strong>Deskripsi</strong>
                            <p class="card-text">{!! $event->deskripsi !!}</p>
                            <hr>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">{{ $event->tanggal }}</li>
                            <li class="list-group-item"> {{ $event->memberHasEvent->where('status', 'setuju')->count() }}
                                Anggota <button class="btn btn-link" onclick="show('{{ $event->slug }}')"><i
                                        class="mdi mdi-card-account-details-outline text-dark font-18"></i></button></li>
                            <li class="list-group-item">
                                {{ $event->memberHasEvent->where('status', '!=', 'setuju')->count() }} Pendaftar <a
                                    class="btn btn-link" href="{{ route('admin.event.approve', $event->slug) }}"><i
                                        class="mdi mdi-card-account-details-star-outline text-dark font-18"></i></a>
                            </li>
                        </ul>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <form action="{{ route('admin.event.destroy', $event->slug) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="d-block w-100 btn btn-outline-dark">
                                            <i class="mdi mdi-power me-1 font-15"></i>
                                            {{ $event->status == 'aktif' ? 'Nonaktifkan' : 'Aktifkan' }} Even
                                        </button>
                                    </form>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('admin.event.edit', $event->slug) }}" class="d-block w-100 btn btn-outline-warning">
                                        <i class="mdi mdi-pencil-box-multiple me-1 font-15"></i>
                                        Edit Even
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            @empty
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">Tidak ada even!</div>
                    </div>
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
        function show(slug) {
            let url = '{{ route('admin.event.member', ':id') }}';
            url = url.replace(':id', slug)
            $.ajax({
                url,
                success: function(res) {
                    let modal = document.getElementById('modal');
                    let modalTitle = modal.querySelector('.modal-title');
                    let modalBody = modal.querySelector('.modal-body');
                    $('#bodyModal').html(res);
                    modalTitle.textContent = 'Anggota';
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
