@extends('layouts.supper_page')
@section('title' , 'Sản phẩm')
@section('content')
    <div class="main-container">
        <h1>Danh sách sản phẩm</h1>
        <div class="top-bar">
            <div class="top-bar-content">
                <a href="{{ route('products.create') }}" class="add-customer-btn">Thêm mới</a>
            </div>
            <div class="search-container">
                <form action="{{ route('products.index') }}" method="GET">
                    <div style="display: flex; align-items: center;">
                        <input type="text" name="search" placeholder="Nhập khách hàng cần tìm" value="{{ request()->query('search') }}">
                        @if($search)
                            <a
                                href="{{ route('products.index') }}"
                                id="clearButton"
                                style="text-decoration: none; color: #D5D5D5; font-size: 18px; cursor: pointer;">
                                ✖
                            </a>
                        @endif
                        <button type="submit">Tìm kiếm</button>
                    </div>
                </form>
            </div>
        </div>
        {{-- Hiển thị thông báo tìm kiếm --}}
        @if ($searchPerformed && $search !== '')
            @if ($totalResults > 0)
                <div id="search-notification" class="alert-success" style="text-align: center; color: green; margin-top: 10px;">
                    Tìm thấy {{ $totalResults }} sản phẩm có tên chứa từ khóa: "{{ $search }}"
                </div>
            @else
                <div id="search-notification" class="alert-danger" style="text-align: center; color: red; margin-top: 10px;">
                    Không tìm thấy sản phẩm có tên chứa từ khóa: "{{ $search }}"
                </div>
            @endif
        @endif

        <div class="table-container">
            <table class="table table-striped">
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
                @foreach($products as $index => $product)
                    <tr>
                        <td>{{ $products->currentPage() * $products->perPage() + $index + 1 - $products->perPage() }}</td>
                        <td>{{ $product->ProductName }}</td>
                        <td>
                            <img src="{{ asset('/images/products/' . $product->Image) }}" alt="{{ $product->ProductName }}" style="width: 100px; height: auto;">
                        </td>
                        <td>{{ number_format($product->Price, 0, ',', '.') }} vnđ</td>
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
                            <form action="{{ route('products.qr', $product->ProductID) }}" style="display:inline;">
                                <button type="submit" class="qr-button">
                                    <i class="fas fa-qrcode"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="pagination">
            {{ $products->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection

