<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Thêm Loại Sản Phẩm Mới</title>
    <link rel="stylesheet" href="/css/login/login.css">
    <link rel="stylesheet" href="/css/categories/create.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Sharp" rel="stylesheet" />
</head>
<body>
<div class="container">
    @include('layouts.sidebar')
    <main>
        <h1>Thêm Loại Sản Phẩm Mới</h1>
        <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-container">
                <div class="form-fields">
                    <div class="row">
                        <div class="col">
                            <label for="CategoryName">Tên loại sản phẩm<span class="required">*</span></label>
                            <input type="text" id="CategoryName" name="CategoryName" required>
                            <div id="nameError" style="color: red; display: none;"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="Description">Mô tả<span class="required">*</span></label>
                            <textarea id="Description" name="Description" required></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="button-group">
                <button type="submit" class="btn-submit">Thêm Mới</button>
                <a href={{route('categories.index')}} class="btn-back">
                    Quay Lại
                </a>
            </div>

        </form>
    </main>
    @include('layouts.right_section')
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Hiển thị thông báo cập nhật thành công
        @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Thêm loại sản phẩm thành công!',
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
