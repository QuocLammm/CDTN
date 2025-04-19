@extends('layouts.app')

@section('title', 'Chọn sản phẩm thanh toán')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6 text-center">Chọn sản phẩm để thanh toán</h1>

        <div class="product-grid">
            @foreach ($products as $product)
                <div class="product-card">
                    <img src="{{ asset($product['Image']) }}" alt="{{ $product['ProductName'] }}" class="w-full">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">{{ $product['ProductName'] }}</h3>
                        <p class="text-gray-600 text-sm mb-2">{{ $product['Description'] }}</p>
                        <p class="text-red-500 font-bold text-base mb-4">
                            {{ number_format($product['Price'], 0, ',', '.') }} VND
                        </p>
                        <a href="{{ route('vnpay.payment.product', ['ProductID' => $product['ProductID']]) }}"
                           class="choose-button">
                            Chọn sản phẩm này
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        @isset($selectedProduct)
            <div class="mt-12 bg-white p-6 rounded-xl shadow-md max-w-xl mx-auto">
                <h2 class="text-xl font-semibold mb-4 text-center text-green-600">
                    Thanh toán sản phẩm: {{ $selectedProduct['ProductName'] }}
                </h2>
                <form action="{{ route('vnpay.createPayment') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="ProductID" value="{{ $selectedProduct['ProductID'] }}">
                    <input type="hidden" name="ProductName" value="{{ $selectedProduct['ProductName'] }}">
                    <input type="hidden" name="Price" value="{{ $selectedProduct['Price'] }}">
                    <button type="submit"
                            class="w-full bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-xl font-medium transition">
                        Tiến hành thanh toán
                    </button>
                </form>
            </div>
        @endisset
    </div>
@endsection
