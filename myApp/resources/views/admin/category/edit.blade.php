@extends('layouts.app')

@section('content')
    <div class="container">
        <br>
        <h3>Chỉnh sửa sản phẩm</h3>
        <form action="{{ route('show-category.update', $category->CategoryID) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                {{--Left--}}
                <div class="col-md-8">
                    <x-form.input name="CategoryName" label="Tên loại sản phẩm" type="text" :value="old('CategoryName', $category->CategoryName)" placeholder="Nhập tên loại sản phẩm sản phẩm" />
                    <x-form.textarea
                        name="Description"
                        label="Mô tả"
                        placeholder="Nhập mô tả"
                        rows="4">{{ old('Description', $category->Description) }}</x-form.textarea>

                    <button type="submit" class="btn btn-success">Cập nhật sản phẩm</button>
                    <a href="{{ route('show-category.index') }}" class="btn btn-secondary">Quay lại</a>
                </div>
            </div>
        </form>
    </div>
@endsection
