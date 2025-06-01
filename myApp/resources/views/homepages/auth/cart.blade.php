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
        <h2 style="text-align: center">Giỏ hàng của bạn</h2>
        @if($cartItems->isEmpty())
            <p style="text-align: center">Giỏ hàng của bạn hiện tại trống.</p>
        @else
            @foreach($cartItems as $item)
                <div class="cart-card d-flex gap-3">
                    <form action="{{ route('cart.remove', $item->cart_item_id) }}" method="POST"
                          class="delete-form" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn-xoa-icon" type="submit">&times;</button>
                    </form>

                    <div class="cart-card-left col-4">
                        <img src="{{ $item->product->images->first()->image_path ?? 'default.jpg' }}"
                             alt="{{ $item->product->product_name }}"
                             class="img-fluid rounded">
                    </div>
                    <div class="cart-card-right col-8 d-flex flex-column justify-content-between">
                        <div class="d-flex justify-content-between align-items-start">
                            <h5 class="mb-2 cart-product-name">{{ Str::limit($item->product->product_name, 30, '...') }}</h5>
                        </div>
                        <div class="cart-quantity d-flex justify-content-end align-items-center">
                            <button class="btn-quantity decrease">-</button>
                            <span class="quantity">{{ $item->quantity }}</span>
                            <button class="btn-quantity increase">+</button>
                        </div>
                        @php
                            $unitPrice = $item->product->is_sale ? $item->product->sale_price : $item->product->price;
                        @endphp
                        <p class="cart-line-total mb-2 text-end">
                            Đơn giá: <strong>{{ number_format($unitPrice * $item->quantity) }}₫</strong>
                        </p>
                    </div>
                </div>
            @endforeach

            <div class="cart-total-actions align-items-center">
                <p class="mb-0">
                    <span class="total-label">Tổng cộng:</span>
                    <span class="total-amount">
                        @php
                            $total = $cartItems->sum(function($item) {
                                $unitPrice = $item->product->is_sale ? $item->product->sale_price : $item->product->price;
                                return $unitPrice * $item->quantity;
                            });
                        @endphp
                        {{ number_format($total, 0, ',', '.') }} đ
                    </span>
                </p>
                <form id="checkout-form" action="{{ route('order.process') }}" method="POST" style="display: none;">
                    @csrf

                </form>
                <button id="checkout-button">Thanh toán</button>
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
                    // Gửi form POST đến route order.process
                    document.getElementById('checkout-form').submit();
                }
            });
        });

    </script>
@endpush
@section('footer')
    <div class="site-footer">
        @include('homepages.auth.footer_no_sale')
    </div>
@endsection
