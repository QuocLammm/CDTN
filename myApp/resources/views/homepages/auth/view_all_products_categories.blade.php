@extends('homepages.master_page')
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/homepage/view_all_product.css') }}">
@endpush
@section('header')
    @include('homepages.auth.header')
@endsection
@section('content')
    <div class="main-content">
        <h2>Danh sách sản phẩm trong "{{ $category->category_name }}"</h2>
        {{-- Danh sách sản phẩm --}}
        <div class="features" id="product-list">
            @foreach ($products as $product)
                <a href="{{ route('product.show', $product->product_id) }}" class="card-link">
                    <div class="card">
                        <img src="{{ $product->images()->first()->image_path }}" alt="{{ $product->product_name }}" class="product-image"
                             style="width: 100%; height: 300px; object-fit: cover;">
                        <h4 class="product-name" style="text-align: center;">{{ $product->product_name }}</h4>
                        <div class="product-price d-flex align-items-center justify-content-center gap-2">
                            @if ($product->is_sale && $product->sale_price < $product->price)
                                <span class="current-price text-danger fw-bold">{{ number_format($product->sale_price) }} đ</span>
                                <span class="original-price text-muted" style="text-decoration: line-through;">{{ number_format($product->price) }} đ</span>
                                <span class="badge bg-danger" style="font-size: 0.75rem;">
                                    -{{ round((($product->price - $product->sale_price) / $product->price) * 100) }}%
                                </span>
                            @else
                                <span class="current-price">{{ number_format($product->price) }} đ</span>
                            @endif
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        {{-- Phân trang --}}
        <div style="text-align: center; margin-top: 40px;">
            <button id="load-more" data-page="1">Xem thêm</button>
            <p id="no-more-products" style="display:none;">Đã hiển thị hết sản phẩm.</p>
        </div>
    </div>
@endsection
@push('js')
    <script>
        document.getElementById('load-more').addEventListener('click', function () {
            const button = this;
            let page = parseInt(button.getAttribute('data-page')) + 1;

            fetch(`/load-more-products?page=${page}`)
                .then(response => response.json())
                .then(data => {
                    if (data.end) {
                        button.style.display = 'none';
                        document.getElementById('no-more-products').style.display = 'block';
                    } else {
                        document.getElementById('product-list').insertAdjacentHTML('beforeend', data.html);
                        button.setAttribute('data-page', page);
                    }
                })
                .catch(error => console.error('Load more error:', error));
        });
    </script>
@endpush
@section('footer')
    <div class="site-footer">
        @include('homepages.auth.footer_no_sale')
    </div>
@endsection
