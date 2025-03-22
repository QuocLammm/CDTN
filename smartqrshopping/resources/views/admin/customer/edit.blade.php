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
        <form action="{{ route('customer.update', $customers->UserID) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-container">
                <div class="form-fields">
                    <div class="row">
                        <div class="col">
                            <label for="fullName">Họ và Tên<span class="required">*</span></label>
                            <input type="text" id="fullName" name="FullName" value="{{ old('FullName', $customers->FullName) }}" required>
                        </div>
                        <div class="col">
                            <label for="Gender">Giới Tính</label>
                            <select id="gender" name="Gender">
                                <option value="male" {{ $customers->Gender == 'male' ? 'selected' : '' }}>Nam</option>
                                <option value="female" {{ $customers->Gender == 'female' ? 'selected' : '' }}>Nữ</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="dateOfBirth">Ngày Sinh<span class="required">*</span></label>
                            <input type="date" id="dateOfBirth" name="Date_of_Birth" value="{{ old('Date_of_Birth', $customers->Date_of_Birth) }}" required>
                        </div>
                        <div class="col">
                            <label for="email">Email<span class="required">*</span></label>
                            <input type="email" id="email" name="Email" value="{{ old('Email', $customers->Email) }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="phone">Số Điện Thoại:<span class="required">*</span></label>
                            <input type="tel" id="phone" name="Phone" value="{{ old('Phone', $customers->Phone) }}" required>
                        </div>
                        <div class="col">
                            <label for="address">Địa Chỉ<span class="required">*</span></label>
                            <input type="text" id="address" name="Address" value="{{ old('Address', $customers->Address) }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="Password">Mật Khẩu</label>
                            <input type="password" id="password" name="Password" value="{{ old('Password', $customers->Password) }}" placeholder="Mật khẩu" required>
                        </div>
                    </div>
                </div>
                <div class="image-upload">
                    <label for="avatar">Ảnh đại diện</label>
                    <div class="avatar-container">
                        <img id="avatarPreview"
                             src="{{ $customers->avt ? asset('/images/customer/' . $customers->avt) : '/images/customer/default-product.png' }}"
                             style="margin-bottom: 10px; max-width:100%; height:352px;"
                             alt="Ảnh đại diện">
                    </div>
                    <label for="avatar" class="file-upload-button">Chọn Ảnh</label>
                    <input type="file" id="avatar" name="avatar" style="display: none;">
                </div>
            </div>

            <div class="button-group">
                <button type="submit" class="btn-submit">Cập nhật</button>
                <a href="{{ route('customer.index') }}" class="btn-back">Quay Lại</a>
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
