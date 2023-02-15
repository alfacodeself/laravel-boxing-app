<x-admin.form.form :method="'POST'" :route="route('trainer.program.member.storeWeight', [$programs->slug, $member->uuid])" id="modal-form">
    <div class="mb-2">
        <label for="weight_class" class="form-label">Kelas Berat</label>
        <select name="weight_class" id="weight_class" class="form-control">
            @foreach ($weight as $w)
                <option value="{{ $w->uuid }}">{{ $w->kelas_berat }} ({{ $w->minimal_berat }} - {{ $w->maksimal_berat }})</option>
            @endforeach
        </select>
        @error('weight_class')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <x-admin.form.input label='Tinggi Badan (cm)' name="tinggi_badan" placeholder="Tinggi Badan" />
    <x-admin.form.input label='Berat Badan (kg)' name="berat_badan" placeholder="Berat Badan" />
    <x-admin.form.input label='Catatan' name="keterangan" placeholder="Catatan" />
    <x-admin.form.submit classes="btn-dark rounded-3" name="Masukkan Pengukuran Kelas" />
</x-admin.form.form>