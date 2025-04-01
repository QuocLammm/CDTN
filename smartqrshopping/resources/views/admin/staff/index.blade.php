@extends('layouts.supper_page')
@section('title' ,'Nhân viên')
@section('content')
    <div class="main-container">
        <h1>Danh sách sản phẩm</h1>
        <div class="top-bar">
            <div class="top-bar-content">
                <a href="{{ route('staff.create') }}" class="add-customer-btn">Thêm mới</a>
            </div>
    {{--            <div class="search-container">--}}
    {{--                <form id="searchForm" method="GET">--}}
    {{--                    <div style="display: flex; align-items: center;">--}}
    {{--                        <input type="text" name="search" placeholder="Nhập sản phẩm cần tìm" value="{{ request()->query('search') }}">--}}
    {{--                        <button type="submit">Tìm kiếm</button>--}}
    {{--                    </div>--}}
    {{--                </form>--}}
    {{--            </div>--}}
        </div>

        <div class="table-container">
            <table id="staffsTable" class="table table-striped">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên nhân viên</th>
                    <th class="avt-border">Hình ảnh</th>
                    <th>Email</th>
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
            var table = $('#staffsTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("staff.data") }}', // Đường dẫn chính xác đến route
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN' : '{{csrf_token()}}'
                    },
                },
                pageLength: 4, // Hiển thị mặc định 5 dòng
                lengthMenu: [4, 10, 25, 50, 100],
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false }, // Số thứ tự
                    { data: 'FullName', name: 'FullName' },
                    { data: 'avt', name: 'avt', render: function(data) {
                            return '<img src="/images/staff/' + data + '" alt="Product Image" style="width: 100px; height: auto;">';
                        }},
                    { data: 'Email', name: 'Email'},
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });
        });
    </script>
@endsection
