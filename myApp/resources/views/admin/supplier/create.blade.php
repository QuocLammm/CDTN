@extends('layouts.app')
@php
    $breadcrumbItems = [
        ['label' => 'Nhà cung cấp', 'url' => route('show-supplier.index')],
        ['label' => 'Thêm mới nhà cung cấp']
    ];
@endphp

@section('content')
    @include('layouts.header')
    <div class="container">
        <br>
        <h3>Thêm mới nhà cung cấp</h3>
        <form action="{{ route('show-supplier.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Row 1: Tên nhà cung cấp & Tên người liên hệ --}}
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="supplier_name">Tên nhà cung cấp</label>
                    <input type="text" name="supplier_name" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="contact_name">Tên người liên hệ</label>
                    <input type="text" name="contact_name" class="form-control">
                </div>
            </div>

            {{-- Row 2: Số điện thoại & Email --}}
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="phone">Số điện thoại</label>
                    <input type="text" name="phone" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control">
                </div>
            </div>

            {{-- Row 3: Địa chỉ (textarea chiếm toàn hàng) --}}
            <div class="form-group">
                <label for="address">Địa chỉ</label>
                <textarea name="address" class="form-control" rows="3"></textarea>
            </div>

            {{-- Buttons --}}
            <button type="submit" class="btn btn-primary">Thêm mới nhà cung cấp</button>
            <a href="{{ route('show-supplier.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
@endsection
