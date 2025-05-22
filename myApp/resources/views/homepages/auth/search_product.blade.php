@extends('homepages.master_page')
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/homepage/search_product.css') }}">
@endpush
@section('header')
    <div class="site-header">
        @include('homepages.guest.header')
    </div>
@endsection
@section('content')
    <div class="main-content">
        <div class="search-results-container">
            <h2>Kết quả tìm kiếm cho: {{ $keyword }}</h2>

            @if ($products->isEmpty())
                <p>Không tìm thấy sản phẩm nào phù hợp.</p>
            @else
                <div class="{{ $products->count() < 5 ? 'features-flex' : 'features' }}">
                    @foreach ($products as $product)
                        <a href="{{ route('product.show', $product->product_id) }}" class="card-link">
                            <div class="card {{ $products->count() < 5 ? 'card-flex' : '' }}">
                                <img src="{{ $product->image }}" alt="{{ $product->product_name }}" class="product-image"
                                     style="width: 100%; height: 300px; object-fit: cover;">
                                <h4 style="text-align: center;">{{ $product->product_name }}</h4>
                                <p style="text-align: center;">{{ number_format($product->price, 0, ',', '.') }} đ</p>
                            </div>
                        </a>
                    @endforeach
                </div>

{{--                <div style="margin-top: 30px; text-align: center;">--}}
{{--                    {{ $products->links() }}--}}
{{--                </div>--}}
            @endif
        </div>
    </div>
@endsection

@section('footer')
    <div class="site-footer">
        @include('homepages.auth.footer')
    </div>
@endsection
