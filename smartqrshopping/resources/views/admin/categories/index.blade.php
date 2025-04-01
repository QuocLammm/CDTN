@extends('layouts.supper_page')
@section('title', 'Loại sản phẩm')
@section('content')
    <div class="main-container">
        <h1>Danh sách loại sản phẩm</h1>
        <div class="top-bar">
            <div class="top-bar-content">
                <a href="{{ route('categories.create') }}" class="add-customer-btn">Thêm mới</a>
            </div>
        </div>
        <div class="table-container">
            <table id="productsTable" class="table table-striped">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên loại sản phẩm</th>
                    <th>Mô tả</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $key => $categorie)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $categorie->CategoryName }}</td>
                        <td>{{ $categorie->Description }}</td>
                        <td>
                            @if ($categorie->Status === 1)
                                <span style="color:green; font-size: 40px; margin-right: 2px; vertical-align: middle;">&#8226;</span>
                                <span style="vertical-align: middle;">Còn hàng</span>
                            @endif
                            @if ($categorie->Status === 0)
                                <span style="color:red; font-size: 40px; margin-right: 2px; vertical-align: middle;">&#8226;</span>
                                <span style="vertical-align: middle;">Hết hàng</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('categories.edit', $categorie->CategoryID) }}" style="display:inline;">
                                <button type="submit" class="edit-button"><i class="fas fa-edit"></i></button>
                            </form>
                            <form action="{{ route('categories.destroy', $categorie->CategoryID) }}" method="POST" style="display:inline;" id="deleteForm{{ $categorie->CategoryID }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="delete-button" onclick="showDeleteModal(event, 'deleteForm{{ $categorie->CategoryID }}')">
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
                pageLength: 5,
                lengthMenu: [5, 10, 25, 50, 100]
            });
        });
    </script>
@endsection



