<x-admin.form.form :method="'POST'" :route="route('member.program.store', $programClass->slug)">
    <x-admin.form.input type="number" label='Berlangganan Selama (Bulan)' name="berlangganan_selama"
        placeholder="Berlangganan Selama (Bulan)" />
    <x-admin.form.submit classes="btn-dark rounded-3" name="Beli Program Kelas {{ $programClass->nama }}" />
</x-admin.form.form>
