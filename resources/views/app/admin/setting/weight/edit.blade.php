<x-admin.form.form :method="'PUT'" :route="route('admin.setting.updateWeight', $weightClass->uuid)">
    <x-admin.form.input label='Kelas Berat' name="kelas_berat" edit="{{ $weightClass->kelas_berat }}" placeholder="Kelas Berat" />
    <x-admin.form.input type="number" label='Minimal Berat' edit="{{ $weightClass->minimal_berat }}" name="minimal_berat" placeholder="Minimal Berat" />
    <x-admin.form.input type="number" label='Maksimal Berat' edit="{{ $weightClass->maksimal_berat }}" name="maksimal_berat" placeholder="Maksimal Berat" />
    <x-admin.form.submit classes="btn-dark rounded-3" name="Ubah Kelas Berat"  />
</x-admin.form.form>