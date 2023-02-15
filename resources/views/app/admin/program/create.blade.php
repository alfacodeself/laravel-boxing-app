<x-admin.form.form :method="'POST'" :route="route('admin.program.store')" enctype="multipart/form-data" attr="enctype=multipart/form-data">
    <div class="row">
        <div class="col-xl-12">
            <x-admin.card :title="'Program Kelas'">
                <x-admin.form.input type="file" label='Thumbnail' name="thumbnail" placeholder="Thumbnail" />
                <x-admin.form.input label='Nama' name="nama" placeholder="Nama" />
                <x-admin.form.input label='Deskripsi' name="deskripsi" placeholder="Deskripsi" />
                <x-admin.form.input type="number" label='Harga Per Bulam' name="harga_per_bulan" placeholder="Harga Per Bulam" />
                <x-admin.form.submit classes="btn-dark rounded-3" name="Buat Program Kelas" />
            </x-admin.card>
        </div>
    </div>
</x-admin.form.form>
