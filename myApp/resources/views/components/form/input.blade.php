@props(['name', 'label', 'type' => 'text', 'placeholder' => ''])

<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <input
        type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
        class="form-control @error($name) is-invalid @enderror" value="{{ old($name, $attributes->get('value')) }}"
        placeholder="{{ $placeholder }}"{{ $attributes->merge(['readonly' => $attributes->get('readonly')]) }}>
    @error($name)
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
