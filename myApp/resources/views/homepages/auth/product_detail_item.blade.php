@extends('homepages.master_page')
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/homepage/product_item.css') }}">
@endpush
@section('header')
    <div class="site-header">
        @include('homepages.auth.header')
    </div>
@endsection
@section('content')
    <div class="main-content">
        <div class="product-detail-container">
            <img src="{{ $product->image }}" alt="{{ $product->product_name }}" class="product-detail-image">

            <div class="product-detail-info">
                <h2>{{ $product->product_name }}</h2>
                <div class="product-price">{{ number_format($product->price, 0, ',', '.') }} đ</div>
                <div class="product-description">
                    {{ $product->description ?? 'Không có mô tả sản phẩm.' }}
                </div>
                <a href="{{ route('buy.now', $product->product_id) }}" class="buy-button">Mua ngay</a>
                <form action="{{ route('cart.add', $product->product_id) }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="add-to-cart-button">Thêm vào giỏ hàng</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <div class="site-footer">
        @include('homepages.auth.footer')
    </div>
@endsection

