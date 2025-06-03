@extends('layouts.app')

@section('content')
    @include('layouts.header', ['title' => 'Danh mục sản phẩm'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center pb-0">
                    <div class="d-flex flex-column align-items-start">
                        <h5 class="mb-0">Danh sách nhà cung cấp</h5>
                        <a href="{{ route('show-supplier.create') }}" class="btn btn-primary">Thêm nhà cung cấp</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="supplierTable">
                        <thead>
                        <tr>
                            <th>Tên nhà cung cấp</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                            <th class="text-center">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($suppliers as $supplier)
                            <tr>
                                <td>{{ $supplier->supplier_name }}</td>
                                <td>{{ $supplier->phone }}</td>
                                <td>{{ $supplier->email }}</td>
                                <td class="text-center">
                                    <a href="{{ route('show-supplier.edit', $supplier->supplier_id) }}"
                                       class="btn btn-sm btn-outline-success me-1">Edit</a>
                                    <form action="{{ route('show-supplier.destroy', $supplier->supplier_id) }}"
                                          method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-outline-danger btn-delete">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Không có nhà cung cấp nào</td>
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
            $('#supplierTable').DataTable({
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

            // SweetAlert xác nhận xóa
            $('.btn-delete').click(function () {
                const form = $(this).closest('form');
                Swal.fire({
                    title: 'Bạn có chắc muốn xóa?',
                    text: "Thao tác này không thể hoàn tác!",
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
    </script>
@endpush

