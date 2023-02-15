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
                        <img class="card-img-top img-fluid" src="{{ url($program->thumbnail) }}" alt="Card image cap">
                        <div class="card-body">
                            <h4 class="card-title">{{ $program->nama }}</h4>
                            <p class="card-text">{{ $program->deskripsi }}</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">{{ 'Rp. ' . number_format($program->harga_per_bulan) }}</li>
                            <li class="list-group-item"> {{ $program->memberHasProgramClass->where('status', 'aktif')->count() }} Anggota <button
                                    class="btn btn-link" onclick="show('{{ $program->slug }}', 'anggota')"><i
                                        class="mdi mdi-card-account-details-outline text-dark font-18"></i></button></li>
                            <li class="list-group-item"> {{ $program->program_class_has_trainer_count }} Pelatih <button
                                    class="btn btn-link" onclick="show('{{ $program->slug }}', 'trainer')"><i
                                        class="mdi mdi-card-account-details-star-outline text-dark font-18"></i></button>
                            </li>
                        </ul>
                        <div class="card-body">
                            <button onclick="create('{{ $program->slug }}')" class="d-block w-100 btn btn-outline-dark">
                                <i class="mdi mdi-cart-plus me-2 font-15"></i>
                                Beli Program
                            </button>
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
        function show(slug, type) {
            let url = '{{ route('member.program.show', ':id') }}';
            let title = '';
            if (type == 'anggota') {
                title = 'Anggota Program Kelas';
            } else {
                title = 'Pelatih Program Kelas';
            }
            url = url.replace(':id', slug)
            $.ajax({
                url,
                data: {
                    type: type
                },
                success: function(res) {
                    let modal = document.getElementById('modal');
                    let modalTitle = modal.querySelector('.modal-title');
                    let modalBody = modal.querySelector('.modal-body');
                    $('#bodyModal').html(res);
                    modalTitle.textContent = title;
                    $('#modal').modal('show')
                },
                error: function(err) {
                    alert(err.responseJSON.message)
                    console.log(err);
                }
            })
        }
        function create(slug) {
            let url = '{{ route('member.program.create', ':id') }}';
            url = url.replace(':id', slug)
            $.ajax({
                url,
                success: function(res) {
                    let modal = document.getElementById('modal');
                    let modalTitle = modal.querySelector('.modal-title');
                    let modalBody = modal.querySelector('.modal-body');
                    $('#bodyModal').html(res);
                    modalTitle.textContent = 'Beli Program Kelas';
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
