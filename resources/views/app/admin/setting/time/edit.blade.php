<x-admin.form.form :method="'PUT'" :route="route('admin.setting.updateTime', $time->id)">
    <x-admin.form.input label='Waktu' name="waktu" edit="{{ $time->waktu }}" placeholder="Waktu" />
    <x-admin.form.input type="time" label='Jam Mulai' edit="{{ $time->jam_mulai }}" name="jam_mulai" placeholder="Jam Mulai" />
    <x-admin.form.input type="time" label='Jam Selesai' edit="{{ $time->jam_selesai }}" name="jam_selesai" placeholder="Jam Selesai" />
    <x-admin.form.submit classes="btn-dark rounded-3" name="Ubah Waktu"  />
</x-admin.form.form>