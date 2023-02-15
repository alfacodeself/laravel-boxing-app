@extends('layouts.admin.app')
@section('title', 'Profil')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        @include('layouts.admin.alert')
        <div class="row">
            <div class="col-xl-5">
                <x-admin.form.form :method="'post'" :route="route('admin.profile.store')" enctype="multipart/form-data">
                    <x-admin.card :title="'Profile'">
                        @isset($admin)
                            <x-admin.form.input type="file" label='Foto' name="foto" placeholder="Foto" />
                            <x-admin.form.input label='Nama' name="nama" edit="{{ $admin->nama }}" placeholder="Nama" />
                            <x-admin.form.text-area label="Alamat" name="alamat" edit="{!! $admin->alamat !!}"
                                placeholder="Alamat" />
                            <x-admin.form.input label='Nomor Telpon' name="nomor_hp" edit="{{ $admin->nomor_hp }}"
                                placeholder="Nomor Telpon" />
                            <x-admin.form.submit classes="btn-dark rounded-3" name="Simpan Profil" />
                        @else
                            <x-admin.form.input type="file" label='Foto' name="foto" placeholder="Foto" />
                            <x-admin.form.input label='Nama' name="nama" placeholder="Nama" />
                            <x-admin.form.text-area label="Alamat" name="alamat" placeholder="Alamat" />
                            <x-admin.form.input label='Nomor Telpon' name="nomor_hp" placeholder="Nomor Telpon" />
                            <x-admin.form.submit classes="btn-dark rounded-3" name="Simpan Profil" />
                        @endisset
                    </x-admin.card>
                </x-admin.form.form>
            </div>
            <div class="col-md-7">
                <x-admin.card :title="'Profile'">
                    <div class="text-center card-body">
                        @isset($admin)
                            <div>
                                <img src="{{ url($admin->foto) }}" class="rounded-circle avatar-xl img-thumbnail mb-2"
                                    alt="profile-image">

                                <p class="font-13 mb-3">
                                    {!! $admin->alamat !!}
                                </p>

                                <div class="text-start">
                                    <p class="font-13">
                                        <strong>Nama :</strong>
                                        <span class="ms-2">{{ $admin->nama }}</span>
                                    </p>
                                </div>
                                <div class="text-start">
                                    <p class="font-13">
                                        <strong>Nomor Telepon :</strong>
                                        <span class="ms-2">{{ $admin->nomor_hp }}</span>
                                    </p>
                                </div>
                            </div>
                        @else
                            Anda belum memiliki profil
                        @endisset
                    </div>
                </x-admin.card>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/libs/ckeditor/ckeditor.js') }}"></script>
    @isset($admin)
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
                    editor.setData('{!! $admin ? $admin->alamat : '' !!}')
                })
                .catch(error => {
                    alert(error);
                });
        </script>
    @else
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
    @endisset
@endpush
@push('css')
    <style>
        .ck-editor__editable[role="textbox"] {
            /* editing area */
            min-height: 80px;
        }
    </style>
@endpush
