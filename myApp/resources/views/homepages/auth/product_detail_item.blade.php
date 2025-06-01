@php use Illuminate\Support\Str; @endphp
@extends('homepages.master_page')
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/homepage/product_item.css') }}">
@endpush
@section('header')
    @if(Auth::check())
        @include('homepages.auth.header')
    @else
        @include('homepages.guest.header')
    @endif
@endsection
@section('content')
    <div class="main-content">
        <div class="product-detail-container">
            <div class="product-image-gallery">
                <!-- Ảnh lớn -->
                <div style="width: 400px; height: 400px; background-color: #f8f8f8; border: 1px solid #ccc; border-radius: 6px; display: flex; align-items: center; justify-content: center;">
                    <img id="mainProductImage" src="{{ $product->images()->first()->image_path }}" alt="{{ $product->product_name }}"
                         style="max-width: 100%; max-height: 100%; object-fit: contain;">
                </div>

{{--                <img id="mainProductImage" src="{{ $product->images()->first()->image_path }}" alt="{{ $product->product_name }}" class="product-detail-image" style="width: 100%; max-height: 400px; object-fit: contain; border-radius: 8px;">--}}

                <!-- Danh sách ảnh nhỏ bên dưới -->
                <div class="thumbnail-gallery" style="display: flex; gap: 10px; margin-top: 10px; flex-wrap: wrap;">
                    @foreach ($product->images as $image)
                        <img src="{{ $image->image_path }}" alt="Thumbnail" onclick="changeMainImage('{{ $image->image_path }}')" style="width: 70px; height: 70px; object-fit: cover; border: 2px solid #ccc; border-radius: 6px; cursor: pointer;">
                    @endforeach
                </div>
            </div>

            <div class="product-detail-info">
                <h2>{{ $product->product_name }}</h2>

                {{-- Đánh giá trung bình --}}
                @php
                    $averageRating = $product->reviews()->avg('rating');
                    $reviewCount = $product->reviews()->count();
                @endphp
                <div style="margin: 5px 0;">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= round($averageRating))
                            <span style="color: gold; font-size: 18px;">&#9733;</span>
                        @else
                            <span style="color: #ccc; font-size: 18px;">&#9733;</span>
                        @endif
                    @endfor
                        <span style="color: #666; margin-left: 5px;">
                            ({{ number_format($averageRating, 1) }}/5 -
                            {{ $reviewCount }} đánh giá)
                        </span>
                </div>

                {{-- Giá --}}
                @if ($product->is_sale && $product->sale_price < $product->price)
                    <span class="current-price text-danger fw-bold">{{ number_format($product->sale_price) }}vnđ</span>
                    <span class="original-price text-muted" style="text-decoration: line-through;">{{ number_format($product->price) }}vnđ</span>
                    <span class="badge bg-danger" style="font-size: 0.75rem;">
                                    -{{ round((($product->price - $product->sale_price) / $product->price) * 100) }}%
                                </span>
                @else
                    <span class="current-price">{{ number_format($product->price) }}vnđ</span>
                @endif

                {{-- Hai nút căn đều nhau --}}
                <div class="product-actions" style="display: flex; flex-direction: column; gap: 20px;">
                    <!-- Thêm vào giỏ -->
                    <form action="{{ route('cart.add', $product->product_id) }}" method="POST" style="width: 100%;">
                        @csrf

                        <!-- Màu sắc -->
                        <div style="margin-bottom: 15px;">
                            <strong>Màu sắc:</strong>
                            <div style="display: flex; justify-content: center; gap: 10px;">
                                @php
                                    $colors = $product->productDetails->pluck('color')->unique()->filter()->toArray();
                                    function colorToCss($colorName) {
                                        $colorName = mb_strtolower(trim($colorName), 'UTF-8');
                                        return match($colorName) {
                                            'trắng' => 'white',
                                            'đen' => 'black',
                                            'kem' => '#f5f5dc',
                                            'đỏ' => 'red',
                                            'vàng' => 'yellow',
                                            'hồng' => 'pink',
                                            'nâu' => 'brown',
                                            'xanh lá' =>'green',
                                            'không màu', 'không xác định' => 'transparent',
                                            default => 'transparent',
                                        };
                                    }
                                @endphp
                                @foreach ($colors as $color)
                                    @php $cssColor = colorToCss($color); @endphp
                                    <input type="radio" id="color-{{ $color }}" name="color" value="{{ $color }}" style="display:none;" required>
                                    <label for="color-{{ $color }}"
                                           style="cursor: pointer;
                           width: 28px;
                           height: 28px;
                           border-radius: 50%;
                           background-color: {{ $cssColor }};
                           border: 2px solid #ccc;
                           display: inline-block;
                           transition: border-color 0.3s;">
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Kích thước -->
                        <div style="margin-bottom: 15px;">
                            <strong>Kích thước:</strong>
                            <div style="display: flex; justify-content: center; gap: 10px; margin-top: 5px; flex-wrap: wrap;">
                                @php
                                    $sizes = $product->productDetails->pluck('size')->unique()->filter()->toArray();
                                @endphp
                                @foreach ($sizes as $size)
                                    <input type="radio" id="size-{{ $size }}" name="size" value="{{ $size }}" style="display:none;" required>
                                    <label for="size-{{ $size }}"
                                           style="cursor: pointer;
                           padding: 6px 12px;
                           border: 2px solid #ccc;
                           border-radius: 5px;
                           display: inline-block;
                           user-select: none;
                           transition: border-color 0.3s;">
                                        {{ $size }}
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Nút Mua ngay -->
                        <div style="display: flex; gap: 10px; margin-top: 20px; flex-wrap: nowrap;">
                            <!-- Mua ngay -->
                            <a href="{{ route('buy.now', $product->product_id) }}"
                               class="buy-button"
                               style="flex: 1; text-align: center; min-width: 120px; line-height: 40px;">
                                Mua ngay
                            </a>

                            <!-- Nút thêm vào giỏ -->
                            <button type="submit" class="add-to-cart-button" style="flex: 1; min-width: 120px;">
                                Thêm vào giỏ hàng
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>

        {{-- Thẻ card chứa tab mô tả và bình luận --}}
        <div class="product-detail-tabs card">
            <div class="tab-header">
                <button class="tab-button active" onclick="showTab('description')">Chi tiết sản phẩm</button>
                <button class="tab-button" onclick="showTab('comments')">Bình luận</button>
            </div>
            <div class="tab-content">
                <div id="description" class="tab-pane active">
                    <div>{!! $product->description ?? 'Không có mô tả sản phẩm.' !!}</div>
                </div>
                <!-- Đánh giá-->
                <div id="comments" class="tab-pane">
                    @if ($product->reviews->isEmpty())
                        <p>Chưa có bình luận nào.</p>
                    @else
                        @foreach ($product->reviews as $review)
                            <div class="review-item">
                                <div class="review-header">
                                    <img src="{{ asset($review->user->image ?? 'default-avatar.png') }}" alt="Avatar">
                                    <strong>{{ $review->user->full_name ?? 'Người dùng' }}</strong>
                                </div>

                                <span class="review-date">
            {{ $review->created_at->format('d/m/Y H:i') }}
        </span>

                                <div class="review-stars">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <span class="{{ $i <= $review->rating ? 'active' : 'inactive' }}">&#9733;</span>
                                    @endfor
                                </div>

                                <div class="review-content">
                                    {!! $review->comment !!}
                                </div>
                            </div>
                        @endforeach

                    @endif
                    @auth
                        <form action="{{ route('product.review.store', $product->product_id) }}" method="POST" style="margin-top: 20px;">
                            @csrf
                            <div>
                                <label for="rating">Đánh giá:</label>
                                <select name="rating" id="rating" required>
                                    <option value="">Chọn số sao</option>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}">{{ $i }} sao</option>
                                    @endfor
                                </select>
                            </div>
                            <div style="margin-top: 10px;">

                                <textarea name="comment" id="comment" rows="4" style="width: 100%;"></textarea>
                            </div>
                            <button type="submit" style="margin-top: 10px;">Gửi bình luận</button>
                        </form>
                    @else
                        <p><a href="{{ route('login') }}">Đăng nhập</a> để bình luận sản phẩm.</p>
                    @endauth
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script>
        // Khởi tạo CKEditor nếu chưa có
        if (!CKEDITOR.instances['comment']) {
            CKEDITOR.replace('comment');
        }
    </script>

    <script>
        function showTab(tab) {
            document.querySelectorAll('.tab-pane').forEach(el => el.classList.remove('active'));
            document.querySelectorAll('.tab-button').forEach(el => el.classList.remove('active'));

            document.getElementById(tab).classList.add('active');
            event.target.classList.add('active');
        }
    </script>
    <script>
        function changeMainImage(imageUrl) {
            const mainImg = document.getElementById('mainProductImage');
            if (mainImg) {
                mainImg.src = imageUrl;
            }
        }
    </script>

@endpush
@section('footer')
    <div class="site-footer">
        @include('homepages.auth.footer_no_sale')
    </div>
@endsection

