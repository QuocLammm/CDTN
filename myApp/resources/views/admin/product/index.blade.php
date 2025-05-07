@extends('layouts.app')

@section('content')
    @include('layouts.header', ['title' => 'Sản phẩm'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center pb-0">
                    <div class="d-flex flex-column align-items-start">
                        <h5 class="mb-0">Danh sách sản phẩm</h5>
                        <a href="{{ route('show-product.create') }}" class="btn btn-primary">Thêm sản phẩm</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="productTable">
                        <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th class="text-center">Hình ảnh</th>                    
                            <th>Giá</th>
                            <th class="text-center">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td>{{ $product->product_name }}</td>
                                <td class="text-center">
                                    <img src="{{ asset($product->image) }}"
                                         style="width: 50px; height: 50px; object-fit: cover;" class="rounded">
                                </td>
                                <td>{{ number_format($product->price) }} VNĐ</td>
                                <td class="text-center">
                                    <a href="{{ route('show-product.edit', $product->product_id) }}"
                                       class="btn btn-sm btn-outline-success me-1">Edit</a>
                                    <button type="button" class="btn btn-sm btn-outline-primary me-1 btn-show-qr"
                                            data-name="{{ $product->product_name }}"
                                            data-id="{{ $product->product_id }}">
                                        QR Code
                                    </button>
                                    <form action="{{ route('show-product.destroy', $product->product_id) }}"
                                          method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-outline-danger btn-delete">Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Không có sản phẩm nào</td>
                            </tr>
                        @endforelse
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

        // Xử lý nút xóa
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.btn-delete').forEach(function (button) {
                button.addEventListener('click', function () {
                    const form = this.closest('form');
                    Swal.fire({
                        title: 'Bạn có chắc muốn xóa?',
                        text: "Hành động này không thể hoàn tác!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Xóa',
                        cancelButtonText: 'Hủy'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });

            // Xử lý hiển thị QR Code
            document.querySelectorAll('.btn-show-qr').forEach(function (button) {
                button.addEventListener('click', function () {
                    const productId = this.getAttribute('data-id');
                    const productName = this.getAttribute('data-name');
                    const qrUrl = `https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=${encodeURIComponent(productName + ' - ID: ' + productId)}`;

                    Swal.fire({
                        title: `QR Code cho sản phẩm`,
                        html: `<img src="${qrUrl}" alt="QR Code" class="img-fluid">`,
                        confirmButtonText: 'Đóng'
                    });
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
