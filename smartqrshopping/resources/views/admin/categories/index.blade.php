<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            <h1>Danh sách khách hàng</h1>
            <div class="top-bar">
                <a href="{{ route('categories.create') }}" class="add-customer-btn">Thêm mới</a>
                <div class="search-container">
                    <form action="{{ route('categories.index') }}" method="GET">
                        <div style="position: relative;">
                            <input type="text" name="search" placeholder="Nhập loại sản phẩm cần tìm" value="{{ request()->query('search') }}">
                            @if($search)
                                <a
                                    href="{{ route('categories.index') }}"
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
                        <th>Mô tả</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $index => $category)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $category->CategoryName }}</td>
                            <td>{{ $category->Description }}</td>
                            <td>
                                @if ($category->Status === "Còn hàng")
                                    <span style="color:green; font-size: 40px; margin-right: 2px; vertical-align: middle;">&#8226;</span>
                                    <span style="vertical-align: middle;">Còn hàng</span>
                                @endif
                                @if ($category->Status === "Hết hàng")
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
                {{-- {{ $customers->links('pagination::bootstrap-4') }} --}}
            </div>
        </div>
    </main>
    @include('layouts.right_section')
</div>
<script>
    // Tự động ẩn thông báo sau 5 giây
    setTimeout(function() {
        var message = document.getElementById('search-message');
        if (message) {
            message.style.display = 'none';
        }
    }, 5000);
</script>
<script>// Tự động ẩn thông báo tìm kiếm sau 5 giây
    setTimeout(function() {
        var searchNotification = document.getElementById('search-notification');
        if (searchNotification) {
            searchNotification.style.transition = 'opacity 0.5s ease-out';
            searchNotification.style.opacity = '0';
            setTimeout(() => searchNotification.style.display = 'none', 500); // Ẩn hoàn toàn sau hiệu ứng mờ dần
        }
    }, 3000);
</script>
<script src="/js/login/index.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</body>
</html>


