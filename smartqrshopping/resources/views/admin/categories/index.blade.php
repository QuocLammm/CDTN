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
    <style>
        /* Container của loading spinner */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            display: none; /* Mặc định ẩn */
        }

        /* Spinner */
        .spinner {
            border: 8px solid #f3f3f3;
            border-top: 8px solid #3498db;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            animation: spin 1s linear infinite;
        }

        /* Animation quay */
        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>
<body>
<div class="loading-overlay">
    <div class="spinner"></div>
</div>
<div class="container">
    @include('layouts.sidebar')
    <main>
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
    </main>
    @include('layouts.right_section')
</div>
<script>
    function showDeleteModal(event, formId) {
        event.preventDefault();  // Prevent the default form submission
        const form = document.getElementById(formId);

        Swal.fire({
            title: 'Bạn có chắc chắn muốn xóa?',
            text: "Hành động này không thể hoàn tác!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Xóa',
            cancelButtonText: 'Hủy',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the form if the user confirms the deletion
                form.submit();
            }
        });
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Thành công!',
            text: "{{ session('success') }}", // Sử dụng dấu ngoặc kép
            confirmButtonText: 'OK'
        });
        @endif
    });
</script>
<script src="/js/login/index.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="/js/admin/script.js'"></script>
</body>
</html>


