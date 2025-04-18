@extends('layouts.app')

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
                            <x-form.input name="FullName" label="Tên nhân viên" type="text" placeholder="Nhập tên nhân viên" />
                        </x-form.group>
                        <x-form.group col="6">
                            <x-form.input name="Email" label="Email" type="text" placeholder="Nhập email nhân viên" />
                        </x-form.group>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <x-form.select name="RoleID" label="Vai trò" :options="$roles" :selected="old('RoleID')" />
                        </div>
                        <div class="col-md-4">
                            <x-form.select name="Gender" label="Giới tính" :options="$users" />
                        </div>
                        <div class="col-md-4">
                            <x-form.input name="Date_of_Birth" label="Ngày sinh" type="date" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <x-form.input name="Phone" label="Số điện thoại" type="text" placeholder="Nhập số điện thoại nhân viên" />
                        </div>
                        <div class="col-md-6">
                            <x-form.input name="AccountName" label="Tài khoản nhân viên" type="text" placeholder="Nhập tài khoản " />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <x-form.input name="Address" label="Địa chỉ" type="text" placeholder="Nhập địa chỉ nhân viên" />
                        </div>
                        <div class="col-md-6">
                            <x-form.input name="Password" label="Mật khẩu" type="text" :value="$password" placeholder="Nhập mật khẩu khách hàng" />
                        </div>
                    </div>
                </x-form.group>
                <div class="col-md-4">
                    <x-form.input name="Image" label="Hình ảnh" type="file" onchange="previewImage(event)" />
                    <img id="imagePreview" src="#" alt="Ảnh xem trước" style="max-width: 100%; margin-top: 10px; display: none;">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
            <a href="{{ route('show-customer.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
@endsection
@section('js')
    <script>
        function togglePassword(inputId, iconElement) {
            const input = document.getElementById(inputId);
            const icon = iconElement.querySelector('i');
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            } else {
                input.type = "password";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            }
        }
    </script>
    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('imagePreview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block'; // show image
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Optional: reset preview if user clicks remove file
        document.querySelector('input[name="Image"]').addEventListener('change', function (event) {
            if (!event.target.files.length) {
                const preview = document.getElementById('imagePreview');
                preview.src = '#';
                preview.style.display = 'none';
            }
        });
    </script>
@endsection

