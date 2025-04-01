@extends('layouts.supper_page')
@section('title', 'Sản phẩm')
@section('content')
    <div class="main-container">
        <h1>Danh sách sản phẩm</h1>
        <div class="top-bar">
            <div class="top-bar-content">
                <a href="{{ route('products.create') }}" class="add-customer-btn">Thêm mới</a>
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
                <tbody>
                @foreach($products as $key => $product)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $product->ProductName }}</td>
                        <td>
                            <img src="/images/products/{{ $product->Image }}" alt="Product Image" style="width: 100px; height: auto;">
                        </td>
                        <td>{{ number_format($product->Price, 0, ',', '.') }} đ</td>
                        <td>
                            <form action="{{ route('products.edit', $product->ProductID) }}" style="display:inline;">
                                <button type="submit" class="edit-button"><i class="fas fa-edit"></i></button>
                            </form>
                            <form action="{{ route('products.destroy', $product->ProductID) }}" method="POST" style="display:inline;" id="deleteForm{{ $product->ProductID }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="delete-button" onclick="showDeleteModal(event, 'deleteForm{{ $product->ProductID }}')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('reserved_js')
    <script>
        $(document).ready(function() {
            $('#productsTable').DataTable({
                pageLength: 4,
                lengthMenu: [4, 10, 25, 50, 100]
            });
        });
    </script>
@endsection
