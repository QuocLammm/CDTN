@extends('layouts.app')

@section('title', 'Chọn sản phẩm thanh toán')

@section('content')
    <h1>Chọn sản phẩm để thanh toán</h1>

    <div class="product-grid">
        @foreach ($products as $product)
            <div class="product-card">
                <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}">
                <h3>{{ $product['name'] }}</h3>
                <p>{{ $product['description'] }}</p>
                <p><strong>{{ number_format($product['price'], 0, ',', '.') }} VND</strong></p>
                <a href="{{ route('vnpay.payment.product', ['product_id' => $product['id']]) }}">
                    Chọn sản phẩm này
                </a>
            </div>
        @endforeach
    </div>

    @isset($selectedProduct)
        <div class="payment-form">
            <h2>Thanh toán sản phẩm: {{ $selectedProduct['name'] }}</h2>
            <form action="{{ route('vnpay.createPayment') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $selectedProduct['id'] }}">
                <input type="hidden" name="product_name" value="{{ $selectedProduct['name'] }}">
                <input type="hidden" name="product_price" value="{{ $selectedProduct['price'] }}">
                <button type="submit">Tiến hành thanh toán</button>
            </form>
        </div>
    @endisset
@endsection
