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
                            <label for="fullName">Họ và Tên<span class="required">*</span></label>
                            <input type="text" id="fullName" name="fullName" required>
                            <div id="nameError" style="color: red; display: none;"></div>
                        </div>
                        <div class="col">
                            <label for="roleId">Vai Trò<span class="required">*</span></label>
                            <select id="roleId" name="roleId" required>
                                <option value="" disabled selected>Chọn vai trò</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->RoleID }}">{{ $role->RoleName }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="dateOfBirth">Ngày Sinh<span class="required">*</span></label>
                            <input type="date" id="dateOfBirth" name="dateOfBirth" required>
                        </div>
                        <div class="col">
                            <label for="email">Email<span class="required">*</span></label>
                            <input type="email" id="email" name="email" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="phone">Số Điện Thoại:<span class="required">*</span></label>
                            <input type="tel" id="phone" name="phone" required placeholder="Nhập số điện thoại">
                            <div id="phoneError" style="color: red; display: none;"></div>
                        </div>
                        <div class="col">
                            <label for="address">Địa Chỉ<span class="required">*</span></label>
                            <input type="text" id="address" name="address" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="password">Mật Khẩu<span class="required">*</span></label>
                            <select id="password" name="passwordOption" required>
                                <option value="auto">Tự động sinh</option>
                                <option value="manual">Nhập thủ công</option>
                            </select>
                            <input type="password" id="manualPassword" name="manualPassword" placeholder="Nhập mật khẩu" style="display:none;" required>
                        </div>
                    </div>
                </div>
                <div class="image-upload">
                    <label for="avt">Ảnh đại diện</label>
                    <img id="avatarPreview" src="/images/staff/default-product.png" style="margin-bottom: 10px; max-width:100%; height:auto;">
                    <label for="avatar" class="file-upload-button">Chọn Ảnh</label>
                    <input type="file" id="avatar" name="avatar" required style="display: none;">
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
<script src="/js/staff/create.js"></script>
<script src="/js/login/order.js"></script>
<script src="/js/login/index.js"></script>
</body>
</html>
