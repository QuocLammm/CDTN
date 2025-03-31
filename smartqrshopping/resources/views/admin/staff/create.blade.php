@extends('layouts.supper_page')
@section('title', 'Thêm mới nhân viên')
@section('reserved_css')
    <link rel="stylesheet" href="{{ asset('css/staff/create.css') }}">
@endsection
@section('content')
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
@endsection
@section('reserved_js')
    <script src="{{ asset('/js/staff/create.js')}}"></script>
@endsection
