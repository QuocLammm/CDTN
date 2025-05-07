@extends('layouts.app')

@section('content')
    <div class="container">
        <br>
        <h3>Cập nhật thông tin sản phẩm</h3>

        <form action="{{ route('show-product.update', $product->product_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                {{--Left--}}
                <div class="col-md-8">
                    <x-form.input name="product_name" label="Tên sản phẩm"
                        type="text" :value="old('product_name', $product->product_name)" placeholder="Nhập tên sản phẩm" />

                    <div class="row">
                        <div class="col-md-6">
                            <x-form.select name="category_idid" label="Loại sản phẩm" :options="$categories" :selected="$product->category_id" />
                        </div>
                        <div class="col-md-6">
                            <x-form.select name="supplier_id" label="Nhà cung cấp" :options="$suppliers" :selected="$product->supplier_id" />
                        </div>
                    </div>

                    <x-form.input
                        name="price"
                        label="Giá"
                        type="number"
                        :value="old('Price', $product->price)"
                        placeholder="Nhập giá sản phẩm" />
                    <div class="row">
                        {{-- Size --}}
                        <div class="col-md-4">
                            <x-form.select
                                name="ProductDetail[size]"
                                label="Kích thước"
                                :options="[32 => 32, 33 => 33, 34 => 34, 35 => 35, 36 => 36, 37 => 37, 38 => 38, 39 => 39, 40 => 40, 41 => 41, 42 => 42, 43 => 43, 44 => 44, 45 => 45]"
                                :value="old('ProductDetail.size', $product->productDetail->size ?? '')"
                                placeholder="Chọn kích thước" />
                        </div>

                        {{-- Color --}}
                        <div class="col-md-4">
                            <x-form.input
                                name="ProductDetail[color]"
                                label="Màu sắc"
                                type="text"
                                :value="old('ProductDetail.color', $product->productDetail->color ?? '')"
                                placeholder="Nhập màu sắc" />
                        </div>

                        {{-- Quantity --}}
                        <div class="col-md-4">
                            <x-form.input
                                name="ProductDetail[quantity]"
                                label="Số lượng"
                                type="number"
                                :value="old('ProductDetail.quantity', $product->productDetail->quantity ?? '')"
                                placeholder="Nhập số lượng" />
                        </div>
                    </div>
                    <x-form.textarea
                        name="description"
                        label="Mô tả"
                        placeholder="Nhập mô tả"
                        rows="4">{{ old('Description', $product->description) }}</x-form.textarea>

                    <button type="submit" class="btn btn-success">Cập nhật sản phẩm</button>
                    <a href="{{ route('show-product.index') }}" class="btn btn-secondary">Quay lại</a>
                </div>
                {{-- Right --}}
                <div class="col-md-4">
                    <x-form.input name="image" label="Hình ảnh" type="file" onchange="previewImage(event)" />
                    <img id="imagePreview"
                          src="{{ $product->image ? asset($product->image) : '#' }}"
                          alt="Ảnh xem trước"
                          style="width: 100%; height: auto; object-fit: cover; margin-top: 10px; {{ $product->image ? '' : 'display: none;' }}">
                </div>
            </div>
        </form>
    </div>
@endsection
@push('js')
    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('imagePreview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    console.log('Image loaded:', e.target.result); // Thêm log để kiểm tra
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
    </script>
@endpush
