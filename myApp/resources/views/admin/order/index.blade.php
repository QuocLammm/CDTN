@extends('layouts.app')

@section('content')
    @include('layouts.header', ['title' => 'Quản lý đơn hàng'])

    <table id="orders-table" class="display">
        <thead>
        <tr>
            <th>Số thứ tự</th>
            <th>Tên người đặt</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Tổng tiền</th>
            <th>Thao tác</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            @foreach($order->items as $item)
                <tr>
                    <td>{{ $loop->parent->iteration }}</td>
                    <td>{{ $order->user->full_name }}</td>
                    <td>{{ $item->product->product_name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->price * $item->quantity }}</td>
                    <td>
{{--                        <a href="{{ route('orders.show', $order->order_id) }}" class="btn btn-info">Xem</a>--}}
                        <!-- Thêm các thao tác khác nếu cần -->
                    </td>
                </tr>
            @endforeach
        @endforeach
        </tbody>
    </table>

    <script>
        $(document).ready(function() {
            $('#orders-table').DataTable();
        });
    </script>

@endsection
