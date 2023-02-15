<x-admin.form.form :method="'POST'" :route="route('admin.program.schedule.create', $slug)">
    @isset($schedules)
        @foreach ($days as $day)
            <div class="mb-2">
                <label for="{{ $day->id }}" class="form-label text-uppercase">{{ $day->hari }}</label>
                <br>
                @foreach ($times as $time)
                    @php
                        $check = false;
                    @endphp
                    @foreach ($schedules->where('day_id', $day->id) as $schedule)
                        @if ($schedule->time_id == $time->id)
                            @php
                                $check = true;
                            @endphp
                        @endif
                        @php
                            $val = $schedule->catatan;
                        @endphp
                    @endforeach
                    <input type="checkbox" name="{{ $day->id }}[]" {{ $check ? 'checked' : '' }} value="{{ $time->id }}">
                    {{ $time->waktu }}
                    ({{ $time->jam_mulai }} - {{ $time->jam_selesai }})
                    <br>
                @endforeach
            </div>
        @endforeach
    @else
        @foreach ($days as $day)
            <div class="mb-2">
                <label for="{{ $day->id }}" class="form-label text-uppercase">{{ $day->hari }}</label>
                <br>
                @foreach ($times as $time)
                    <input type="checkbox" name="{{ $day->id }}[]" value="{{ $time->id }}"> {{ $time->waktu }}
                    ({{ $time->jam_mulai }} - {{ $time->jam_selesai }})
                    <br>
                @endforeach
            </div>
        @endforeach
    @endisset
    <x-admin.form.submit classes="btn-dark rounded-3" name="Atur Jadwal Kelas" />
</x-admin.form.form>
