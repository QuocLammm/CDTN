@extends('homepages.master_page')
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/homepage/cart_item.css') }}">
@endpush
@section('header')
    <div class="site-header">
        @include('homepages.auth.header')
    </div>
@endsection
@section('content')
    <div class="main-content">
        <h2>Giỏ hàng của bạn</h2>
        @if($cartItems->isEmpty())
            <p>Giỏ hàng của bạn hiện tại trống.</p>
        @else
            <table class="cart-table">
                <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Tổng</th>
                </tr>
                </thead>
                <tbody>
                @foreach($cartItems as $item)
                    <tr>
                        <td>
                            <img src="{{ $item->product->image }}" alt="{{ $item->product->product_name }}" class="cart-item-image">
                            {{ $item->product->product_name }}
                        </td>
                        <td>{{ number_format($item->product->price, 0, ',', '.') }} đ</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->product->price * $item->quantity, 0, ',', '.') }} đ</td>
                        <td>
                            <form action="{{ route('cart.remove', $item->cart_item_id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="cart-total">
                <p>Tổng cộng:
                    @php
                        $total = $cartItems->sum(function($item) {
                            return $item->product->price * $item->quantity;
                        });
                    @endphp
                    {{ number_format($total, 0, ',', '.') }} đ
                </p>
            </div>
            <!-- Nút Mua Hàng -->
            <div class="cart-actions">
                <a href="{{ route('checkout') }}" class="btn-checkout">Mua hàng</a>
            </div>
        @endif
    </div>
@endsection

@section('footer')
    <div class="site-footer">
        @include('homepages.auth.footer')
    </div>
@endsection
