@extends('layouts.supper_page')
@section('title', 'Chỉnh sửa thông tin khách hàng')
@section('reserved_css')
    <link rel="stylesheet" href="{{ asset('css/staff/create.css') }}">
@endsection
@section('content')
    <h1>Chỉnh sửa thông tin</h1>
    <form action="{{ route('customer.update', $customers->UserID) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-container">
            <div class="form-fields">
                <div class="row">
                    <div class="col">
                        <label for="fullName">Họ và Tên<span class="required">*</span></label>
                        <input type="text" id="fullName" name="FullName"
                               value="{{ old('FullName', $customers->FullName) }}" required>
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
                        <input type="date" id="dateOfBirth" name="Date_of_Birth"
                               value="{{ old('Date_of_Birth', $customers->Date_of_Birth) }}" required>
                    </div>
                    <div class="col">
                        <label for="email">Email<span class="required">*</span></label>
                        <input type="email" id="email" name="Email" value="{{ old('Email', $customers->Email) }}"
                               required>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="phone">Số Điện Thoại:<span class="required">*</span></label>
                        <input type="tel" id="phone" name="Phone" value="{{ old('Phone', $customers->Phone) }}"
                               required>
                    </div>
                    <div class="col">
                        <label for="address">Địa Chỉ<span class="required">*</span></label>
                        <input type="text" id="address" name="Address" value="{{ old('Address', $customers->Address) }}"
                               required>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="Password">Mật Khẩu</label>
                        <input type="password" id="password" name="Password"
                               value="{{ old('Password', $customers->Password) }}" placeholder="Mật khẩu" required>
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
@endsection


