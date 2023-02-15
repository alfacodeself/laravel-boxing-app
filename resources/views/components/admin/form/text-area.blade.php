@props(['rows' => 3, 'label', 'name', 'placeholder', 'edit' => null])
<div class="mb-2">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <textarea name="{{ $name }}" id="{{ $name }}" rows="{{ $rows }}" class="form-control" placeholder="{{ $placeholder }}">{{ $edit == null ? old($name) : old($name, $edit)  }}</textarea>
    @error($name)
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>