@extends('layouts.app')
@push('css')
    <style>
        .text-ellipsis {
            max-width: 200px; /* hoặc bất kỳ giá trị phù hợp */
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display: inline-block;
            vertical-align: middle;
        }
    </style>
@endpush
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
                            <th class="text-center">Giá</th>
                            <th class="text-center">Chi tiết</th>
                            <th class="text-center">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($products->groupBy('product_name') as $productGroup)
                            @foreach ($productGroup as $product)
                                <tr>
                                    <td class="text-ellipsis">{{ $product->product_name }}</td>
                                    <td class="text-center">
                                        @if($product->images->count())
                                            <img src="{{ asset($product->images->first()->image_path) }}"
                                                 style="width: 60px; height: 60px; object-fit: cover;">
                                        @endif
                                    </td>
                                    <td>{{ number_format($product->price) }} VNĐ</td>
                                    <td>
                                        @foreach ($product->productDetails as $detail)
                                            <div>Size: {{ $detail->size }} - Màu: {{ $detail->color }} - SL: {{ $detail->quantity }}</div>
                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('show-product.edit', $product->product_id) }}"
                                           class="btn btn-sm btn-outline-success me-1">Edit</a>
                                        <button type="button" class="btn btn-sm btn-outline-primary me-1 btn-show-qr"
                                                data-name="{{ Str::limit($product->product_name, 30) }}"

                                                data-id="{{ $product->product_id }}">
                                            <span style="display: inline-block; max-width: 100px; overflow: hidden;">
                                                QR Code
                                            </span>
                                        </button>

                                        <form action="{{ route('show-product.destroy', $product->product_id) }}"
                                              method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-outline-danger btn-delete">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
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
                    fetch(`/admin/qr-code/${productId}`)
                        .then(response => response.json())
                        .then(data => {
                            // Hiển thị SweetAlert với mã QR và nút "Xuất"
                            Swal.fire({
                                title: `QR Code của ${productName}`,
                                html: `
                                        <img src="data:image/svg+xml;base64,${data.qr_image_path}" style="width: 200px; height: 200px;"><br>
                                        <button id="copyLinkBtn" class="swal2-styled" style="background-color: #2196F3; margin-top: 10px;">Chia sẻ</button>
                                    `,
                                showConfirmButton: true,
                                confirmButtonText: 'OK',
                                showCancelButton: true,
                                cancelButtonText: 'Xuất',
                                reverseButtons: true,
                                didOpen: () => {
                                    const copyBtn = document.getElementById('copyLinkBtn');
                                    copyBtn.addEventListener('click', () => {
                                        navigator.clipboard.writeText(data.qr_data).then(() => {
                                            Swal.fire({
                                                toast: true,
                                                position: 'top-end',
                                                icon: 'success',
                                                title: 'Sao chép thành công!',
                                                showConfirmButton: false,
                                                timer: 2000,
                                                background: '#4CAF50',
                                                color: 'white'
                                            });
                                        }).catch(() => {
                                            Swal.fire({
                                                toast: true,
                                                position: 'top-end',
                                                icon: 'error',
                                                title: 'Sao chép thất bại!',
                                                showConfirmButton: false,
                                                timer: 2000,
                                                background: '#f44336',
                                                color: 'white'
                                            });
                                        });
                                    });
                                }
                            }).then((result) => {
                                if (result.dismiss === Swal.DismissReason.cancel) {
                                    // Nút "Xuất" được bấm
                                    const imgSrc = `data:image/svg+xml;base64,${data.qr_image_path}`;
                                    const printWindow = window.open('', '_blank');
                                    printWindow.document.write(`
                                    <html>
                                        <head>
                                            <title>In QR Code</title>
                                            <style>
                                                body { text-align: center; margin: 0; padding: 20px; }
                                                img { max-width: 100%; height: auto; }
                                            </style>
                                        </head>
                                        <body>
                                            <img src="${imgSrc}" alt="QR Code" />
                                            <script>
                                                window.onload = function() {
                                                    window.print();
                                                    window.onafterprint = function() { window.close(); }
                                                }
                                            <\/script>
                                        </body>
                                    </html>
                                `);
                                    printWindow.document.close();
                                }
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

