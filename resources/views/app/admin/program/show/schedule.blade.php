@extends('layouts.admin.app')
@section('title', 'Program Class Trainer')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        @include('layouts.admin.alert')
        <button onclick="reschedule('{{ $uuid }}')" class="btn btn-dark rounded-3 mb-1">
            <i class="mdi mdi-calendar-edit me-1"></i>
            Atur Ulang Jadwal
        </button>
        <div class="row">
            @forelse ($data as $key => $jadwal)
                <div class="col-md-3">
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <h4 class="header-title mt-0 mb-1">{{ Str::upper($key) }}</h4>
                            <div class="widget-box-2">
                                <ul>
                                    @foreach ($jadwal as $j)
                                        <li>
                                            {{ $j->time->waktu }}
                                            ({{ \Carbon\Carbon::parse($j->time->jam_mulai)->format('H:i') }}
                                            -
                                            {{ \Carbon\Carbon::parse($j->time->jam_selesai)->format('H:i') }})
                                            <br>
                                            <span><strong>Ket :</strong> {{ $j->catatan }}</span>
                                            <button class="btn btn-link p-0 m-0" onclick="editNote('{{ $j->uuid }}')"
                                                data-catatan="{{ $j->catatan }}">
                                                <i class="mdi mdi-pencil font-14 bg-warning rounded text-dark px-1"></i>
                                            </button>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">Tidak ada jadwal!</div>
                    </div>
                </div>
            @endforelse
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
    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="modal-form">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="catatan">Catatan</label>
                            <input type="text" name="catatan" id="catatan" class="form-control" placeholder="Catatan"
                                aria-describedby="keterangan">
                            <small id="keterangan" class="text-muted">Keterangan Jadwal</small>
                        </div>
                        <x-admin.form.submit classes="btn-dark rounded-3" name="Perbarui Catatan" />
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        function reschedule(slug) {
            let url = '{{ route('admin.program.reschedule', ':id') }}';
            url = url.replace(':id', slug)
            $.ajax({
                url,
                success: function(res) {
                    let modal = document.getElementById('modal');
                    let modalTitle = modal.querySelector('.modal-title');
                    let modalBody = modal.querySelector('.modal-body');
                    $('#bodyModal').html(res);
                    modalTitle.textContent = 'Jadwal Program Kelas';
                    $('#modal').modal('show')
                },
                error: function(err) {
                    alert(err.responseJSON.message)
                    console.log(err);
                }
            })
        }

        function editNote(uuid) {
            let url = '{{ route('admin.program.schedule.edit.note', [':program', ':id']) }}';
            url = url.replace(':program', '{{ $uuid }}');
            url = url.replace(':id', uuid);
            let modal = document.getElementById('modalEdit');
            let modalTitle = modal.querySelector('.modal-title');
            let modalBody = modal.querySelector('.modal-body');
            let modalForm = $('#modal-form');

            modalTitle.textContent = 'Catatan Jadwal Program Kelas';
            modalForm.attr('action', url)
            $('#modalEdit').modal('show')
        }
    </script>
@endpush
