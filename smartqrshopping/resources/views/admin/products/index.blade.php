@extends('layouts.supper_page')
@section('title', 'Sản phẩm')
@section('content')
    <div class="main-container">
        <h1>Danh sách sản phẩm</h1>
        <div class="top-bar">
            <div class="top-bar-content">
                <a href="{{ route('products.create') }}" class="add-customer-btn">Thêm mới</a>
            </div>
        </div>

        <div class="table-container">
            <table id="productsTable" class="table table-striped">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th class="avt-border">Hình ảnh</th>
                    <th>Giá</th>
                    <th>Thao tác</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
@section('reserved_js')
    <script>
        $(document).ready(function() {
            var table = $('#productsTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("products.data") }}', // Đường dẫn chính xác đến route
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN' : '{{csrf_token()}}'
                    },
                },
                pageLength: 5, // Hiển thị mặc định 5 dòng
                lengthMenu: [5, 10, 25, 50, 100],
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false }, // Số thứ tự
                    { data: 'ProductName', name: 'ProductName' },
                    { data: 'Image', name: 'Image', render: function(data) {
                            return '<img src="/images/products/' + data + '" alt="Product Image" style="width: 100px; height: auto;">';
                        }},
                    { data: 'Price', name: 'Price', render: function(data) {
                            return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(data);
                        }},
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });
        });
    </script>
    @endsection
