@props(['attr' => ''])
{{-- @dd() --}}
<form action="{{ $route }}" method="{{ $methodForm }}" {{ $attributes }}>
    @csrf
    @method($method)
    {{ $slot }}
</form>
