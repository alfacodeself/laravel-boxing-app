@extends('layouts.admin.app')
@section('title', 'Profile')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        @include('layouts.admin.alert')
        <x-admin.form.form :method="'POST'" :route="route('trainer.profile.store')" enctype="multipart/form-data">
            <div class="row">
                <div class="col-xl-6">
                    <x-admin.card :title="'Biodata'">
                        <x-admin.form.input type="file" label='Foto' name="foto" placeholder="Foto" />
                        <x-admin.form.input label='Nama' name="nama" placeholder="Nama" />
                            <x-admin.form.input label='Tempat Lahir' name="tempat_lahir"
                                placeholder="Tempat Lahir" />
                        <x-admin.form.input type="date" label='Tanggal Lahir' name="tanggal_lahir" placeholder="Tanggal Lahir" />
                        <h4 class="header-title mt-0 mb-3">Dokumen Trainer</h4>
                        <x-admin.form.input type="file" label='Foto KTP' name="foto_ktp" placeholder="Foto KTP" />
                        <x-admin.form.input type="file" label='Curriculum Vitae' name="cv" placeholder="Curriculum Vitae" />
                    </x-admin.card>
                </div>
                <div class="col-xl-6">
                    <x-admin.card :title="'Alamat dan Kontak'">
                        <x-admin.form.text-area label="Alamat" name="alamat" placeholder="Alamat" />
                        <x-admin.form.input label='Nomor Telpon' name="nomor_hp" placeholder="Nomor Telpon" />

                        <x-admin.form.submit classes="btn-dark rounded-3" name="Buat Profil" />
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
