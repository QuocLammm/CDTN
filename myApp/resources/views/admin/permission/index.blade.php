
@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Phân quyền'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <h3>Danh sách nhóm quyền</h3>
            <table class="table table-bordered table-striped table-hover table-sm" id="rolesTable">
                <thead>
                <tr>
                    <th>Tên nhóm</th>
                    <th>Mô tả</th>
                    <th>Hành động</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->role_name }}</td>
                        <td>{{ $role->description }}</td>
                        <td>
                            <a href="{{ route('show-permission.edit', $role->role_id) }}" class="btn btn-sm btn-primary">Phân quyền</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('js')
    <!-- Khởi tạo DataTables -->
    <script>
        $(document).ready(function() {
            $('#rolesTable').DataTable({
                pageLength: 5, // Số lượng mục hiển thị trên mỗi trang
                lengthMenu: [5, 10, 25, 50, 100], // Các lựa chọn cho phân trang
                language: {
                    search: "Tìm kiếm:", // Từ khóa tìm kiếm
                    lengthMenu: "Hiển thị _MENU_ mục", // Text cho length menu
                    paginate: {
                        first: "Đầu", // Text cho nút 'Đầu'
                        last: "Cuối", // Text cho nút 'Cuối'
                        next: "Tiếp", // Text cho nút 'Tiếp'
                        previous: "Trước" // Text cho nút 'Trước'
                    },
                    zeroRecords: "Không tìm thấy kết quả", // Khi không tìm thấy dữ liệu
                    infoEmpty: "Không có dữ liệu", // Khi không có dữ liệu hiển thị
                    infoFiltered: "(lọc từ _MAX_ mục)" // Thông báo về số lượng dữ liệu lọc được
                }
            });
        });
    </script>
@endpush
