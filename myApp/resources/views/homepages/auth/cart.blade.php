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
            <div class="cart-card-container">
                @foreach($cartItems as $item)
                    <div class="cart-card">
                        <div class="cart-card-left">
                            <img src="{{ $item->product->images->first()->image_path ?? 'default.jpg' }}" alt="{{ $item->product->product_name }}">
                        </div>

                        <div class="cart-card-right">
                            <div class="cart-product-name">{{ $item->product->product_name }}</div>
                            <div class="cart-product-details">
                            <span class="cart-quantity">
                                <button class="btn-quantity decrease">-</button>
                                <span class="quantity">{{ $item->quantity }}</span>
                                <button class="btn-quantity increase">+</button>
                            </span>
                                <span class="cart-price">{{ number_format($item->product->price) }}₫</span>
                            </div>
                            <div class="cart-line-total">
                                Thành tiền: <strong>{{ number_format($item->product->price * $item->quantity) }}₫</strong>
                            </div>
                            <form action="{{ route('cart.remove', $item->cart_item_id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">Xóa</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
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
                <button class="btn-checkout" id="checkout-button">Mua hàng</button>
            </div>
        @endif
    </div>
@endsection
@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const formatter = new Intl.NumberFormat('vi-VN');

            document.querySelectorAll('.cart-card').forEach(card => {
                const btnIncrease = card.querySelector('.increase');
                const btnDecrease = card.querySelector('.decrease');
                const quantityEl = card.querySelector('.quantity');
                const lineTotalEl = card.querySelector('.cart-line-total strong');
                const price = parseInt(card.querySelector('.cart-price').innerText.replace(/[^\d]/g, ''));

                function updateLineTotal() {
                    const quantity = parseInt(quantityEl.innerText);
                    const lineTotal = price * quantity;
                    lineTotalEl.innerText = formatter.format(lineTotal) + '₫';
                    updateCartTotal();
                }

                btnIncrease.addEventListener('click', () => {
                    let quantity = parseInt(quantityEl.innerText);
                    quantityEl.innerText = ++quantity;
                    updateLineTotal();
                });

                btnDecrease.addEventListener('click', () => {
                    let quantity = parseInt(quantityEl.innerText);
                    if (quantity > 1) {
                        quantityEl.innerText = --quantity;
                        updateLineTotal();
                    }
                });
            });

            function updateCartTotal() {
                let total = 0;
                document.querySelectorAll('.cart-line-total strong').forEach(el => {
                    total += parseInt(el.innerText.replace(/[^\d]/g, ''));
                });
                document.querySelector('.cart-total p').innerHTML = 'Tổng cộng: ' + formatter.format(total) + '₫';
            }
        });
    </script>

    <script>
        document.getElementById('checkout-button').addEventListener('click', function() {
            Swal.fire({
                title: 'Xác nhận đơn hàng?',
                text: "Bạn muốn xác nhận thanh toán cho đơn hàng này!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Có, xác nhận!',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Nếu xác nhận, chuyển đến trang thanh toán
                    window.location.href = '{{ route("checkout") }}';
                } else {
                    // Nếu hủy, gửi yêu cầu hủy đơn hàng
                    // document.getElementById('cancel-order-form').submit();
                }
            });
        });
    </script>
@endpush
@section('footer')
    <div class="site-footer">
        @include('homepages.auth.footer')
    </div>
@endsection
