@extends('layouts.app')
@section('content')
    <div class="container">
        <br>
        <h3>Chỉnh sửa danh mục sản phẩm</h3>
        <form action="{{ route('show-category.update', $categories->category_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                {{-- Left --}}
                <div class="col-md-12">
                    <x-form.input name="category_name" label="Tên danh mục sản phẩm" type="text" :value="old('category_name', $categories->category_name)" placeholder="Nhập tên loại sản phẩm" />
                    <x-form.textarea
                        name="description"
                        label="Mô tả"
                        placeholder="Nhập mô tả"
                        rows="4">{{ old('description', $categories->description) }}</x-form.textarea>

                    <h4 class="mt-4">Sản phẩm trong danh mục: "{{ $categories->category_name }}"</h4>
                    @if($products->isEmpty())
                        <p class="text-muted">Chưa có sản phẩm trong danh mục này.</p>
                    @else
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Mô tả</th>
                            <th>Sửa thông tin</th>
                            <th>Ảnh</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td><input type="text" name="products[{{ $product->product_id }}][product_name]" value="{{ old('products.' . $product->product_id . '.product_name', $product->product_name) }}" class="form-control" disabled></td>
                                <td><input type="text" name="products[{{ $product->product_id }}][price]" value="{{ old('products.' . $product->product_id . '.price', $product->price) }}" class="form-control" disabled></td>
                                <td><input type="text" name="products[{{ $product->product_id }}][description]" value="{{ old('products.' . $product->product_id . '.description', $product->description) }}" class="form-control" disabled></td>
                                <td>
                                    @foreach($product->productDetails as $detail)
                                        <div>
                                            {{-- Dropdown màu sắc --}}
                                            <select name="products[{{ $product->product_id }}][details][{{ $detail->id }}][color]" class="form-control color-picker"  disabled data-product-id="{{ $product->product_id }}" data-detail-id="{{ $detail->id }}">
                                                <option value="red" style="background-color: red;" {{ old('products.' . $product->product_id . '.details.' . $detail->id . '.color', $detail->color) == 'red' ? 'selected' : '' }}></option>
                                                <option value="green" style="background-color: green;" {{ old('products.' . $product->product_id . '.details.' . $detail->id . '.color', $detail->color) == 'green' ? 'selected' : '' }}></option>
                                                <option value="blue" style="background-color: blue;" {{ old('products.' . $product->product_id . '.details.' . $detail->id . '.color', $detail->color) == 'blue' ? 'selected' : '' }}></option>
                                                <option value="yellow" style="background-color: yellow;" {{ old('products.' . $product->product_id . '.details.' . $detail->id . '.color', $detail->color) == 'yellow' ? 'selected' : '' }}></option>
                                                <option value="black" style="background-color: black;" {{ old('products.' . $product->product_id . '.details.' . $detail->id . '.color', $detail->color) == 'black' ? 'selected' : '' }}></option>
                                                <option value="white" style="background-color: white;" {{ old('products.' . $product->product_id . '.details.' . $detail->id . '.color', $detail->color) == 'white' ? 'selected' : '' }}></option>
                                            </select>

                                            {{-- Dropdown kích thước --}}
                                            <select name="products[{{ $product->product_id }}][details][{{ $detail->id }}][size]" class="form-control" disabled>
                                                @for ($size = 32; $size <= 45; $size++)
                                                    <option value="{{ $size }}" {{ old('products.' . $product->product_id . '.details.' . $detail->id . '.size', $detail->size) == $size ? 'selected' : '' }}>{{ $size }}</option>
                                                @endfor
                                            </select>

                                            {{-- Số lượng --}}
                                            <input type="number" name="products[{{ $product->product_id }}][details][{{ $detail->id }}][quantity]" value="{{ old('products.' . $product->product_id . '.details.' . $detail->id . '.quantity', $detail->quantity) }}" class="form-control" disabled placeholder="Số lượng">
                                        </div>
                                    @endforeach
                                </td>
                                <td>
                                    <input type="file" name="products[{{ $product->product_id }}][images][]" multiple disabled class="form-control">
                                    @if($product->images->count())
                                        <div class="d-flex flex-wrap mt-2" style="gap: 8px;">
                                            @foreach($product->images as $image)
                                                <div class="position-relative" style="width: 95px; height: 95px;">
                                                    <img src="{{ asset($image->image_path) }}"
                                                         class="rounded"
                                                         style="width: 100%; height: 100%; object-fit: cover;">

                                                    <button type="button"
                                                            class="btn-close btn-sm position-absolute top-0 end-0 m-1"
                                                            style="z-index: 10; background-color: red; border: 1px solid red; display: none"
                                                            onclick="removeImage({{ $image->id }}, this)">
                                                    </button>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @endif
                    <button type="submit" class="btn btn-success">Cập nhật loại sản phẩm</button>
                    <a href="{{ route('show-category.index') }}" class="btn btn-secondary">Quay lại</a>

                </div>
            </div>
        </form>

    </div>

@endsection
@push('js')
    {{-- JavaScript --}}
    <script>
        document.querySelectorAll('.color-picker').forEach(function(selectElement) {
            selectElement.addEventListener('change', function() {
                var selectedColor = this.value;
                var productId = this.getAttribute('data-product-id');
                var detailId = this.getAttribute('data-detail-id');
                var colorInput = document.querySelector(`[name="products[${productId}][details][${detailId}][color]"]`);

                // Cập nhật màu nền mà không bị ảnh hưởng bởi hover
                colorInput.style.backgroundColor = selectedColor;
                colorInput.style.transition = "none"; // Tắt transition khi thay đổi màu
            });

            // Cài đặt màu nền ban đầu khi trang được load
            var initialColor = selectElement.value;
            var productId = selectElement.getAttribute('data-product-id');
            var detailId = selectElement.getAttribute('data-detail-id');
            var colorInput = document.querySelector(`[name="products[${productId}][details][${detailId}][color]"]`);

            // Đảm bảo màu nền khi bắt đầu
            colorInput.style.backgroundColor = initialColor;
            colorInput.style.transition = "none"; // Tắt transition khi load ban đầu
        });

    </script>

@endpush
