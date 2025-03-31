@extends('layouts.supper_page')
@section('title', 'Loại sản phẩm')
@section('content')
    <div class="main-container">
        <h1>Danh sách loại sản phẩm</h1>
        <div class="top-bar">
            <div class="top-bar-content">
                <a href="{{ route('categories.create') }}" class="add-customer-btn">Thêm mới</a>
            </div>
            <div class="search-container">
                <form action="{{ route('categories.index') }}" method="GET">
                    <div style="display: flex; align-items: center;">
                        <input type="text" name="search" placeholder="Nhập loại sản phẩm cần tìm" value="{{ request()->query('search') }}">
                        @if($search)
                            <a
                                href="{{ route('categories.index') }}"
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
                    Tìm thấy {{ $totalResults }} khách hàng có tên chứa từ khóa: "{{ $search }}"
                </div>
            @else
                <div id="search-notification" class="alert-danger" style="text-align: center; color: red; margin-top: 10px;">
                    Không tìm thấy khách hàng có tên chứa từ khóa: "{{ $search }}"
                </div>
            @endif
        @endif

        <div class="table-container">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th class="description-border">Mô tả</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $index => $category)
                    <tr>
                        <td>{{ $categories->currentPage() * $categories->perPage() + $index + 1 - $categories->perPage() }}</td>
                        <td>{{ $category->CategoryName }}</td>
                        <td>{{ $category->Description }}</td>
                        <td>
                            @if ($category->Status === 1)
                                <span style="color:green; font-size: 40px; margin-right: 2px; vertical-align: middle;">&#8226;</span>
                                <span style="vertical-align: middle;">Còn hàng</span>
                            @endif
                            @if ($category->Status === 0)
                                <span style="color:red; font-size: 40px; margin-right: 2px; vertical-align: middle;">&#8226;</span>
                                <span style="vertical-align: middle;">Hết hàng</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('categories.edit', $category->CategoryID) }}" style="display:inline;">
                                <button type="submit" class="edit-button"><i class="fas fa-edit"></i></button>
                            </form>
                            <form action="{{ route('categories.destroy', $category->CategoryID) }}" method="POST" style="display:inline;" id="deleteForm{{ $category->CategoryID }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="delete-button" onclick="showDeleteModal(event, 'deleteForm{{ $category->CategoryID }}')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="pagination">
            {{ $categories->links('pagination::bootstrap-4') }}
        </div>

    </div>
@endsection



