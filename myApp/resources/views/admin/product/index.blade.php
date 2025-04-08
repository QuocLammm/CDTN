@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Sản phẩm'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            @php
                $title = 'Danh sách sản phẩm';
                $addRoute = route('show-product.create');
                $tableId = 'productTable';

                $thead = '
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th class="text-center">Hình ảnh</th>
                        <th>Mô tả</th>
                        <th>Giá</th>
                        <th class="text-center">Thao tác</th>
                    </tr>
                ';

                $tbody = '';
                if ($products->isEmpty()) {
                    $tbody .= '<tr><td colspan="5" class="text-center">Không có sản phẩm nào</td></tr>';
                } else {
                    foreach ($products as $product) {
                        $tbody .= '
                            <tr>
                                <td>' . $product->ProductName . '</td>
                                <td class="text-center">
                                    <img src="' . asset('img/products/' . $product->Image) . '" style="width: 50px; height: 50px; object-fit: cover;" class="rounded">
                                </td>
                                <td>' . $product->Description . '</td>
                                <td>' . number_format($product->Price) . ' VND</td>
                                <td class="text-center">
                                    <a href="' . route('show-product.edit', $product->ProductID) . '" class="text-warning me-2">Edit</a>
                                    <form action="' . route('show-product.destroy', $product->ProductID) . '" method="POST" style="display:inline;">
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
            $('#productTable').DataTable({
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
