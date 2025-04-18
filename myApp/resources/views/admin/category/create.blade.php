@extends('layouts.app')
@section('content')
    <div class="container">
        <br>
        <h3>Thêm mới danh mục sản phẩm</h3>
        <form action="{{ route('show-category.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <x-form.input name="CategoryName" label="Tên loại sản phẩm" type="text" placeholder="Nhập tên loại sản phẩm" />
                    <x-form.textarea name="Description" label="Mô tả" placeholder="Nhập mô tả" rows="4" />
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
            <a href="{{ route('show-category.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
@endsection
@section('js')
    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('imagePreview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block'; // show image
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Optional: reset preview if user clicks remove file
        document.querySelector('input[name="Image"]').addEventListener('change', function (event) {
            if (!event.target.files.length) {
                const preview = document.getElementById('imagePreview');
                preview.src = '#';
                preview.style.display = 'none';
            }
        });
    </script>
@endsection

