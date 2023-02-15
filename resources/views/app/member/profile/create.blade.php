@extends('layouts.admin.app')
@section('title', 'Dashboard Member')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        @include('layouts.admin.alert')
        <x-admin.form.form :method="'post'" :route="route('member.profile.store')" enctype="multipart/form-data">
            <div class="row">
                <div class="col-xl-4">
                    <x-admin.card :title="'Biodata'">
                        <x-admin.form.input type="file" label='Foto' name="foto" placeholder="Foto" />
                        <x-admin.form.input label='Nama' name="nama" placeholder="Nama" />
                        <x-admin.form.input label='Tempat Lahir' name="tempat_lahir" placeholder="Tempat Lahir" />
                        <x-admin.form.input type="date" label='Tanggal Lahir' name="tanggal_lahir"
                            placeholder="Tanggal Lahir" />
                    </x-admin.card>
                </div>
                <div class="col-xl-4">
                    <x-admin.card :title="'Alamat dan Kontak'">
                        <x-admin.form.text-area label="Alamat" name="alamat" placeholder="Alamat" />
                        <x-admin.form.input label='Nomor Telpon' name="nomor_hp" placeholder="Nomor Telpon" />
                    </x-admin.card>
                </div>
                <div class="col-xl-4">
                    <x-admin.card :title="'Kelas Berat Badan'">
                        <div class="mb-2">
                            <label for="weight_class" class="form-label">Kelas Berat</label>
                            <select name="weight_class" id="weight_class" class="form-control">
                                @foreach ($weight as $w)
                                    <option value="{{ $w->uuid }}">{{ $w->kelas_berat }} ({{ $w->minimal_berat }} - {{ $w->maksimal_berat }})</option>
                                @endforeach
                            </select>
                            @error('weight_class')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <x-admin.form.input type="number" label='Tinggi Badan (cm)' name="tinggi_badan"
                            placeholder="Tinggi Badan" />
                        <x-admin.form.input type="number" label='Berat Badan (kg)' name="berat_badan"
                            placeholder="Binggi Badan" />
                        <x-admin.form.submit classes="btn-dark rounded-3" name="Simpan Profil" />
                    </x-admin.card>
                </div>
            </div>
        </x-admin.form.form>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/libs/ckeditor/ckeditor.js') }}"></script>
    <script>
        ClassicEditor.create(document.querySelector('#alamat'), {
                toolbar: {
                    items: [
                        'selectAll', '|',
                        // 'heading', '|',
                        'bold', 'italic', '|',
                        // 'bulletedList', 'numberedList', 'todoList', '|',
                        // 'outdent', 'indent', '|',
                        'undo', 'redo',
                    ],
                    shouldNotGroupWhenFull: true
                },
            })
            .then(editor => {
                editor.setData('')
            })
            .catch(error => {
                alert(error);
            });
    </script>
@endpush
@push('css')
    <style>
        .ck-editor__editable[role="textbox"] {
            /* editing area */
            min-height: 80px;
        }
    </style>
@endpush
