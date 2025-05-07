@extends('layouts.app')
@push('css')
    <style>
        #resetPasswordBtn {
            height: 100%; /* Đảm bảo chiều cao bằng với ô nhập */
            line-height: normal; /* Căn chỉnh nội dung bên trong */
            padding: 0.300rem 0.75rem; /* Đảm bảo padding phù hợp */
            display: flex; /* Sử dụng Flexbox để căn giữa */
            justify-content: center; /* Căn giữa nội dung theo chiều ngang */
            align-items: center; /* Căn giữa nội dung theo chiều dọc */
        }
    </style>
    @endpush
@section('content')
    <div class="container">
        <br>
        <h3>Thêm mới nhân viên</h3>
        <form action="{{ route('show-staff.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <x-form.group col="8">
                    <div class="row">
                        <x-form.group col="6">
                            <x-form.input name="full_name" label="Tên nhân viên" type="text" placeholder="Nhập tên nhân viên"  />
                        </x-form.group>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <x-form.select name="role_id" label="Vai trò" :options="$roles" :selected="old('role_id')" />
                        </div>
                        <div class="col-md-4">
                            <x-form.select name="gender" label="Giới tính" :options="$users" />
                        </div>
                        <div class="col-md-4">
                            <x-form.input name="date_of_birth" label="Ngày sinh" type="date" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <x-form.input name="phone" label="Số điện thoại" type="text" placeholder="Nhập số điện thoại nhân viên" />
                        </div>
                        <div class="col-md-6">
                            <x-form.input name="email" label="Email" type="email" placeholder="Nhập email"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <x-form.input name="address" label="Địa chỉ" type="text" placeholder="Nhập địa chỉ nhân viên" />
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <div class="row">
                                <div class="col-md-10" style="padding-right: 0;">
                                    <input type="text" name="password" id="password" class="form-control" placeholder="Tự động tạo hoặc chỉnh sửa" value="{{ $password }}">
                                </div>
                                <div class="col-md-2" style="padding-left: 0;">
                                    <a href="#" id="resetPasswordBtn" class="btn btn-outline-secondary" title="Tạo lại mật khẩu ngẫu nhiên" style="background-color: #f0f0f0; width: 100%;">
                                        <i class="fa fa-sync"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </x-form.group>
                <div class="col-md-4">
                    <x-form.input name="image" label="Hình ảnh" type="file" onchange="previewImage(event)" />
                    <img id="imagePreview" src="#" alt="Ảnh xem trước" style="max-width: 100%; margin-top: 10px; display: none;">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Thêm nhân viên</button>
            <a href="{{ route('show-customer.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
@endsection

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const passwordField = document.querySelector('#password');
            const resetPasswordBtn = document.querySelector('#resetPasswordBtn');

            if (passwordField && resetPasswordBtn) {
                resetPasswordBtn.addEventListener('click', function (e) {
                    e.preventDefault();

                    // Tạo mật khẩu mới
                    const generatePassword = () => {
                        const lowercase = String.fromCharCode(Math.floor(Math.random() * 26) + 97);
                        const uppercase = String.fromCharCode(Math.floor(Math.random() * 26) + 65);
                        const number = Math.floor(Math.random() * 10).toString();
                        const symbol = ['@', '#', '$', '%', '&', '*', '!', '?'][Math.floor(Math.random() * 8)];
                        const others = Array.from({ length: 6 }, () =>
                            String.fromCharCode(Math.floor(Math.random() * 26) + 97)
                        );

                        const passwordArray = [lowercase, uppercase, number, symbol, ...others];
                        const shuffled = passwordArray.sort(() => Math.random() - 0.5);
                        return shuffled.join('');
                    };

                    // Cập nhật trường mật khẩu
                    passwordField.value = generatePassword();
                });
            }
        });
    </script>
@endpush
