@extends('layouts.app')
@php
    $breadcrumbItems = [
        ['label' => 'Nhà cung cấp', 'url' => route('show-supplier.index')],
        ['label' => 'Cập nhật thông tin nhà cung cấp']
    ];
@endphp
@section('content')
    @include('layouts.header')
    <div class="container">
        <br>
        <h3>Cập nhật thông tin nhà cung cấp</h3>

        <form action="{{ route('show-supplier.update', $supplier->supplier_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="supplier_name">Tên nhà cung cấp</label>
                        <input type="text" name="supplier_name" class="form-control" value="{{ old('supplier_name', $supplier->supplier_name) }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="contact_name">Tên người liên hệ</label>
                        <input type="text" name="contact_name" class="form-control" value="{{ old('contact_name', $supplier->contact_name) }}">
                    </div>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="phone">Số điện thoại</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $supplier->phone) }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $supplier->email) }}">
                    </div>
                </div>
            </div>

            <div class="form-group mt-2">
                <label for="address">Địa chỉ</label>
                <textarea name="address" class="form-control" rows="3">{{ old('address', $supplier->address) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Cập nhật</button>
            <a href="{{ route('show-supplier.index') }}" class="btn btn-secondary mt-3">Quay lại</a>
        </form>
    </div>
@endsection

