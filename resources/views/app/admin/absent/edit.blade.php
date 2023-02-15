<x-admin.form.form :method="'PUT'" :route="route('admin.absent.edit', $absent->id)">
    <div class="mb-2">
        <label for="program_class_slug" class="form-label">Program Kelas</label>
        <select name="program_class_slug" id="program_class_slug" class="form-control">
            @foreach ($programs as $program)
                <option value="{{ $program->slug }}">{{ $program->nama }}</option>
            @endforeach
        </select>
        @error('program_class_slug')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <x-admin.form.input label='Catatan' name="catatan" placeholder="Catatan" />
    <x-admin.form.submit classes="btn-dark rounded-3" name="Ubah Absensi" />
</x-admin.form.form>