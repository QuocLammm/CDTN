@extends('layouts.app')
@section('content')
    <div class="container">
        <br>
        <h3>Cập nhật thông tin nhân viên</h3>
        <form action="{{ route('show-staff.update', $user->user_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <x-form.group col="8">
                    <div class="row">
                        <x-form.group col="6">
                            <x-form.input name="full_name" label="Tên nhân viên" type="text" placeholder="Nhập tên nhân viên" :value="$user->full_name" />
                        </x-form.group>
                        <x-form.group col="6">
                            <x-form.input name="account_name" label="Tên tài khoản" type="text" placeholder="Nhập email nhân viên" :value="$user->account_name" />
                        </x-form.group>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <x-form.select name="role_id" label="Vai trò" :options="$roles" :selected="$user->role_id" />
                        </div>
                        <div class="col-md-4">
                            <x-form.select name="gender" label="Giới tính" :options="$users" :selected="$user->gender" />
                        </div>
                        <div class="col-md-4">
                            <x-form.input name="date_of_birth" label="Ngày sinh" type="date" :value="old('date_of_birth', \Carbon\Carbon::parse($user->date_of_birth)->format('Y-m-d'))"
                            />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <x-form.input name="phone" label="Số điện thoại" type="text" placeholder="Nhập số điện thoại" :value="$user->phone" />
                        </div>
                        <x-form.group col="6">
                            <x-form.input name="email" label="Email" type="text" placeholder="Nhập email nhân viên" :value="$user->email" />
                        </x-form.group>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <x-form.input name="address" label="Địa chỉ" type="text" placeholder="Nhập địa chỉ" :value="$user->address" />
                        </div>
                        <div class="col-md-6">
                            <x-form.input name="password" label="Mật khẩu" type="password" placeholder="Để trống nếu không đổi" />
                        </div>
                    </div>
                </x-form.group>
                <div class="col-md-4">
                    <x-form.input name="image" label="Hình ảnh" type="file" onchange="previewImage(event)" />
                    <img id="imagePreview"
                         src="{{ $user->image ? asset($user->image) : '#' }}"
                         alt="Ảnh xem trước"
                         style="width: 100%; height: auto; object-fit: cover; margin-top: 10px; {{ $user->image ? '' : 'display: none;' }}">
                </div>
            </div>
            <button type="submit" class="btn btn-success">Cập nhật</button>
            <a href="{{ route('show-staff.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
@endsection
@push('js')
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
@endpush
