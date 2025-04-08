@props(['name', 'label', 'placeholder' => '', 'rows' => 3])

<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <textarea
        name="{{ $name }}"
        id="{{ $name }}"
        class="form-control @error($name) is-invalid @enderror"
        placeholder="{{ $placeholder }}"
        rows="{{ $rows }}">{{ old($name, $slot) }}</textarea>
    @error($name)
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
