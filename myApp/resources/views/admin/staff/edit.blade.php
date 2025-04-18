@extends('layouts.app')
@section('content')
    <div class="container">
        <br>
        <h3>Cập nhật thông tin nhân viên</h3>
        <form action="{{ route('show-staff.update', $user->UserID) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <x-form.group col="8">
                    <div class="row">
                        <x-form.group col="6">
                            <x-form.input name="FullName" label="Tên nhân viên" type="text" placeholder="Nhập tên nhân viên" :value="$user->FullName" />
                        </x-form.group>
                        <x-form.group col="6">
                            <x-form.input name="Email" label="Email" type="text" placeholder="Nhập email nhân viên" :value="$user->Email" />
                        </x-form.group>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <x-form.select name="RoleID" label="Vai trò" :options="$roles" :selected="$user->RoleID" />
                        </div>
                        <div class="col-md-4">
                            <x-form.select name="Gender" label="Giới tính" :options="$users" :selected="$user->Gender" />
                        </div>
                        <div class="col-md-4">
                            <x-form.input name="Date_of_Birth" label="Ngày sinh" type="date" :value="old('Date_of_Birth', \Carbon\Carbon::parse($user->Date_of_Birth)->format('Y-m-d'))"
                            />

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <x-form.input name="Phone" label="Số điện thoại" type="text" placeholder="Nhập số điện thoại" :value="$user->Phone" />
                        </div>
                        <div class="col-md-6">
                            <x-form.input name="AccountName" label="Tài khoản nhân viên" type="text" placeholder="Nhập tài khoản" :value="$user->AccountName" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <x-form.input name="Address" label="Địa chỉ" type="text" placeholder="Nhập địa chỉ" :value="$user->Address" />
                        </div>
                        <div class="col-md-6">
                            <x-form.input name="Password" label="Mật khẩu" type="password" placeholder="Để trống nếu không đổi" />
                        </div>
                    </div>
                </x-form.group>
                <div class="col-md-4">
                    <x-form.input name="Image" label="Hình ảnh" type="file" onchange="previewImage(event)" />
                    <img id="imagePreview"
                         src="{{ $user->Image ? asset($user->Image) : '#' }}"
                         alt="Ảnh xem trước"
                         style="max-width: 100%; margin-top: 10px; {{ $user->Image ? '' : 'display: none;' }}">
                </div>
            </div>
            <button type="submit" class="btn btn-success">Cập nhật</button>
            <a href="{{ route('show-staff.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
@endsection
@section('js')
    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('imagePreview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        document.querySelector('input[name="Image"]').addEventListener('change', function (event) {
            if (!event.target.files.length) {
                const preview = document.getElementById('imagePreview');
                preview.src = '#';
                preview.style.display = 'none';
            }
        });
    </script>
@endsection
