@extends('layouts.app')

@section('content')
    <div class="container">
        <br>
        <h3>Chỉnh sửa sản phẩm</h3>

        <form action="{{ route('show-product.update', $product->ProductID) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                {{--Left--}}
                <div class="col-md-8">
                    <x-form.input name="ProductName" label="Tên sản phẩm"
                        type="text" :value="old('ProductName', $product->ProductName)" placeholder="Nhập tên sản phẩm" />

                    <div class="row">
                        <div class="col-md-6">
                            <x-form.select name="CategoryID" label="Loại sản phẩm" :options="$categories" :selected="$product->CategoryID" />
                        </div>
                        <div class="col-md-6">
                            <x-form.select name="SupplierID" label="Nhà cung cấp" :options="$suppliers" :selected="$product->SupplierID" />
                        </div>
                    </div>

                    <x-form.input
                        name="Price"
                        label="Giá"
                        type="number"
                        :value="old('Price', $product->Price)"
                        placeholder="Nhập giá sản phẩm" />
                    <x-form.textarea
                        name="Description"
                        label="Mô tả"
                        placeholder="Nhập mô tả"
                        rows="4">{{ old('Description', $product->Description) }}</x-form.textarea>
                    {{-- Size --}}
                    <x-form.input
                        name="ProductDetail[Size]"
                        label="Size"
                        type="text"
                        :value="old('ProductDetail.Size', $product->productDetail->Size ?? '')"
                        placeholder="Nhập size" />

                    {{-- Color --}}
                    <x-form.input
                        name="ProductDetail[Color]"
                        label="Màu sắc"
                        type="text"
                        :value="old('ProductDetail.Color', $product->productDetail->Color ?? '')"
                        placeholder="Nhập màu sắc" />

                    {{-- Quantity --}}
                    <x-form.input
                        name="ProductDetail[Quantity]"
                        label="Số lượng"
                        type="number"
                        :value="old('ProductDetail.Quantity', $product->productDetail->Quantity ?? '')"
                        placeholder="Nhập số lượng" />
                    <button type="submit" class="btn btn-success">Cập nhật sản phẩm</button>
                    <a href="{{ route('show-product.index') }}" class="btn btn-secondary">Quay lại</a>
                </div>

                {{-- Right --}}
                <div class="col-md-4">
                    <x-form.input name="Image" label="Hình ảnh mới" type="file" />

                    @if ($product->Image)
                        <div class="mt-3">
                            <label class="form-label">Hình ảnh hiện tại:</label><br>
                            <img src="{{ asset($product->Image) }}" alt="Ảnh hiện tại" class="img-thumbnail" width="100%">
                        </div>
                    @endif
                </div>
            </div>
        </form>
    </div>
@endsection
