@extends('homepages.master_page')
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/homepage/cart_item.css') }}">
@endpush
@section('header')
    <div class="site-header">
        @include('homepages.auth.header')
    </div>
@endsection
@section('content')
    <div class="main-content">
        <h2 style="text-align: center">Danh sách yêu thích của bạn</h2>
        @if($wishList->isEmpty())
            <p style="text-align: center">Danh sách yêu thích của bạn hiện tại trống.</p>
        @else
            @foreach($wishList as $item)
                <div class="cart-card d-flex gap-3">
                    <form action="{{ route('wishlist.remove', $item->wishlist_id) }}" method="POST"
                          class="delete-form" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi danh sách yêu thích?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn-xoa-icon" type="submit">&times;</button>
                    </form>

                    <div class="cart-card-left col-4">
                        <img src="{{ $item->product->images->first()->image_path ?? 'default.jpg' }}"
                             alt="{{ $item->product->product_name }}"
                             class="img-fluid rounded">
                    </div>
                    <div class="cart-card-right col-8 d-flex flex-column justify-content-between">
                        <div class="d-flex justify-content-between align-items-start">
                            <h5 class="mb-2 cart-product-name">{{ Str::limit($item->product->product_name, 30, '...') }}</h5>
                        </div>
                        <p class="cart-line-total mb-2 text-end">
                            Giá: <strong>{{ number_format($item->product->price, 0, ',', '.') }}₫</strong>
                        </p>
                        <!-- Thêm vào giỏ hàng -->
                        <form action="{{ route('cart.add', $item->product->product_id) }}" method="POST" class="mt-auto">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Thêm vào giỏ hàng</button>
                        </form>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
@push('js')

@endpush
@section('footer')
    <div class="site-footer">
        @include('homepages.auth.footer_no_sale')
    </div>
@endsection
