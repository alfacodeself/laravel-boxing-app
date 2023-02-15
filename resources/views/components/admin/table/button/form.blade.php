@props(['action' => '#', 'method' => 'post', 'classes' => 'btn-primary btn-sm'])

<form action="{{ $action }}" method="post" class="d-inline">
    @csrf
    @method( strtoupper($method) )
    <button type="submit" class="btn {{ $classes }} waves-effect waves-light">
        {{ $slot }}
    </button>
</form>
