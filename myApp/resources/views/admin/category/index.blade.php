@extends('layouts.app')

@section('content')
    @include('layouts.header', ['title' => 'Danh mục sản phẩm'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center pb-0">
                    <div class="d-flex flex-column align-items-start">
                        <h5 class="mb-0">Danh sách danh mục sản phẩm</h5>
                        <a href="{{ route('show-category.create') }}" class="btn btn-primary">Thêm danh mục sản phẩm</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="productTable">
                        <thead>
                        <tr>
                            <th>Tên danh mục sản phẩm</th>
                            <th>Mô tả</th>
                            <th class="text-center">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td>{{ $category->category_name }}</td>
                                <td>{{ $category->description }}</td>
                                <td class="text-center">
                                    <a href="{{ route('show-product.edit', $category->category_id) }}"
                                       class="btn btn-sm btn-outline-success me-1">Edit</a>
                                    <form action="{{ route('show-product.destroy', $category->category_id) }}"
                                          method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-outline-danger btn-delete">Delete</button>
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
    <!-- DataTables -->
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
    <!-- SweetAlert2 chỉ dùng cho QR -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Lấy tất cả các nút mã QR
            const qrButtons = document.querySelectorAll('.btn-show-qr');

            qrButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    const productId = this.getAttribute('data-id');
                    const productName = this.getAttribute('data-name');

                    // Gửi yêu cầu AJAX để lấy mã QR từ server
                    fetch(`/api/qr-code/${productId}`)
                        .then(response => response.json())
                        .then(data => {
                            // Hiển thị SweetAlert với mã QR
                            Swal.fire({
                                title: `QR Code của ${productName}`,
                                html: `<img src="data:image/svg+xml;base64,${data.qr_code_base64}" style="width: 200px; height: 200px;">`,
                                showConfirmButton: true,
                            });
                        })
                        .catch(error => {
                            console.error('Error fetching QR code:', error);
                        });
                });
            });
        });

    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Cấu hình Toast
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000,
                timerProgressBar: true,
                customClass: {
                    popup: 'colored-toast'
                }
            });

            // Kiểm tra nếu có thông báo từ session
            @if (session('success'))
            Toast.fire({
                icon: 'success',
                title: '{{ session('success') }}',
                background: '#4CAF50', // nền xanh lá
                color: 'white'
            });
            @endif

            @if (session('error'))
            Toast.fire({
                icon: 'error',
                title: '{{ session('error') }}',
                background: '#f44336', // nền đỏ
                color: 'white'
            });
            @endif

            @if (session('warning'))
            Toast.fire({
                icon: 'warning',
                title: '{{ session('warning') }}',
                background: '#FF9800', // nền cam
                color: 'white'
            });
            @endif

            // Lấy tất cả các nút xóa
            const deleteButtons = document.querySelectorAll('.delete-form button');

            deleteButtons.forEach(function (button) {
                button.addEventListener('click', function (e) {
                    e.preventDefault();  // Ngừng hành động mặc định của nút (submit form)
                    const form = this.closest('form');

                    // Hiển thị SweetAlert2 thông báo xác nhận xóa
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
                            // Thực sự gửi form để xóa
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>

@endpush
