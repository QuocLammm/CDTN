@extends('homepages.master_page')
@section('header')
    @if(Auth::check())
        @include('homepages.auth.header')
    @else
        @include('homepages.guest.header')
    @endif
@endsection

@section('scroll')
    @include('homepages.auth.scroll-bar')
@endsection
@section('item')
    @include('homepages.auth.item')
@endsection
@section('information')
    @include('homepages.auth.information')
@endsection
@section('footer')
    @include('homepages.auth.footer')
@endsection

