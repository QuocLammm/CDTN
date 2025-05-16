@extends('layouts.app')

@section('content')
    @include('layouts.header', ['title' => 'Quản lý đơn hàng'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center pb-0">
                    <div class="d-flex flex-column align-items-start">
                        <h5 class="mb-0">Danh sách đặt hàng</h5>
{{--                        <a href="{{ route('show-category.create') }}" class="btn btn-primary">Thêm danh mục sản phẩm</a>--}}
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="productTable">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Khách hàng</th>
                            <th>Sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Tổng tiền</th>
                            <th>Thời gian đặt hàng</th>
                            <th>Trạng thái</th>
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
                                    <td>{{ $order->created_at }}</td>
                                    <td>
                                        @if($order->status == 'Pending')
                                            <span class="badge bg-warning">{{ $order->status }}</span>
                                        @elseif($order->status == 'Success')
                                            <span class="badge bg-success">{{ $order->status }}</span>
                                        @elseif($order->status == 'Cancelled')
                                            <span class="badge bg-danger">{{ $order->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{--<a href="{{ route('orders.show', $order->order_id) }}" class="btn btn-info">Xem</a>--}}
                                        <!-- Thêm các thao tác khác nếu cần -->
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $('#productTable').DataTable({
                pageLength: 5,
                lengthMenu: [5, 10, 25, 50, 100],
                language: {
                    search: "Tìm kiếm:",
                    lengthMenu: "Hiển thị _MENU_ mục",
                    paginate: {
                        first: "Đầu",
                        last: "Cuối",
                        next: "Tiếp",
                        previous: "Trước"
                    },
                    zeroRecords: "Không tìm thấy kết quả",
                    infoEmpty: "Không có dữ liệu",
                    infoFiltered: "(lọc từ _MAX_ mục)"
                }
            });
        });
    </script>
@endpush
