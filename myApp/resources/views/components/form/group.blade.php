@props([
    'col' => 12
])

<div class="col-md-{{ $col }}">
    {{ $slot }}
</div>
