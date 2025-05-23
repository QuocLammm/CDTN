@extends('layouts.app')
@php
    $breadcrumbItems = [
        ['label' => 'Khách hàng', 'url' => route('show-customer.index')],
        ['label' => 'Cập nhật thông tin khách hàng']
    ];
@endphp
@section('content')
    @include('layouts.header')
    <div class="container">
        <br>
        <h3>Cập nhật thông tin khách hàng</h3>
        <form action="{{ route('show-customer.update', $customer->user_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <x-form.group col="8">
                    <div class="row">
                        <x-form.group col="6">
                            <x-form.input name="full_name" label="Tên nhân viên" type="text" placeholder="Nhập tên nhân viên" :value="$customer->full_name" />
                        </x-form.group>
                        <x-form.group col="6">
                            <x-form.input name="account_name" label="Tài khoản" type="text" placeholder="Nhập tài khoản khách hàng" :value="$customer->account_name" />
                        </x-form.group>

                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="role_id" class="form-label">Vai trò</label>
                            <input type="text" id="role_id" class="form-control" value="{{ $customer->role->role_name }}" readonly />
                            <input type="hidden" name="role_id" value="{{ $customer->role_id }}" /> <!-- Lưu role_id để gửi đi -->
                        </div>
                        <div class="col-md-4">
                            <x-form.select name="gender" label="Giới tính" :options="$customers" :selected="$customer->gender" />
                        </div>
                        <div class="col-md-4">
                            <x-form.input name="date_of_birth" label="Ngày sinh" type="date" :value="old('date_of_birth', \Carbon\Carbon::parse($customer->date_of_birth)->format('Y-m-d'))"
                            />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <x-form.input name="phone" label="Số điện thoại" type="text" placeholder="Nhập số điện thoại" :value="$customer->phone" />
                        </div>
                        <x-form.group col="6">
                            <x-form.input name="email" label="Email" type="text" placeholder="Nhập email nhân viên" :value="$customer->email" />
                        </x-form.group>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <x-form.input name="address" label="Địa chỉ" type="text" placeholder="Nhập địa chỉ" :value="$customer->address" />
                        </div>
                        <div class="col-md-6">
                            <x-form.input name="password" label="Mật khẩu" type="password" placeholder="Để trống nếu không đổi" />
                        </div>
                    </div>
                </x-form.group>
                <div class="col-md-4">
                    <x-form.input name="image" label="Hình ảnh" type="file" onchange="previewImage(event)" />
                    <img id="imagePreview"
                         src="{{ $customer->image ? asset($customer->image) : '#' }}"
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

        document.querySelector('input[name="image"]').addEventListener('change', function (event) {
            if (!event.target.files.length) {
                const preview = document.getElementById('imagePreview');
                preview.src = '#';
                preview.style.display = 'none';
            }
        });
    </script>
@endsection
