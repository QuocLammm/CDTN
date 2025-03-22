<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chỉnh sửa loại sản phẩm</title>
    <link rel="stylesheet" href="/css/login/login.css">
    <link rel="stylesheet" href="/css/categories/create.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Sharp" rel="stylesheet" />
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
        <h1>Chỉnh sửa thông tin</h1>
        <form action="{{ route('categories.update', $category->CategoryID) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-container">
                <div class="form-fields">
                    <div class="row">
                        <div class="col">
                            <label for="CategoryName">Tên loại sản phẩm<span class="required">*</span></label>
                            <input type="text" id="CategoryName" name="CategoryName" value="{{ old('CategoryName', $category->CategoryName) }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="Description">Mô tả<span class="required">*</span></label>
                            <textarea id="Description" name="Description" required>{{ old('Description', $category->Description) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="button-group">
                <button type="submit" class="btn-submit">Cập nhật</button>
                <a href="{{ route('categories.index') }}" class="btn-back">Quay Lại</a>
            </div>
        </form>
    </main>
    @include('layouts.right_section')
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Cập nhật thông tin thành công!',
            text: @json(session('success')),
            confirmButtonText: 'OK'
        });
        @endif
    });
</script>
<script src="/js/staff/create.js"></script>
<script src="/js/login/order.js"></script>
<script src="/js/login/index.js"></script>
</body>
</html>
