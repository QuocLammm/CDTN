@extends('layouts.supper_page')
@section('title', 'Chỉnh sửa')
@section('content')
    <h1>Chỉnh sửa thông tin</h1>
    <form action="{{ route('categories.update', $category->CategoryID) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-container">
            <div class="form-fields">
                <div class="row">
                    <div class="col">
                        <label for="CategoryName">Tên loại sản phẩm<span class="required">*</span></label>
                        <input type="text" id="CategoryName" name="CategoryName" value="{{ old('CategoryName', $category->CategoryName) }}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="Description">Mô tả<span class="required">*</span></label>
                        <textarea id="Description" name="Description" required>{{ old('Description', $category->Description) }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="button-group">
            <button type="submit" class="btn-submit">Cập nhật</button>
            <a href="{{ route('categories.index') }}" class="btn-back">Quay Lại</a>
        </div>
    </form>
@endsection

