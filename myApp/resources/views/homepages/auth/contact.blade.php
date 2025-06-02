@extends('homepages.master_page')
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/homepage/contact.css') }}">
@endpush
@section('header')
    @include('homepages.auth.header')
@endsection

@section('content')
    <div class="main-content">
        <div class="contact-page" style="display: flex; flex-wrap: wrap; gap: 40px; justify-content: space-between;">
            <!-- Thông tin cửa hàng -->
            <div class="contact-info" style="flex: 1; min-width: 300px;">
                <h2>Liên hệ với chúng tôi</h2>
                <p><strong>Địa chỉ:</strong> {{ $settings['address'] }}</p>
                <p><strong>Điện thoại:</strong> {{ $settings['phone'] }}</p>
                <p><strong>Email:</strong> {{ $settings['email'] }}</p>
                <p><strong>Giờ mở cửa:</strong> {{ $settings['opening_hours'] }}</p>
            </div>

            <!-- Bản đồ -->
            <div class="map" style="flex: 1; min-width: 300px;">
                {!! $settings['google_map_iframe'] !!}
            </div>
        </div>

        <!-- Form liên hệ -->
        <div class="contact-form" style="margin-top: 50px;">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <h2>Gửi liên hệ cho chúng tôi</h2>
            <form action="{{ route('contact.send') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div style="margin-bottom: 15px;">
                    <label for="full_name">Họ và tên <span style="color: red;">*</span></label><br>
                    <input type="text" id="full_name" name="full_name" value="{{ old('full_name') }}" required style="width: 100%; padding: 10px;">
                    @error('full_name')
                        <div style="color: red; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>
                <div style="margin-bottom: 15px;">
                    <label for="email">Email <span style="color: red;">*</span></label><br>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required style="width: 100%; padding: 10px;">
                    @error('email')
                    <div style="color: red; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>
                <div style="margin-bottom: 15px;">
                    <label for="phone">Số điện thoại <span style="color: red;">*</span></label><br>
                    <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required style="width: 100%; padding: 10px;">
                    @error('phone')
                    <div style="color: red; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>
                <div style="margin-bottom: 15px;">
                    <label for="subject">Chủ đề <span style="color: red;">*</span></label><br>
                    <input type="text" id="subject" name="subject" value="{{ old('subject') }}" required style="width: 100%; padding: 10px;">
                    @error('subject')
                    <div style="color: red; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>
                <div style="margin-bottom: 15px;">
                    <label for="message">Nội dung <span style="color: red;">*</span></label><br>
                    <textarea name="message" id="ckeditor" class="form-control" required style="width: 100%; padding: 10px;">{{ old('message') }}</textarea>
                    @error('message')
                    <div style="color: red; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" style="padding: 10px 20px; background-color: #007BFF; color: white; border: none; border-radius: 5px;">Gửi liên hệ</button>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('ckeditor');
    </script>
@endpush

@section('footer')
    <div class="site-footer">
        @include('homepages.auth.footer_no_sale')
    </div>
@endsection
