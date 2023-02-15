@extends('layouts.admin.app')
@section('title', 'Dashboard Member')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        @include('layouts.admin.alert')
        <x-admin.form.form :method="'PUT'" :route="route('member.profile.update')" enctype="multipart/form-data">
            <div class="row">
                <div class="col-xl-6">
                    <x-admin.card :title="'Biodata'">
                        <center>
                            <img src="{{ auth()->user()->member->foto == null ? asset('assets/images/default-avatar.png') : url(auth()->user()->member->foto) }}"
                                class="rounded-circle avatar-xl img-thumbnail mb-1" alt="profile-image">
                        </center>
                        <x-admin.form.input type="file" label='Foto' name="foto" placeholder="Foto" />
                        <x-admin.form.input label='Nama' edit="{{ auth()->user()->member->nama }}" name="nama" placeholder="Nama" />
                        <x-admin.form.input label='Tempat Lahir' name="tempat_lahir" edit="{{ auth()->user()->member->tempat_lahir }}" placeholder="Tempat Lahir" />
                        <x-admin.form.input type="date" label='Tanggal Lahir' name="tanggal_lahir" edit="{{ auth()->user()->member->tanggal_lahir }}"
                            placeholder="Tanggal Lahir" />
                    </x-admin.card>
                </div>
                <div class="col-xl-6">
                    <x-admin.card :title="'Alamat dan Kontak'">
                        <x-admin.form.text-area label="Alamat" name="alamat" placeholder="Alamat" />
                        <x-admin.form.input label='Nomor Telpon' edit="{{ auth()->user()->member->nomor_hp }}" name="nomor_hp" placeholder="Nomor Telpon" />
                        
                        <x-admin.form.submit classes="btn-dark rounded-3" name="Ubah Profil" />
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
                editor.setData('{!! auth()->user()->member->alamat !!}')
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
