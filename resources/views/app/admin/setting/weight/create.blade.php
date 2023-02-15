<x-admin.form.form :method="'POST'" :route="route('admin.setting.storeWeight')">
    <x-admin.form.input label='Kelas Berat' name="kelas_berat" placeholder="Kelas Berat" />
    <x-admin.form.input type="number" label='Minimal Berat' name="minimal_berat" placeholder="Minimal Berat" />
    <x-admin.form.input type="number" label='Maksimal Berat' name="maksimal_berat" placeholder="Maksimal Berat" />
    <x-admin.form.submit classes="btn-dark rounded-3" name="Tambah Kelas Berat"  />
</x-admin.form.form>