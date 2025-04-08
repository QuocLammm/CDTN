@extends('layouts.app')

@section('title', 'Chọn sản phẩm thanh toán')

@section('content')
    <h1>Chọn sản phẩm để thanh toán</h1>

    <div class="product-grid">
        @foreach ($products as $product)
            <div class="product-card">
                <img src="{{ asset($product['Image']) }}" alt="{{ $product['ProductName'] }}">
                <h3>{{ $product['ProductName'] }}</h3>
                <p>{{ $product['Description'] }}</p>
                <p><strong>{{ number_format($product['Price'], 0, ',', '.') }} VND</strong></p>
                <a href="{{ route('vnpay.payment.product', ['ProductID' => $product['ProductID']]) }}">
                    Chọn sản phẩm này
                </a>
            </div>
        @endforeach
    </div>

    @isset($selectedProduct)
        <div class="payment-form">
            <h2>Thanh toán sản phẩm: {{ $selectedProduct['ProductName'] }}</h2>
            <form action="{{ route('vnpay.createPayment') }}" method="POST">
                @csrf
                <input type="hidden" name="ProductID" value="{{ $selectedProduct['ProductID'] }}">
                <input type="hidden" name="ProductName" value="{{ $selectedProduct['ProductName'] }}">
                <input type="hidden" name="Price" value="{{ $selectedProduct['Price'] }}">
                <button type="submit">Tiến hành thanh toán</button>
            </form>
        </div>
    @endisset
@endsection
