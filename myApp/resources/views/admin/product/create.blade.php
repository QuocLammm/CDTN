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
                   <div class="row">
                       <div class="col-md-4">
                           <x-form.select name="size" label="Kích cỡ" :options="array_combine(range(32, 45), range(32, 45))" />
                       </div>
                       <div class="col-md-4">
                           <x-form.input name="color" label="Màu sắc" type="text" placeholder="Nhập màu sắc" />
                       </div>
                       <div class="col-md-4">
                           <x-form.input name="quantity" label="Số lượng" type="number" placeholder="Nhập số lượng" />
                       </div>
                   </div>
                   <x-form.input name="price" label="Giá" type="number" placeholder="Nhập giá sản phẩm" />

                   <x-form.textarea name="description" label="Mô tả" placeholder="Nhập mô tả" rows="4" />
               </div>
               <div class="col-md-4">
                   <x-form.input name="image" label="Hình ảnh" type="file" onchange="previewImage(event)" />
                   <img id="imagePreview" src="#" alt="Ảnh xem trước"
                        style="width: 100%; max-height: 220px; object-fit: cover; border: 1px solid #ccc; border-radius: 8px; margin-top: 10px; display: none;">
               </div>
           </div>
            <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
            <a href="{{ route('show-product.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
@endsection
@push('js')
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
            } else {
                preview.src = '#';
                preview.style.display = 'none';
            }
        }

    </script>
    <script>
        @if(session('success'))
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
       @endif
    </script>
@endpush


