@extends('homepages.master_page')
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/homepage/profile.css') }}">
@endpush
@section('header')
    <div class="site-header">
        @include('homepages.auth.header')
    </div>
@endsection
@section('content')
    <div class="main-content">
        <form action="{{ route('profile.update', ['id' => $user->user_id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="profile-container">
                <!-- Ảnh đại diện -->
                <div class="profile-left">
                    <img src="{{ asset($user->image) }}" alt="Profile Image">
                    <input type="file" name="image">
                </div>

                <!-- Thông tin tài khoản -->
                <div class="profile-middle">
                    <h3><i class="fas fa-user"></i> Thông tin tài khoản</h3>

                    <div class="form-group">
                        <label>Tên tài khoản</label>
                        <input type="text" name="account_name" value="{{ $user->account_name }}">
                    </div>

                    <div class="form-group">
                        <label>Họ và tên</label>
                        <input type="text" name="full_name" value="{{ $user->full_name }}">
                    </div>

                    <div class="form-group">
                        <label>Ngày sinh</label>
                        <input type="date" name="birthday" value="{{ $user->birthday }}">
                    </div>
                </div>

                <!-- Thông tin liên hệ -->
                <div class="profile-right">
                    <h3><i class="fas fa-address-book"></i> Thông tin liên hệ</h3>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ $user->email }}">
                    </div>

                    <div class="form-group">
                        <label>Số điện thoại</label>
                        <input type="text" name="phone" value="{{ $user->phone }}">
                    </div>

                    <div class="form-group">
                        <label>Địa chỉ</label>
                        <textarea name="address" rows="3">{{ $user->address }}</textarea>
                    </div>

                    <button type="submit" class="submit-btn">Lưu thay đổi</button>
                </div>

            </div>
        </form>
    </div>
@endsection

@section('footer')
    <div class="site-footer">
        @include('homepages.auth.footer')
    </div>
@endsection

