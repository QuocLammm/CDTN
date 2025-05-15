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
                    <th>Thao tác</th>
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
                        <td>
                            <button class="btn-quantity decrease">-</button>
                            <span class="quantity">{{ $item->quantity }}</span>
                            <button class="btn-quantity increase">+</button>
                        </td>
                        <td class="line-total" data-price="{{ $item->product->price }}">
                            {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }} đ
                        </td>
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
                <button class="btn-checkout" id="checkout-button">Mua hàng</button>
            </div>
        @endif
    </div>
@endsection
@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const formatter = new Intl.NumberFormat('vi-VN');

            document.querySelectorAll('.cart-table tbody tr').forEach(row => {
                const btnIncrease = row.querySelector('.increase');
                const btnDecrease = row.querySelector('.decrease');
                const quantityEl = row.querySelector('.quantity');
                const price = parseInt(row.querySelector('.line-total').dataset.price);
                const lineTotalEl = row.querySelector('.line-total');

                btnIncrease.addEventListener('click', () => {
                    let quantity = parseInt(quantityEl.innerText);
                    quantityEl.innerText = ++quantity;
                    updateLineTotal();
                    updateCartTotal();
                });

                btnDecrease.addEventListener('click', () => {
                    let quantity = parseInt(quantityEl.innerText);
                    if (quantity > 1) {
                        quantityEl.innerText = --quantity;
                        updateLineTotal();
                        updateCartTotal();
                    }
                });

                function updateLineTotal() {
                    const quantity = parseInt(quantityEl.innerText);
                    const lineTotal = price * quantity;
                    lineTotalEl.innerText = formatter.format(lineTotal) + ' đ';
                }
            });

            function updateCartTotal() {
                let total = 0;
                document.querySelectorAll('.line-total').forEach(cell => {
                    total += parseInt(cell.innerText.replace(/[^\d]/g, ''));
                });
                document.querySelector('.cart-total p').innerHTML = 'Tổng cộng: ' + formatter.format(total) + ' đ';
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
                    // Redirect to checkout route
                    window.location.href = '{{ route("checkout") }}';
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
