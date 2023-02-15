@extends('layouts.admin.app')
@section('title', 'Pengaturan')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        @include('layouts.admin.alert')
        <div class="row">
            <div class="col-xl-6">
                <x-admin.card :title="'Pengaturan General'">
                    <label for="">Kelas Berat Badan</label><br>
                    <button onclick="addWeight()" class="btn btn-dark btn-sm waves-effect waves-light rounded mb-2">
                        <i class="mdi mdi-weight-kilogram font-14"></i> Tambah Kelas Berat Badan
                    </button>
                    <br>
                    <ul>
                        @forelse ($weight as $w)
                            <li>
                                <span class="me-2">{{ $w->kelas_berat }} ({{ $w->minimal_berat }} -
                                    {{ $w->maksimal_berat }})</span>
                                <button class="btn btn-link p-0 m-0" onclick="editWeight('{{ $w->uuid }}')">
                                    <i class="mdi mdi-pencil font-14 bg-warning rounded text-dark px-1"></i>
                                </button>
                                <form action="{{ route('admin.setting.destroyWeight', $w->uuid) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-link p-0 m-0">
                                        <i class="mdi mdi-trash-can font-14 bg-danger rounded text-light px-1"></i>
                                    </button>
                                </form>
                            </li>
                        @empty
                            Tidak ada data kelas berat!
                        @endforelse
                    </ul>
                    <hr>
                    <label for="">Pengaturan Waktu</label><br>
                    <button onclick="addTime()" class="btn btn-dark btn-sm waves-effect waves-light rounded mb-2">
                        <i class="mdi mdi-timelapse font-14"></i> Tambah Pengaturan Waktu
                    </button>
                    <ul>
                        @forelse ($time as $t)
                            <li>
                                <span class="me-2">{{ $t->waktu }} ({{ $t->jam_mulai }} -
                                    {{ $t->jam_selesai }})</span>
                                <button class="btn btn-link p-0 m-0" onclick="editTime('{{ $t->id }}')">
                                    <i class="mdi mdi-pencil font-14 bg-warning rounded text-dark px-1"></i>
                                </button>
                                <form action="{{ route('admin.setting.destroyTime', $t->id) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-link p-0 m-0">
                                        <i class="mdi mdi-trash-can font-14 bg-danger rounded text-light px-1"></i>
                                    </button>
                                </form>
                            </li>
                        @empty
                            Tidak ada data waktu!
                        @endforelse
                    </ul>
                </x-admin.card>
            </div>
        </div>
    </div>

    {{-- Modal Section --}}
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
        function addWeight() {
            let url = "{{ route('admin.setting.addWeight') }}";
            $.ajax({
                url,
                success: function(res) {
                    let modal = document.getElementById('modal');
                    let modalTitle = modal.querySelector('.modal-title');
                    let modalBody = modal.querySelector('.modal-body');
                    $('#bodyModal').html(res);
                    modalTitle.textContent = 'Tambah Pengaturan Berat';
                    $('#modal').modal('show')
                },
                error: function(err) {
                    console.log(err);
                    alert(err.responseJSON.message)
                }
            })
        }

        function editWeight(id) {
            let url = "{{ route('admin.setting.editWeight', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                url,
                success: function(res) {
                    let modal = document.getElementById('modal');
                    let modalTitle = modal.querySelector('.modal-title');
                    let modalBody = modal.querySelector('.modal-body');
                    $('#bodyModal').html(res);
                    modalTitle.textContent = 'Ubah Pengaturan Berat';
                    $('#modal').modal('show')
                },
                error: function(err) {
                    console.log(err);
                    alert(err.responseJSON.message)
                }
            })
        }

        function addTime() {
            let url = "{{ route('admin.setting.addTime') }}";
            $.ajax({
                url,
                success: function(res) {
                    let modal = document.getElementById('modal');
                    let modalTitle = modal.querySelector('.modal-title');
                    let modalBody = modal.querySelector('.modal-body');
                    $('#bodyModal').html(res);
                    modalTitle.textContent = 'Tambah Pengaturan Waktu';
                    $('#modal').modal('show')
                },
                error: function(err) {
                    console.log(err);
                    alert(err.responseJSON.message)
                }
            })
        }

        function editTime(id) {
            let url = "{{ route('admin.setting.editTime', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                url,
                success: function(res) {
                    let modal = document.getElementById('modal');
                    let modalTitle = modal.querySelector('.modal-title');
                    let modalBody = modal.querySelector('.modal-body');
                    $('#bodyModal').html(res);
                    modalTitle.textContent = 'Ubah Pengaturan Waktu';
                    $('#modal').modal('show')
                },
                error: function(err) {
                    console.log(err);
                    alert(err.responseJSON.message)
                }
            })
        }
    </script>
@endpush
