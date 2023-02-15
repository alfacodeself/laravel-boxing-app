@props(['classes' => 'table table-hover mb-0', 'attr' => ''])

<div class="table-responsive">
    <table class="{{ $classes }}" {{ $attr }}>
        <thead>
            <tr>
                @foreach ($headers as $header)
                    <th>{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            {{ $slot }}
        </tbody>
    </table>
</div>