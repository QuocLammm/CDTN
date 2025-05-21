@extends('layouts.app')

@section('content')
    @include('layouts.header', ['title' => 'Quản lý đơn hàng'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center pb-0">
                    <div class="d-flex flex-column align-items-start">
                        <h5 class="mb-0">Danh sách đặt hàng</h5>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="productTable">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Khách hàng</th>
                            <th>Số lượng</th>
                            <th>Tổng tiền</th>
                            <th>Thời gian đặt hàng</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            @php
                                $totalAmount = 0;
                                $productNames = []; // Khởi tạo biến ở đây
                            @endphp
                            @foreach($order->items as $item)
                                @php
                                $totalAmount += $item->price * $item->quantity;
                                $productNames[] = $item->product->product_name;
                                @endphp
                            @endforeach
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $order->user->full_name }}</td>
                                <td>{{ $order->items->sum('quantity') }}</td>
                                <td>{{ number_format($totalAmount, 0, ',', '.') }} đ</td>
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
                                    <button class="btn btn-success btn-done" data-id="{{ $order->order_id }}">Done</button>
                                    <a href="{{ route('show-order.show', $order->order_id) }}" class="btn btn-info">Xem chi tiết</a>
                                </td>

                            </tr>
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
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
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

            // Xử lý nút "Done"
            $(document).on('click', '.btn-done', function () {
                const orderId = $(this).data('id');

                Swal.fire({
                    title: 'Bạn có chắc chắn đã chuẩn bị xong hàng?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Đồng ý',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/orders/${orderId}/done`,
                            method: 'POST',

                            success: function(response) {
                                Swal.fire('Thành công!', 'Đơn hàng đã được cập nhật.', 'success');
                                location.reload();
                            },
                            error: function(error) {
                                Swal.fire('Lỗi!', 'Có lỗi xảy ra.', 'error');
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush
