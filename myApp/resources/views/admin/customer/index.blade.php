@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Khách hàng'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            @php
                $title = 'Danh sách khách hàng';
                $addRoute = route('show-customer.create');
                $tableId = 'customerTable';
//                $customers = '';

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
                if ($customers->isEmpty()) {
                    $tbody .= '<tr><td colspan="5" class="text-center">Không có khách hàng nào</td></tr>';
                } else {
                    foreach ($customers as $customer) {
                        $tbody .= '
                            <tr>
                                <td>' . $customer->FullName . '</td>
                                <td class="text-center">
                                    <img src="' . asset('img/customers/' . $customer->Image) . '" style="width: 50px; height: 50px; object-fit: cover;" class="rounded">
                                </td>
                                <td>' . $customer -> Date_of_Birth . '</td>
                                <td> '. $customer -> Email .'</td>
                                <td class="text-center">
                                    <a href="' . route('show-customer.edit', $customer->UserID) . '" class="text-warning me-2">Edit</a>
                                    <form action="' . route('show-customer.destroy', $customer->UserID) . '" method="POST" style="display:inline;">
                                        ' . csrf_field() . method_field('DELETE') . '
                                        <button type="submit" onclick="return confirm(\'Xóa sản phẩm này?\')" class="btn btn-link text-danger p-0 m-0 align-baseline">Delete</button>
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
                pageLength: 4,
                lengthMenu: [4, 10, 25, 50, 100],
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
@endpush
