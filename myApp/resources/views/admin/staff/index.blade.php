@php
    use App\Helpers\PermissionHelper;
    $userPermissions = PermissionHelper::getUserPermissions();
@endphp

@extends('layouts.app')
@section('content')
    @include('layouts.header', ['title' => 'Nhân viên'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            @php
                $title = 'Danh sách nhân viên';
                $addRoute = route('show-staff.create');
                $tableId = 'staffTable';
            @endphp

            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex flex-column align-items-start">
                        <h6>{{ $title }}</h6>

                        @if ($userPermissions->contains('user.create'))
                            <a href="{{ $addRoute }}" class="btn btn-primary mt-2">Thêm nhân viên</a>
                        @endif
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table id="{{ $tableId }}" class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th>Tên nhân viên</th>
                                <th class="text-center">Hình ảnh</th>
                                <th>Ngày Sinh</th>
                                <th>Email</th>
                                <th class="text-center">Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $user->full_name }}</td>
                                    <td class="text-center">
                                        <img src="{{ asset($user->image) }}"
                                             style="width: 50px; height: 50px; object-fit: cover;" class="rounded">
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($user->date_of_birth)->format('d/m/Y') }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td class="text-center">
                                        @if ($userPermissions->contains('permission.assign'))
                                            <a href="{{ route('show-staff.permissions', $user->user_id) }}"
                                               class="btn btn-sm me-2"
                                               style="background: linear-gradient(45deg, #3f51b5, #7986cb); color: white; border: none;">
                                                <i class="fas fa-users-cog"></i> <!-- Icon Role -->
                                            </a>
                                        @endif
                                        @if ($userPermissions->contains('user.edit'))
                                            <a href="{{ route('show-staff.edit', $user->user_id) }}"
                                               class="btn btn-sm me-2"
                                               style="background: linear-gradient(45deg, #4caf50, #81c784); color: white; border: none;">
                                                <i class="fas fa-edit"></i> <!-- Icon Edit -->
                                            </a>
                                        @endif
                                        @if ($userPermissions->contains('user.delete'))
                                                <form action="{{ route('show-staff.destroy', $user->user_id) }}" method="POST" class="d-inline delete-form" data-is-admin="{{ $user->role_id == 1 ? 'true' : 'false' }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm me-2" style="background: linear-gradient(45deg, #f44336, #e57373); color: white; border: none;">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>

                                            @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Không có nhân viên nào</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            $('#staffTable').DataTable({
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

                    // Kiểm tra nếu là admin thì không cho xóa
                    if (form.dataset.isAdmin === 'true') {
                        Swal.fire({
                            title: 'Không thể xóa tài khoản Admin!',
                            icon: 'error',
                            confirmButtonText: 'Đồng ý'
                        });
                        return; // Dừng quá trình xóa
                    }

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
