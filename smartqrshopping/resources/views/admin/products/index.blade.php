@extends('layouts.supper_page')

@section('title', 'Sản phẩm')

@section('content')
    <div class="main-container">
        <h1>Danh sách sản phẩm</h1>
        <div class="top-bar">
            <div class="top-bar-content">
                <a href="{{ route('products.create') }}" class="add-customer-btn">Thêm mới</a>
            </div>
            <div class="search-container">
                <form id="searchForm" method="GET">
                    <div style="display: flex; align-items: center;">
                        <input type="text" name="search" placeholder="Nhập sản phẩm cần tìm" value="{{ request()->query('search') }}">
                        <button type="submit">Tìm kiếm</button>
                    </div>
                </form>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#productsTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("products.data") }}', // Đường dẫn chính xác đến route
                    type: 'GET',
                    data: function(d) {
                        d.search = $('input[name="search"]').val(); // Thêm tham số tìm kiếm
                    }
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
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

            // Tìm kiếm
            $('#searchForm').on('submit', function(e) {
                e.preventDefault();
                table.draw(); // Gọi lại DataTable để lấy dữ liệu với tham số tìm kiếm
            });
        });
    </script>
@endsection
