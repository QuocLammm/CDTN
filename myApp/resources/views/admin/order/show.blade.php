@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@php
    $breadcrumbItems = [
        ['label' => 'Đơn hàng', 'url' => route('show-order.index')],
        ['label' => 'Thông tin đơn hàng']
    ];
@endphp
@section('content')
    @include('layouts.header')
    <div class="container mt-4">
        <div class="card shadow">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Thông tin đơn hàng #{{ $order->order_id }}</h5>
                <span class="badge
                    @if($order->status === 'Pending') bg-warning
                    @elseif($order->status === 'Success') bg-success
                    @elseif($order->status === 'Cancelled') bg-danger
                    @endif">
                    {{ $order->status }}
                </span>
            </div>
            <div class="card-body">
                <h6 class="mb-3 text-muted">Thông tin khách hàng</h6>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <strong>Họ tên:</strong> {{ $order->user->full_name }}
                    </div>
                    <div class="col-md-6">
                        <strong>Email:</strong> {{ $order->user->email ?? 'N/A' }}
                    </div>
                    <div class="col-md-6 mt-2">
                        <strong>Số điện thoại:</strong> {{ $order->user->phone ?? 'N/A' }}
                    </div>
                    <div class="col-md-6 mt-2">
                        <strong>Ngày đặt hàng:</strong> {{ $order->created_at->format('d/m/Y H:i') }}
                    </div>
                    <div class="col-md-6 mt-2">
                        <strong>Phương thức thanh toán:</strong>
                        @if($order->payment_method === 'cod')
                            Thanh toán tại quầy
                        @elseif($order->payment_method === 'bank')
                            Thanh toán qua VNPay
                        @else
                            Không xác định
                        @endif
                    </div>
                </div>

                <h6 class="mb-3 text-muted">Danh sách sản phẩm</h6>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                        <tr>
                            <th class="col-id">#</th>
                            <th class="col-name">Tên sản phẩm</th>
                            <th class="col-price">Giá</th>
                            <th class="col-qty">Số lượng</th>
                            <th>Màu Sắc</th>
                            <th>Kích thước</th>
                            <th class="col-subtotal">Thành tiền</th>

                        </tr>
                        </thead>
                        <tbody>
                        @php $total = 0; @endphp
                        @foreach($order->items as $index => $item)
                            @php
                                $subtotal = $item->price * $item->quantity;
                                $total += $subtotal;
                            @endphp
                            <tr>
                                <td class="col-id">{{ $index + 1 }}</td>
                                <td class="col-name">{{ $item->product->product_name }}</td>
                                <td class="col-price">{{ number_format($item->price, 0, ',', '.') }} đ</td>
                                <td class="col-qty">{{ $item->quantity }}</td>
                                <td>{{ $item->color ?? 'Không rõ' }}</td>
                                <td>{{ $item->size ?? 'Không rõ' }}</td>
                                <td class="col-subtotal">{{ number_format($subtotal, 0, ',', '.') }} đ</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot class="table-light">
                        <tr>
                            <th colspan="6" class="text-end">Tổng cộng:</th>
                            <th class="col-subtotal">{{ number_format($total, 0, ',', '.') }} đ</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>

                <a href="{{ route('show-order.index') }}" class="btn btn-secondary mt-3">Quay lại danh sách</a>
            </div>
        </div>
    </div>
@endsection
