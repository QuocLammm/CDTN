@extends('layouts.app')
@php
    $breadcrumbItems = [
        ['label' => 'Danh mục sản phẩm', 'url' => route('show-category.index')],
        ['label' => 'Thêm mới danh mục sản phẩm']
    ];
@endphp
@section('content')
    @include('layouts.header')
    <div class="container">
        <br>
        <h3>Thêm mới danh mục sản phẩm</h3>
        <form action="{{ route('show-category.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <x-form.input name="category_name" label="Tên loại sản phẩm" type="text" placeholder="Nhập tên loại sản phẩm" />
                    <x-form.textarea name="description" label="Mô tả" placeholder="Nhập mô tả" rows="4" />
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Thêm danh mục sản phẩm</button>
            <a href="{{ route('show-category.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
@endsection


