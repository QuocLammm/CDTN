@extends('layouts.app')
@section('content')
    <div class="container">
        <br>
        <h3>Cập nhật thông tin khách hàng</h3>
        <form action="{{ route('show-customer.update', $customer->UserID) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <x-form.group col="8">
                    <div class="row">
                        <x-form.group col="6">
                            <x-form.input name="FullName" label="Tên nhân viên" type="text" placeholder="Nhập tên nhân viên" :value="$customer->FullName" />
                        </x-form.group>
                        <x-form.group col="6">
                            <x-form.input name="Email" label="Email" type="text" placeholder="Nhập email nhân viên" :value="$customer->Email" />
                        </x-form.group>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <x-form.select name="RoleID" label="Vai trò" :options="$roles" :selected="$customer->RoleID" />
                        </div>
                        <div class="col-md-4">
                            <x-form.select name="Gender" label="Giới tính" :options="$customers" :selected="$customer->Gender" />
                        </div>
                        <div class="col-md-4">
                            <x-form.input name="Date_of_Birth" label="Ngày sinh" type="date" :value="old('Date_of_Birth', \Carbon\Carbon::parse($customer->Date_of_Birth)->format('Y-m-d'))"
                            />

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <x-form.input name="Phone" label="Số điện thoại" type="text" placeholder="Nhập số điện thoại" :value="$customer->Phone" />
                        </div>
                        <div class="col-md-6">
                            <x-form.input name="AccountName" label="Tài khoản nhân viên" type="text" placeholder="Nhập tài khoản" :value="$customer->AccountName" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <x-form.input name="Address" label="Địa chỉ" type="text" placeholder="Nhập địa chỉ" :value="$customer->Address" />
                        </div>
                        <div class="col-md-6">
                            <x-form.input name="Password" label="Mật khẩu" type="password" placeholder="Để trống nếu không đổi" />
                        </div>
                    </div>
                </x-form.group>
                <div class="col-md-4">
                    <x-form.input name="Image" label="Hình ảnh" type="file" onchange="previewImage(event)" />
                    <img id="imagePreview"
                         src="{{ $customer->Image ? asset($customer->Image) : '#' }}"
                         alt="Ảnh xem trước"
                         style="max-width: 100%; margin-top: 10px; {{ $customer->Image ? '' : 'display: none;' }}">
                </div>
            </div>
            <button type="submit" class="btn btn-success">Cập nhật</button>
            <a href="{{ route('show-customer.index') }}" class="btn btn-secondary">Quay lại</a>
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
