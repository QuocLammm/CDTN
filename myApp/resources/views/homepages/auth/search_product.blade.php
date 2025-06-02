@extends('homepages.master_page')
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/homepage/search_product.css') }}">
@endpush
@section('header')
    <div class="site-header">
        @include('homepages.auth.header')
    </div>
@endsection
@section('content')
    <div class="main-content">
        <h2>Kết quả tìm kiếm cho: {{ $keyword }}</h2>
        {{-- Danh sách sản phẩm --}}
        @if ($products->isEmpty())
            <p>Không tìm thấy sản phẩm nào phù hợp.</p>
        @else
        <div class="features" id="product-list">
            @foreach ($products as $product)
                <a href="{{ route('product.show', $product->product_id) }}" class="card-link">
                    <div class="card">
                        <img src="{{ $product->images()->first()->image_path }}" alt="{{ $product->product_name }}" class="product-image"
                             style="width: 100%; height: 300px; object-fit: cover;">
                        <h4 class="product-name" style="text-align: center;">{{ $product->product_name }}</h4>
                        <div class="product-price d-flex align-items-center justify-content-center gap-2">
                            @if ($product->is_sale && $product->sale_price < $product->price)
                                <span class="current-price text-danger fw-bold">{{ number_format($product->sale_price) }} đ</span>
                                <span class="original-price text-muted" style="text-decoration: line-through;">{{ number_format($product->price) }}vnđ</span>
                                <span class="badge bg-danger" style="font-size: 0.75rem;">
                                    -{{ round((($product->price - $product->sale_price) / $product->price) * 100) }}%
                                </span>
                            @else
                                <span class="current-price">{{ number_format($product->price) }} đ</span>
                            @endif
                        </div>
                    </div>
                </a>
            @endforeach
        @endif
        </div>
@endsection

@section('footer')
    <div class="site-footer">
        @include('homepages.auth.footer_no_sale')
    </div>
@endsection
