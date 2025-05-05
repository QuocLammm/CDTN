@extends('layouts.app')

@section('content')
    <div class="container">
        <br>
        <h3>Thêm mới sản phẩm</h3>
        {{-- Form thêm sản phẩm --}}
        <form action="{{ route('show-product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Kiểm tra lỗi -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Đã xảy ra lỗi!</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
           <div class="row">
               <div class="col-md-8">
                   <x-form.input name="product_name" label="Tên sản phẩm" type="text" placeholder="Nhập tên sản phẩm" />
                   <div class="row">
                       <div class="col-md-6">
                           <x-form.select name="category_id" label="Loại sản phẩm" :options="$categories" />
                       </div>
                       <div class="col-md-6">
                           <x-form.select name="supplier_id" label="Nhà cung cấp" :options="$suppliers" />
                       </div>
                   </div>
                   <x-form.input name="price" label="Giá" type="number" placeholder="Nhập giá sản phẩm" />
                   <x-form.textarea name="description" label="Mô tả" placeholder="Nhập mô tả" rows="4" />
               </div>
               <div class="col-md-4">
                   <x-form.input name="image" label="Hình ảnh" type="file" onchange="previewImage(event)" />
                   <img id="imagePreview" src="#" alt="Ảnh xem trước" style="max-width: 100%; margin-top: 10px; display: none;">
               </div>
           </div>
            <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
            <a href="{{ route('show-product.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('imagePreview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        document.querySelector('input[name="image"]').addEventListener('change', function (event) {
            if (!event.target.files.length) {
                const preview = document.getElementById('imagePreview');
                preview.src = '#';
                preview.style.display = 'none';
            }
        });

        // Hiển thị thông báo thành công nếu có session 'success'
        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Thành công!',
            text: '{{ session('success') }}',
            confirmButtonText: 'OK'
        });
        @endif
    </script>
@endsection


