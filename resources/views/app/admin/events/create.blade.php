@extends('layouts.admin.app')
@section('title', 'Buat Even')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        @include('layouts.admin.alert')
        <div class="row">
            <div class="col-xl-12">
                <x-admin.form.form :method="'post'" :route="route('admin.event.store')">
                    <x-admin.card :title="'Buat Even'">
                        <x-admin.form.input label='Nama' name="nama" placeholder="Nama" />
                        <x-admin.form.text-area label="Deskripsi" name="deskripsi" placeholder="Deskripsi" />
                        <x-admin.form.input type="datetime-local" label='Tanggal Even' name="tanggal" placeholder="Tanggal Even" />
                        <x-admin.form.submit classes="btn-dark rounded-3" name="Simpan Even" />
                    </x-admin.card>
                </x-admin.form.form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/libs/ckeditor/ckeditor.js') }}"></script>

    <script>
        ClassicEditor.create(document.querySelector('#deskripsi'), {
                toolbar: {
                    items: [
                        'selectAll', '|',
                        'heading', '|',
                        'bold', 'italic', '|',
                        'bulletedList', 'numberedList', 'todoList', '|',
                        'outdent', 'indent', '|',
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
            min-height: 150px;
        }
    </style>
@endpush
