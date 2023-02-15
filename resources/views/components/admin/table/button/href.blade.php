@props(['href' => '#', 'classes' => 'btn-warning btn-sm', 'attr' => ''])

<a href="{{ $href }}" class="btn {{ $classes }} waves-effect waves-light" {{ $attr }}>
    {{ $slot }}
</a>
