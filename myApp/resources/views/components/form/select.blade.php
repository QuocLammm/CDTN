@props(['name', 'label', 'options' => [], 'selected' => null])

<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <select name="{{ $name }}" class="form-select @error($name) is-invalid @enderror">
        <option value="">-- Chọn {{ strtolower($label) }} --</option>
        @foreach ($options as $value => $text)
            <option value="{{ $value }}" {{ old($name, $selected) == $value ? 'selected' : '' }}>{{ $text }}</option>
        @endforeach
    </select>
    @error($name)
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
