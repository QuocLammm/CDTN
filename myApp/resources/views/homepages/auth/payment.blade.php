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
                                @php
                                    $unitPrice = $item->product->is_sale ? $item->product->sale_price : $item->product->price;
                                @endphp
                                <h5 class="mb-2">{{ $item->product->product_name }}</h5>
                                <p>Số lượng: {{ $item->quantity }}</p>
                                <p>Đơn giá: {{ number_format($unitPrice * $item->quantity) }}₫</p>

                                <p class="fw-bold">Thành tiền: {{ number_format($unitPrice * $item->quantity) }}₫</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Phần chọn thanh toán --}}
                <div class="checkout-summary mt-4">

                    <div class="text-end">
                        <p><strong>Tạm tính: </strong><span id="original-total">{{ number_format($total, 0, ',', '.') }}₫</span></p>
                        <p><strong>Khuyến mãi: </strong><span id="discount-amount">0₫</span></p>
                        <p><strong>Tổng cộng: </strong><span id="new-total">{{ number_format($total, 0, ',', '.') }}₫</span></p>
                    </div>

                    <form action="{{ route('checkout') }}" method="POST" id="payment-form">
                        @csrf

                        <label for="payment-method">Chọn phương thức thanh toán:</label>
                        <select name="payment_method" id="payment-method" required>
                            <option value="" disabled selected>-- Chọn phương thức --</option>
                            <option value="cod">Thanh toán tại quầy</option>
                            <option value="bank">Thanh toán qua VNPay</option>
                        </select>
                        {{-- Form áp dụng voucher --}}
                        <div class="voucher-section mt-3">
                            <label for="voucher_code">Nhập mã giảm giá:</label>
                            <input type="text" id="voucher_code" name="voucher_code" class="form-control mt-1 mb-2" placeholder="Nhập mã voucher...">
                            <button type="button" class="btn btn-primary" id="apply-voucher-btn">Áp dụng mã</button>

                            <p id="voucher-message" class="mt-2 text-success" style="display: none;"></p>
                        </div>
                        <input type="hidden" name="new_total" id="hidden-new-total" value="">
                        <input type="hidden" name="discount_amount" id="hidden-discount-amount" value="">

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
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.getElementById('apply-voucher-btn').addEventListener('click', function () {
            const voucherCode = document.getElementById('voucher_code').value;

            axios.post('{{ route('apply.voucher') }}', {
                voucher_code: voucherCode
            }, {
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
                .then(response => {
                    const data = response.data;
                    const messageEl = document.getElementById('voucher-message');

                    if (data.success) {
                        messageEl.innerText = `✅ ${data.message}`;
                        messageEl.classList.remove('text-danger');
                        messageEl.classList.add('text-success');

                        document.getElementById('original-total').innerText = data.original_total.toLocaleString('vi-VN') + '₫';
                        document.getElementById('discount-amount').innerText = '-' + data.discount_amount.toLocaleString('vi-VN') + '₫';
                        document.getElementById('new-total').innerText = data.new_total.toLocaleString('vi-VN') + '₫';
                        document.getElementById('hidden-new-total').value = data.new_total;
                        document.getElementById('hidden-discount-amount').value = data.discount_amount;

                    } else {
                        messageEl.innerText = `❌ ${data.message}`;
                        messageEl.classList.remove('text-success');
                        messageEl.classList.add('text-danger');
                    }

                    messageEl.style.display = 'block';
                })
                .catch(error => {
                    console.error('Lỗi:', error);
                });
        });

    </script>
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
