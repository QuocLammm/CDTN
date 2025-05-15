@extends('layouts.app')
@push('css')
    <style>
        .btn-close {
        color: red !important; /* Force the color to be red */
        border: none;
        }

    </style>
@endpush
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
                        @foreach ($product->productDetails as $index => $detail)
                                <input type="hidden" name="ProductDetail[{{ $index }}][id]" value="{{ $detail->id }}">

                                <div class="col-md-4">
                                    <x-form.input
                                        name="ProductDetail[{{ $index }}][color]"
                                        label="Màu sắc"
                                        type="text"
                                        :value="old('ProductDetail.' . $index . '.color', $detail->color)"
                                        placeholder="Nhập màu sắc" />
                                </div>

                                <div class="col-md-4">
                                    <x-form.input
                                        name="ProductDetail[{{ $index }}][size]"
                                        label="Kích cỡ"
                                        type="text"
                                        :value="old('ProductDetail.' . $index . '.size', $detail->size)"
                                        placeholder="Nhập kích cỡ" />
                                </div>

                                <div class="col-md-4">
                                    <x-form.input
                                        name="ProductDetail[{{ $index }}][quantity]"
                                        label="Số lượng"
                                        type="number"
                                        :value="old('ProductDetail.' . $index . '.quantity', $detail->quantity)"
                                        placeholder="Nhập số lượng" />
                                </div>
                        @endforeach
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
                    <div class="form-group mt-3">
                        <label for="images">Hình ảnh sản phẩm (có thể chọn nhiều ảnh)</label>
                        <input type="file" name="images[]" id="multi-image-input" multiple class="form-control">
                    </div>
                    @if($product->images->count())
                        <div class="d-flex flex-wrap mt-2" style="gap: 8px;">
                            @foreach($product->images as $image)
                                <div class="position-relative" style="width: 95px; height: 95px;">
                                    <img src="{{ asset($image->image_path) }}"
                                         class="rounded"
                                         style="width: 100%; height: 100%; object-fit: cover;">

                                    <button type="button"
                                            class="btn-close btn-sm position-absolute top-0 end-0 m-1"
                                            style="z-index: 10; background-color: red; border: 1px solid red;"
                                            onclick="removeImage({{ $image->id }}, this)">
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

            </div>
        </form>
    </div>
@endsection
@push('js')
    <script>
        function removeImage(imageId, button) {
            // Xoá ảnh ngay mà không hỏi lại
            fetch(`/admin/product-images/${imageId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                }
            }).then(res => {
                if (res.ok) {
                    button.parentElement.remove();

                } else {
                    alert('Xoá ảnh thất bại.');
                }
            }).catch(() => alert('Lỗi mạng khi xoá ảnh.'));
        }

    </script>
    <script>
        const input = document.getElementById('multi-image-input');
        const previewContainer = document.getElementById('preview-multiple-images');
        let selectedImages = [];

        input.addEventListener('change', function (e) {
            const files = Array.from(e.target.files);

            for (const file of files) {
                // Tránh trùng ảnh
                if (!selectedImages.some(f => f.name === file.name && f.lastModified === file.lastModified)) {
                    selectedImages.push(file);
                }
            }

            renderPreviews();
        });

        function renderPreviews() {
            previewContainer.innerHTML = '';

            selectedImages.forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function (event) {
                    const wrapper = document.createElement('div');
                    wrapper.classList.add('position-relative');
                    wrapper.style.width = '100px';
                    wrapper.style.height = '100px';

                    const img = document.createElement('img');
                    img.src = event.target.result;
                    img.style.width = '100%';
                    img.style.height = '100%';
                    img.style.objectFit = 'cover';
                    img.classList.add('rounded');

                    const closeBtn = document.createElement('button');
                    closeBtn.innerHTML = '&times;';
                    closeBtn.type = 'button';
                    closeBtn.className = 'btn-close btn-sm position-absolute top-0 end-0 m-1';
                    closeBtn.style.zIndex = '10';
                    closeBtn.style.backgroundColor = 'rgba(255,255,255,0.7)';
                    closeBtn.onclick = function () {
                        selectedImages.splice(index, 1);
                        renderPreviews();
                    };

                    wrapper.appendChild(img);
                    wrapper.appendChild(closeBtn);
                    previewContainer.appendChild(wrapper);
                };
                reader.readAsDataURL(file);
            });
        }
    </script>


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
