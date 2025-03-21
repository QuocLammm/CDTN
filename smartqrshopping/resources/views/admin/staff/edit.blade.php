<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chỉnh sửa thông tin nhân viên</title>
    <link rel="stylesheet" href="/css/login/login.css">
    <link rel="stylesheet" href="/css/staff/create.css">
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
        <form action="{{ route('staff.update', $user->UserID) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-container">
                <div class="form-fields">
                    <div class="row">
                        <div class="col">
                            <label for="fullName">Họ và Tên<span class="required">*</span></label>
                            <input type="text" id="fullName" name="FullName" value="{{ old('FullName', $user->FullName) }}" required>
                        </div>
                        <div class="col">
                            <label for="roleId">Vai Trò<span class="required">*</span></label>
                            <select id="roleId" name="roleId" required>
                                <option value="" disabled>Chọn vai trò</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->RoleID }}" {{ $user->RoleID == $role->RoleID ? 'selected' : '' }}>
                                        {{ $role->RoleName }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="dateOfBirth">Ngày Sinh<span class="required">*</span></label>
                            <input type="date" id="dateOfBirth" name="DateOfBirth" value="{{ old('DateOfBirth', $user->Date_of_Birth) }}" required>
                        </div>
                        <div class="col">
                            <label for="email">Email<span class="required">*</span></label>
                            <input type="email" id="email" name="Email" value="{{ old('Email', $user->Email) }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="phone">Số Điện Thoại:<span class="required">*</span></label>
                            <input type="tel" id="phone" name="Phone" value="{{ old('Phone', $user->Phone) }}" required>
                        </div>
                        <div class="col">
                            <label for="address">Địa Chỉ<span class="required">*</span></label>
                            <input type="text" id="address" name="Address" value="{{ old('Address', $user->Address) }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="password">Mật Khẩu</label>
                            <input type="password" id="password" name="password" value="{{ old('password', $user->Password) }}" placeholder="Mật khẩu" readonly>
                        </div>
                    </div>

                </div>
                <div class="image-upload">
                    <label for="avatar">Ảnh đại diện</label>
                    <div class="avatar-container">
                        <img id="avatarPreview"
                             src="{{ $user->avt ? asset('/images/staff/' . $user->avt) : '/images/staff/default-product.png' }}"
                             style="margin-bottom: 10px; max-width:100%; height:352px;"
                             alt="Ảnh đại diện">
                    </div>
                    <label for="avatar" class="file-upload-button">Chọn Ảnh</label>
                    <input type="file" id="avatar" name="avatar" style="display: none;">
                </div>


            </div>

            <div class="button-group">
                <button type="submit" class="btn-submit">Cập nhật</button>
                <a href="{{ route('staff.index') }}" class="btn-back">Quay Lại</a>
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
            title: 'Cập nhật thành công!',
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
