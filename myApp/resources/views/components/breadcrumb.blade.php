@props(['items' => []])

<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent p-0 m-0">
            @foreach ($items as $item)
                @if (!$loop->last)
                    <li class="breadcrumb-item">
                        <a href="{{ $item['url'] }}" class="text-dark fw-semibold" style="font-size: 1.1rem;">
                            {{ $item['label'] }}
                        </a>
                    </li>
                @else
                    <li class="breadcrumb-item active text-danger fw-bold" aria-current="page" style="font-size: 1.1rem;">
                        {{ $item['label'] }}
                    </li>

                @endif
            @endforeach
        </ol>
    </nav>
</div>
