@extends('homepages.master_page')

@push('css')
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            overflow: hidden;
            font-family: Arial, sans-serif;
        }

        .site-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 80px;
            background-color: #fff;
            z-index: 1000;
            border-bottom: 1px solid #ccc;
        }

        .site-footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 280px;
            background-color: #fff;
            border-top: 1px solid #ccc;
        }

        .main-content {
            position: absolute;
            top: 80px; /* hoặc chiều cao thực tế của header */
            bottom: 0;
            left: 0;
            right: 0;
            overflow-y: auto;
            padding: 40px 20px 120px; /* padding-bottom đủ để tránh đè footer */
            box-sizing: border-box;
            background-color: #fff;
        }
    </style>
@endpush

@section('header')
    <div class="site-header">
        @include('homepages.auth.header')
    </div>
@endsection

@section('content')
    <div class="main-content">
        <p>Đây là nội dung dài có thể cuộn. Thử thêm nhiều dòng để kiểm tra...</p>
        @for ($i = 0; $i < 100; $i++)
            <p>Dòng {{ $i + 1 }}</p>
        @endfor
    </div>
@endsection

@section('footer')
    <div class="site-footer">
        @include('homepages.auth.footer')
    </div>
@endsection
