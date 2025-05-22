@extends('homepages.master_page')
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/homepage/payment.css') }}">
@endpush
@section('header')
    <div class="site-header">
        @include('homepages.auth.header')
    </div>
@endsection

@section('content')
    <div class="main-content">
        <h2>Xác nhận đơn hàng</h2>

        @if($cartItems->isEmpty())
            <p style="text-align: center">Không có sản phẩm nào trong giỏ hàng.</p>
        @else
            {{-- Card bao ngoài --}}
            <div class="order-card-wrapper">

                {{-- Danh sách sản phẩm --}}
                <div class="cart-card-container">
                    @foreach($cartItems as $item)
                        <div class="cart-card d-flex flex-column flex-md-row gap-3">
                            <div class="cart-card-left col-md-4">
                                <img src="{{ $item->product->images->first()->image_path ?? 'default.jpg' }}"
                                     alt="{{ $item->product->product_name }}"
                                     class="img-fluid rounded">
                            </div>
                            <div class="cart-card-right col-md-8 d-flex flex-column justify-content-between">
                                <h5 class="mb-2">{{ $item->product->product_name }}</h5>
                                <p>Số lượng: {{ $item->quantity }}</p>
                                <p>Đơn giá: {{ number_format($item->product->price) }}₫</p>
                                <p class="fw-bold">Thành tiền: {{ number_format($item->product->price * $item->quantity) }}₫</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Phần chọn thanh toán --}}
                <div class="checkout-summary mt-4">
                    <p style="text-align: right"><strong>Tổng cộng: {{ number_format($total, 0, ',', '.') }}₫</strong></p>

                    <form action="{{ route('checkout') }}" method="POST" id="payment-form">
                        @csrf

                        <label for="payment-method">Chọn phương thức thanh toán:</label>
                        <select name="payment_method" id="payment-method" required>
                            <option value="" disabled selected>-- Chọn phương thức --</option>
                            <option value="cod">Thanh toán tại quầy</option>
                            <option value="bank">Thanh toán qua VNPay</option>
                        </select>

                        <button type="submit" class="btn btn-success mt-3" id="confirm-payment-btn" style="display:none;">
                            Xác nhận thanh toán
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>

@endsection
@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const paymentSelect = document.getElementById('payment-method');
            const confirmBtn = document.getElementById('confirm-payment-btn');

            paymentSelect.addEventListener('change', function() {
                if (this.value) {
                    confirmBtn.style.display = 'inline-block'; // hiện nút xác nhận
                } else {
                    confirmBtn.style.display = 'none'; // ẩn nút xác nhận
                }
            });
        });
    </script>
    <script>
        document.getElementById('payment-method').addEventListener('change', function () {
            document.getElementById('confirm-payment-btn').style.display = 'block';
        });
    </script>
@endpush

@section('footer')
    <div class="site-footer">
        @include('homepages.auth.footer_no_sale')
    </div>
@endsection
