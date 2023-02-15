<x-admin.form.form :method="'PATCH'" :route="route('admin.program.update', $programClass->slug)" enctype="multipart/form-data" attr="enctype=multipart/form-data">
    <div class="row">
        <div class="col-xl-12">
            <x-admin.card :title="'Program Kelas'">
                <center>
                    <img src="{{ $programClass->thumbnail != null ? url($programClass->thumbnail) : asset('assets/images/default-avatar.png') }}"
                        class="rounded-circle avatar-xl img-thumbnail mb-1" alt="profile-image">
                </center>
                <x-admin.form.input type="file" label='Thumbnail' name="thumbnail" placeholder="Thumbnail" />
                <x-admin.form.input label='Nama' name="nama" edit="{{ $programClass->nama }}" placeholder="Nama" />
                <x-admin.form.input label='Deskripsi' name="deskripsi" edit="{{ $programClass->deskripsi }}" placeholder="Deskripsi" />
                <x-admin.form.input type="number" label='Harga Per Bulam' name="harga_per_bulan"
                    placeholder="Harga Per Bulam" edit="{{ $programClass->harga_per_bulan }}"/>
                <x-admin.form.submit classes="btn-dark rounded-3" name="Ubah Program Kelas {{ $programClass->nama }}" />
            </x-admin.card>
        </div>
    </div>
</x-admin.form.form>
