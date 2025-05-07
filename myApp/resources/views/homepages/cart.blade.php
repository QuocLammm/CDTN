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

    </div>
@endsection

@section('footer')
    <div class="site-footer">
        @include('homepages.auth.footer')
    </div>
@endsection

