<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Thêm Nhân Viên Mới</title>
    <link rel="stylesheet" href="/css/login/login.css">
    <link rel="stylesheet" href="/css/staff/create.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Sharp" rel="stylesheet" />
</head>
<body>
<div class="container">
    @include('layouts.sidebar')
    <main>
        <h1>Thêm Nhân Viên Mới</h1>
        <form action="{{ route('staff.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-container">
                <div class="form-fields">
                    <div class="row">
                        <div class="col">
                            <label for="FullName">Họ và Tên<span class="required">*</span></label>
                            <input type="text" id="FullName" name="FullName" required>
                            <div id="nameError" style="color: red; display: none;"></div>
                        </div>
                        <div class="col">
                            <label for="RoleID">Vai Trò<span class="required">*</span></label>
                            <select id="RoleID" name="RoleID" required>
                                <option value="" disabled selected>Chọn vai trò</option>
                                @foreach ($roles as $role)
                                    @if ($role->RoleID == 1 || $role->RoleID == 3)
                                        <option value="{{ $role->RoleID }}">{{ $role->RoleName }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="Gender">Giới Tính</label>
                            <select id="Gender" name="Gender">
                                <option value="male" {{ old('Gender') == 'male' ? 'selected' : '' }}>Nam</option>
                                <option value="female" {{ old('Gender') == 'female' ? 'selected' : '' }}>Nữ</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="Date_of_Birth">Ngày Sinh<span class="required">*</span></label>
                            <input type="date" id="Date_of_Birth" name="Date_of_Birth" required>
                        </div>
                        <div class="col">
                            <label for="Email">Email<span class="required">*</span></label>
                            <input type="Email" id="Email" name="Email" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="Phone">Số Điện Thoại:<span class="required">*</span></label>
                            <input type="tel" id="Phone" name="Phone" required placeholder="Nhập số điện thoại">
                            <div id="phoneError" style="color: red; display: none;"></div>
                        </div>
                        <div class="col">
                            <label for="Address">Địa Chỉ<span class="required">*</span></label>
                            <input type="text" id="Address" name="Address" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="UserName">Tài khoản<span class="required">*</span></label>
                            <input type="text" id="username" name="UserName" required>
                        </div>
                        <div class="col">
                            <label for="password">Mật Khẩu<span class="required">*</span></label>
                            <div class="password-container">
                                <select id="password" name="passwordOption" required>
                                    <option value="auto">Tự động sinh</option>
                                    <option value="manual">Nhập thủ công</option>
                                </select>
                                <input type="password" id="manualPassword" name="manualPassword" placeholder="Nhập mật khẩu" style="display:none;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="image-upload">
                    <label for="avt">Ảnh đại diện</label>
                    <img id="avatarPreview" src="/images/staff/default-product.png" style="margin-bottom: 10px; max-width:100%; height:auto;">
                    <label for="avt" class="file-upload-button">Chọn Ảnh</label>
                    <input type="file" id="avt" name="avt" style="display: none;" accept="image/*">
                </div>
            </div>
            <div class="button-group">
                <button type="submit" class="btn-submit">Thêm Mới</button>
                <a href={{route('staff.index')}} class="btn-back">
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
        // Hiển thị hình ảnh đại diện khi người dùng chọn
        const avatarInput = document.getElementById('avt');
        const avatarPreview = document.getElementById('avatarPreview');

        avatarInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    avatarPreview.src = e.target.result; // Cập nhật hình ảnh xem trước
                }
                reader.readAsDataURL(file); // Đọc file dưới dạng URL
            } else {
                avatarPreview.src = '/images/staff/default-product.png'; // Đặt lại hình ảnh mặc định nếu không có file
            }
        });
    });
    document.addEventListener('DOMContentLoaded', () => {
        const passwordSelect = document.getElementById('Password');
        const manualPasswordInput = document.getElementById('manualPassword');

        passwordSelect.addEventListener('change', function() {
            if (this.value === 'manual') {
                manualPasswordInput.style.display = 'block'; // Hiển thị ô nhập mật khẩu
            } else {
                manualPasswordInput.style.display = 'none'; // Ẩn ô nhập mật khẩu
                manualPasswordInput.value = ''; // Xóa giá trị ô nhập mật khẩu
            }
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Thêm người dùng thành công!',
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
