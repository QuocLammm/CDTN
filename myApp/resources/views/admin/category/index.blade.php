@extends('layouts.app')
@push('css')

@endpush
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Loại sản phẩm'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            @php
                $title = 'Danh sách loại sản phẩm';
                $addRoute = route('show-category.create');
                $tableId = 'categoryTable';

                $thead = '
                    <tr>
                        <th>Tên loại sản phẩm</th>
                        <th>Mô tả</th>
                        <th class="text-center">Thao tác</th>
                    </tr>
                ';

                $tbody = '';
                if (empty($categories) || count($categories) === 0) {
                    $tbody .= '<tr><td colspan="5" class="text-center">Không có sản phẩm nào</td></tr>';
                } else {
                    foreach ($categories as $category) {
                        $tbody .= '
                            <tr>
                                <td>' . $category->CategoryName . '</td>
                                <td>' . $category->Description . '</td>
                                <td class="text-center">
                                    <a href="' . route('show-category.edit', $category->CategoryID) . '" class="btn btn-sm btn-outline-success me-2">Edit</a>
                                    <form action="' . route('show-category.destroy', $category->CategoryID) . '" method="POST" class="d-inline delete-form">
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
            $('#categoryTable').DataTable({
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
