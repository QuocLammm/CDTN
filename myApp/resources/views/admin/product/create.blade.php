@extends('layouts.app')
@php
    $breadcrumbItems = [
        ['label' => 'Sản phẩm', 'url' => route('show-product.index')],
        ['label' => 'Thêm mới sản phẩm']
    ];
@endphp
@section('content')
    @include('layouts.header')
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
                   <div class="form-group mt-3">
                       <label for="images">Hình ảnh sản phẩm (có thể chọn nhiều ảnh)</label>
                       <input type="file" name="images[]" id="multi-image-input" multiple class="form-control">
                   </div>
                   <div class="form-group mt-2">
                       <div id="preview-multiple-images" class="d-flex flex-wrap mt-3" style="gap: 6.5px;"></div>
                   </div>
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
        input.addEventListener('change', function (e) {
            const files = Array.from(e.target.files);

            for (const file of files) {
                // Kiểm tra trùng lặp
                if (!selectedImages.some(f => f.name === file.name && f.lastModified === file.lastModified)) {
                    selectedImages.push(file);
                }
            }

            previewContainer.innerHTML = '';
            for (const file of selectedImages) {
                const reader = new FileReader();
                reader.onload = function (event) {
                    const img = document.createElement('img');
                    img.src = event.target.result;
                    // Style...
                    previewContainer.appendChild(img);
                };
                reader.readAsDataURL(file);
            }
        });

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


