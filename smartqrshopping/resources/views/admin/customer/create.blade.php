@extends('layouts.supper_page')
@section('title', 'Tạo mới khách hàng')
@section('reserved_css')
    <link rel="stylesheet" href="{{ asset('css/staff/create.css') }}">
@endsection
@section('content')
    <h1>Thêm Khách Hàng Mới</h1>
    <form action="{{ route('customer.store') }}" method="POST" enctype="multipart/form-data">
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
                        <label for="Gender">Giới Tính</label>
                        <select id="Gender" name="Gender">
                            <option value="male" {{ old('Gender') == 'male' ? 'selected' : '' }}>Nam</option>
                            <option value="female" {{ old('Gender') == 'female' ? 'selected' : '' }}>Nữ</option>
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
                <img id="avatarPreview" src="/images/customers/default-product.png" style="margin-bottom: 10px; max-width:100%; height:auto;">
                <label for="avatar" class="file-upload-button">Chọn Ảnh</label>
                <input type="file" id="avatar" name="avatar" required style="display: none;">
            </div>
        </div>
        <div class="button-group">
            <button type="submit" class="btn-submit">Thêm Mới</button>
            <a href={{route('customer.index')}} class="btn-back">
                Quay Lại
            </a>
        </div>
    </form>
@endsection
@section('reserved_js')
    <script src="/js/staff/create.js"></script>
@endsection
