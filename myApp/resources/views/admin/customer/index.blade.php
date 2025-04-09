@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Khách hàng'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            @php
                $title = 'Danh sách khách hàng';
                $addRoute = route('show-customer.create');
                $tableId = 'customerTable';
                $thead = '
                    <tr>
                        <th>Tên khách hàng</th>
                        <th class="text-center">Hình ảnh</th>
                        <th>Ngày Sinh</th>
                        <th>Email</th>
                        <th class="text-center">Thao tác</th>
                    </tr>
                ';
                $tbody = '';
                if (empty($customers) || count($customers) === 0) {
                    $tbody .= '<tr><td colspan="5" class="text-center">Không có khách hàng nào</td></tr>';
                } else {
                    foreach ($customers as $customer) {
                        $tbody .= '
                            <tr>
                                <td>' . $customer->FullName . '</td>
                                <td class="text-center">
                                    <img src="' . asset($customer->Image) . '" style="width: 50px; height: 50px; object-fit: cover;" class="rounded">
                                </td>
                                <td>' . \Carbon\Carbon::parse($customer->Date_of_Birth)->format('d/m/Y') . '</td>
                                <td> '. $customer -> Email .'</td>
                                <td class="text-center">
                                    <a href="' . route('show-customer.edit', $customer->UserID) . '" class="btn btn-sm btn-outline-success me-2">Edit</a>
                                    <form action="' . route('show-customer.destroy', $customer->UserID) . '" method="POST" class="d-inline delete-form">
                                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="button" class="btn btn-sm btn-outline-danger btn-delete">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        ';
                    }
                }
            @endphp
            @include('pages.tables', compact('title', 'addRoute', 'thead', 'tbody', 'tableId'))
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
