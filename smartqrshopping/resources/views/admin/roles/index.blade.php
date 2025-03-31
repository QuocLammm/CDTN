@extends('layouts.supper_page')
@section('title', 'Phân quyền')
@section('content')
    <div class="main-container">
        <h1>Danh sách phân quyền</h1>
        <div class="top-bar">
            <div class="top-bar-content">
                <a href="{{ route('roles.create') }}" class="add-customer-btn">Thêm mới</a>
            </div>
            <div class="search-container">
                <form action="{{ route('roles.index') }}" method="GET">
                    <div style="display: flex; align-items: center;">
                        <input type="text" name="search" placeholder="Nhập loại sản phẩm cần tìm" value="{{ request()->query('search') }}">
                        @if($search)
                            <a
                                href="{{ route('roles.index') }}"
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
                    <th>Chức vụ</th>
                    <th class="description-border">Mô tả</th>
                    <th>Thao tác</th>
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $index => $role)
                    <tr>
                        <td>{{ $roles->currentPage() * $roles->perPage() + $index + 1 - $roles->perPage() }}</td>
                        <td>{{ $role->RoleName }}</td>
                        <td>{{ $role->Description }}</td>
                        <td>
                            <form action="{{ route('roles.edit', $role->RoleID) }}" style="display:inline;">
                                <button type="submit" class="edit-button"><i class="fas fa-edit"></i></button>
                            </form>
                            <form action="{{ route('roles.destroy', $role->RoleID) }}" method="POST" style="display:inline;" id="deleteForm{{ $role->RoleID }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="delete-button" onclick="showDeleteModal(event, 'deleteForm{{ $role->RoleID }}')">
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
            {{ $roles->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection



