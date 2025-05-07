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
                            <x-form.input name="password" label="Mật khẩu" type="text" value="{{ $password }}" />
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

{{--@section('js')--}}
{{--    <script>--}}
{{--        document.addEventListener('DOMContentLoaded', function () {--}}
{{--            const fullNameInput = document.querySelector('input[name="full_name"]');--}}
{{--            const accountNameInput = document.querySelector('input[name="account_name"]');--}}

{{--            function generateSlug() {--}}
{{--                let slug = fullNameInput.value.toLowerCase();--}}
{{--                slug = slug.normalize("NFD").replace(/[\u0300-\u036f]/g, "");--}}
{{--                slug = slug.replace(/[^a-z0-9]/g, '');--}}
{{--                accountNameInput.value = slug;--}}
{{--            }--}}

{{--            fullNameInput.addEventListener('input', generateSlug);--}}

{{--            // 👇 Gọi khi tải trang để đảm bảo có giá trị ngay từ đầu--}}
{{--            generateSlug();--}}

{{--            document.querySelector('form').addEventListener('submit', function () {--}}
{{--                console.log('Account Name:', accountNameInput.value);--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
{{--@endsection--}}

