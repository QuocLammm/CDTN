@extends('layouts.supper_page')
@section('title', 'Chỉnh sửa thông tin nhân viên')
@section('reserved_css')
    <link rel="stylesheet" href="{{ asset('css/staff/create.css') }}">
@endsection
@section('content')
    <h1>Chỉnh sửa thông tin</h1>
    <form action="{{ route('staff.update', $users->UserID) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-container">
            <div class="form-fields">
                <div class="row">
                    <div class="col">
                        <label for="fullName">Họ và Tên<span class="required">*</span></label>
                        <input type="text" id="fullName" name="FullName"
                               value="{{ old('FullName', $users->FullName) }}" required>
                    </div>
                    <div class="col">
                        <label for="Gender">Giới Tính</label>
                        <select id="gender" name="Gender">
                            <option value="male" {{ $users->Gender == 'male' ? 'selected' : '' }}>Nam</option>
                            <option value="female" {{ $users->Gender == 'female' ? 'selected' : '' }}>Nữ</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="dateOfBirth">Ngày Sinh<span class="required">*</span></label>
                        <input type="date" id="dateOfBirth" name="Date_of_Birth"
                               value="{{ old('Date_of_Birth', $users->Date_of_Birth) }}" required>
                    </div>
                    <div class="col">
                        <label for="email">Email<span class="required">*</span></label>
                        <input type="email" id="email" name="Email" value="{{ old('Email', $users->Email) }}"
                               required>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="phone">Số Điện Thoại:<span class="required">*</span></label>
                        <input type="tel" id="phone" name="Phone" value="{{ old('Phone', $users->Phone) }}"
                               required>
                    </div>
                    <div class="col">
                        <label for="address">Địa Chỉ<span class="required">*</span></label>
                        <input type="text" id="address" name="Address" value="{{ old('Address', $users->Address) }}"
                               required>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="Password">Mật Khẩu</label>
                        <input type="password" id="password" name="Password"
                               value="{{ old('Password', $users->Password) }}" placeholder="Mật khẩu" required>
                    </div>
                </div>
            </div>
            <div class="image-upload">
                <label for="avatar">Ảnh đại diện</label>
                <div class="avatar-container">
                    <img id="avatarPreview"
                         src="{{ $users->avt ? asset('/images/staff/' . $users->avt) : '/images/staff/default-product.png' }}"
                         style="margin-bottom: 10px; width:250px; height:250px;"
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
@endsection


