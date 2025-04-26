@php
    use App\Helpers\PermissionHelper;
    $userPermissions = PermissionHelper::getUserPermissions();
@endphp
@extends('layouts.app')
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Khách hàng'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            @php
                $title = 'Danh sách khách hàng';
                $addRoute = route('show-customer.create');
                $tableId = 'customerTable';
            @endphp

            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex flex-column align-items-start">
                        <h6>{{ $title }}</h6>

                        @if ($userPermissions->contains('customer.create'))
                            <a href="{{ $addRoute }}" class="btn btn-primary mt-2">Thêm khách hàng</a>
                        @endif
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table id="{{ $tableId }}" class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th>Tên khách hàng</th>
                                <th class="text-center">Hình ảnh</th>
                                <th>Ngày Sinh</th>
                                <th>Email</th>
                                <th class="text-center">Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($customers as $customer)
                                <tr>
                                    <td>{{ $customer->full_name }}</td>
                                    <td class="text-center">
                                        <img src="{{ asset($customer->image) }}" style="width: 50px; height: 50px; object-fit: cover;" class="rounded">
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($customer->date_of_birth)->format('d/m/Y') }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td class="text-center">
                                        @if ($userPermissions->contains('permission.assign'))
                                            <a href="{{ route('show-customer.permissions', $customer->user_id) }}" class="btn btn-sm me-2"
                                               style="background: linear-gradient(45deg, #3f51b5, #7986cb); color: white; border: none;">
                                                <i class="fas fa-users-cog"></i> <!-- Icon Role -->
                                            </a>
                                        @endif
                                        @if ($userPermissions->contains('customer.edit'))
                                            <a href="{{ route('show-customer.edit', $customer->user_id) }}" class="btn btn-sm me-2"
                                               style="background: linear-gradient(45deg, #4caf50, #81c784); color: white; border: none;">
                                                <i class="fas fa-edit"></i> <!-- Icon Edit -->
                                            </a>
                                        @endif
                                        @if ($userPermissions->contains('customer.delete'))
                                            <form action="{{ route('show-customer.destroy', $customer->user_id) }}" method="POST" class="d-inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-delete me-2" style="background: linear-gradient(45deg, #f44336, #e57373); color: white; border: none;">
                                                    <i class="fas fa-trash"></i> <!-- Icon Delete -->
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Không có khách hàng nào</td>
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
        $(document).ready(function() {
            $('#customerTable').DataTable({
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
            const deleteButtons = document.querySelectorAll('.btn-delete');

            deleteButtons.forEach(function (button) {
                button.addEventListener('click', function (e) {
                    e.preventDefault();
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
        });
    </script>
@endpush
