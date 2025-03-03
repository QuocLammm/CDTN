@extends('layouts.admin')
@section('title', 'Loại sản phẩm')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/categories/style.css">
    <body>
    <div id="notification" style="display: none; position: fixed; top: 10px; right: 10px; background-color: #28a745; color: white; padding: 10px; border-radius: 5px; z-index: 1000;">
        <span id="notification-message"></span>
    </div>
    <div class="container">
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
                            <td>{{ $index + 1 }}</td> <!-- Hiển thị số thứ tự -->
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
{{--            {{ $customers->links('pagination::bootstrap-4') }}--}}
        </div>
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
{{--    <script>--}}
{{--        document.addEventListener('DOMContentLoaded', () => {--}}
{{--            updateUserCount(); // Cập nhật số lượng ngay khi tải trang--}}
{{--        });--}}

{{--        function updateUserCount() {--}}
{{--            fetch('{{ route("guest.user.list") }}')--}}
{{--                .then(response => response.json())--}}
{{--                .then(data => {--}}
{{--                    const userCount = data.length;--}}
{{--                    document.getElementById('userCount').textContent = userCount;--}}
{{--                })--}}
{{--                .catch(error => console.error('Lỗi khi cập nhật số lượng khách hàng:', error));--}}
{{--        }--}}

{{--        function showNotification(message, backgroundColor) {--}}
{{--            const notification = document.getElementById('notification');--}}
{{--            const notificationMessage = document.getElementById('notification-message');--}}
{{--            notificationMessage.textContent = message;--}}
{{--            notification.style.backgroundColor = backgroundColor;--}}
{{--            notification.style.display = 'block';--}}
{{--            setTimeout(() => {--}}
{{--                notification.style.display = 'none';--}}
{{--            }, 3000);--}}
{{--        }--}}

{{--        function showDeleteModal(event, formId) {--}}
{{--            event.preventDefault();--}}
{{--            Swal.fire({--}}
{{--                title: 'Bạn có chắc chắn?',--}}
{{--                text: "Hành động này sẽ xóa khách hàng và không thể hoàn tác!",--}}
{{--                icon: 'warning',--}}
{{--                showCancelButton: true,--}}
{{--                confirmButtonText: 'Đồng ý',--}}
{{--                cancelButtonText: 'Hủy'--}}
{{--            }).then((result) => {--}}
{{--                if (result.isConfirmed) {--}}
{{--                    document.getElementById(formId).submit();--}}
{{--                }--}}
{{--            });--}}
{{--        }--}}
{{--        // Thông báo cập nhật--}}
{{--        document.addEventListener('DOMContentLoaded', () => {--}}
{{--            updateUserCount(); // Cập nhật số lượng ngay khi tải trang--}}

{{--            // Hiển thị thông báo cập nhật thành công--}}
{{--            @if (session('success'))--}}
{{--            Swal.fire({--}}
{{--                icon: 'success',--}}
{{--                title: 'Thành công!',--}}
{{--                html: '{!! session('success') !!}', // Use html to allow line breaks--}}
{{--                confirmButtonText: 'Đồng ý'--}}
{{--            });--}}
{{--            @endif--}}

{{--            // Hiển thị thông báo duyệt thành công--}}
{{--            @if (session('approved'))--}}
{{--            Swal.fire({--}}
{{--                icon: 'success',--}}
{{--                title: 'Đã duyệt!',--}}
{{--                text: '{{ session('approved') }}',--}}
{{--                confirmButtonText: 'Đồng ý'--}}
{{--            });--}}
{{--            @endif--}}
{{--        });--}}
{{--    </script>--}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    </body>
@endsection
