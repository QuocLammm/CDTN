@extends('layouts.supper_page')
@section('title', 'Chỉnh sửa chi tiết sản phẩm')
@section('reserved_css')
    <link rel="stylesheet" href="{{ asset('css/staff/create.css') }}">
@endsection
@section('content')
    <div class="container">
        <h1>Chỉnh sửa chi tiết sản phẩm</h1>
        <form action="{{ route('products.update', $product->ProductID) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Tên sản phẩm</label>
                <input type="text" class="form-control" id="name" name="ProductName" value="{{ old('ProductName', $product->ProductName) }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Mô tả sản phẩm</label>
                <textarea class="form-control" id="description" name="Description" rows="3" required>{{ old('Description', $product->Description) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Giá sản phẩm</label>
                <input type="number" class="form-control" id="price" name="Price" value="{{ old('Price', $product->Price) }}" required>
            </div>

            <h5>Chọn màu sắc:</h5>
            @foreach($productDetails as $productDetail)
                <div class="mb-3">
                    <label for="sizes" class="form-label">Kích cỡ</label>
                    <input type="number" class="form-control" id="sizes" name="Sizes" value="{{ old('Sizes'== $productDetail->Sizes) }}" required>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="Color" id="color{{ $productDetail->ProductDetailID }}" value="{{ $productDetail->Color }}" {{ old('Color') == $productDetail->Color ? 'checked' : '' }}>
                    <label class="form-check-label" for="color{{ $productDetail->ProductDetailID }}">
                        {{ $productDetail->Color }} - Giá: {{ number_format($productDetail->Price) }} VNĐ (Số lượng: {{ $productDetail->Quantities }})
                    </label>
                </div>
            @endforeach

            <div class="mb-3">
                <label for="quantity" class="form-label">Số lượng</label>
                <input type="number" class="form-control" id="quantity" name="Quantities" value="{{ old('Quantities') }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
        </form>
    </div>
@endsection

