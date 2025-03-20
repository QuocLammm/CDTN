<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhân viên</title>
    <link rel="stylesheet" href="/css/login/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Sharp" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    @include('layouts.sidebar')
    <main>
        <div class="main-container">
            <h1>Danh sách nhân viên</h1>
            <div class="top-bar">
                <div class="top-bar-content">
                    <a href="{{ route('staff.create') }}" class="add-customer-btn">Thêm mới</a>
                    <div class="search-container">
                        <form action="{{ route('staff.index') }}" method="GET">
                            <div style="position: relative;">
                                <input type="text" name="search" placeholder="Nhập loại sản phẩm cần tìm" value="{{ request()->query('search') }}">
                                @if($search)
                                    <a
                                        href="{{ route('staff.index') }}"
                                        id="clearButton"
                                        style="position: absolute; right: 20%; top: 50%; transform: translateY(-50%); text-decoration: none; color: #D5D5D5; font-size: 18px; cursor: pointer;">
                                        ✖
                                    </a>
                                @endif
                            </div>
                            <button type="submit">Tìm kiếm</button>
                        </form>
                    </div>
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
                        <th>Họ và tên</th>
                        <th>Hình ảnh</th>
                        <th>Email</th>
                        <th>Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $index => $user)
                        <tr>
                            <td>{{ $users->currentPage() * $users->perPage() + $index + 1 - $users->perPage() }}</td>
                            <td>{{ $user->FullName }}</td>
                            <td>
                                <img src="{{ asset('/images/staff/' . $user->avt) }}" alt="{{ $user->FullName }}" style="width: 100px; height: auto;">
                            </td>
                            <td>{{ $user->Email }}</td>
                            <td>
                                <form action="{{ route('categories.edit', $user->UserID) }}" style="display:inline;">
                                    <button type="submit" class="edit-button"><i class="fas fa-edit"></i></button>
                                </form>
                                <form action="{{ route('categories.destroy', $user->UserID) }}" method="POST" style="display:inline;" id="deleteForm{{ $user->UserID }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="delete-button" onclick="showDeleteModal(event, 'deleteForm{{ $user->UserID }}')">
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
                {{ $users->links('pagination::bootstrap-4') }}
            </div>

        </div>
    </main>
    @include('layouts.right_section')
</div>

<script src="/js/login/order.js"></script>
<script src="/js/login/index.js"></script>
</body>
</html>
