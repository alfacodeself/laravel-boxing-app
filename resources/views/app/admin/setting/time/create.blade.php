<x-admin.form.form :method="'POST'" :route="route('admin.setting.storeTime')">
    <x-admin.form.input label='Waktu' name="waktu" placeholder="Waktu" />
    <x-admin.form.input type="time" label='Jam Mulai' name="jam_mulai" placeholder="Jam Mulai" />
    <x-admin.form.input type="time" label='Jam Selesai' name="jam_selesai" placeholder="Jam Selesai" />
    <x-admin.form.submit classes="btn-dark rounded-3" name="Tambah Waktu"  />
</x-admin.form.form>