@extends('layouts.supper_page')
@section('title', 'Thêm mới')
@section('content')
    <h1>Thêm Loại Sản Phẩm Mới</h1>
    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-container">
            <div class="form-fields">
                <div class="row">
                    <div class="col">
                        <label for="CategoryName">Tên loại sản phẩm<span class="required">*</span></label>
                        <input type="text" id="CategoryName" name="CategoryName" required>
                        <div id="nameError" style="color: red; display: none;"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="Description">Mô tả<span class="required">*</span></label>
                        <textarea id="Description" name="Description" required></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="button-group">
            <button type="submit" class="btn-submit">Thêm Mới</button>
            <a href={{route('categories.index')}} class="btn-back">
                Quay Lại
            </a>
        </div>
    </form>
@endsection

