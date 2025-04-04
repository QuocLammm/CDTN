@extends('layouts.app')
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'User Management'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Sản phẩm</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tên sản phẩm</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Mô tả
                                </th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Hình ảnh</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($product as $products)
                                <tr>
                                    <td>
                                        <div class="d-flex px-3 py-1">
                                            <div>
                                                <img src="{{ asset('img/products/' . $products->Image) }}" class="avatar me-3" alt="{{ $products->ProductName }}">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $products->ProductName }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">{{ number_format($products ->Price) }} VND</p>
                                    </td>
{{--                                    <td class="align-middle text-center text-sm">--}}
{{--                                        <p class="text-sm font-weight-bold mb-0">{{ $product->CreatedAt->format('d/m/Y') }}</p>--}}
{{--                                    </td>--}}
{{--                                    <td class="align-middle text-end">--}}
{{--                                        <div class="d-flex px-3 py-1 justify-content-center align-items-center">--}}
{{--                                            <a href="{{ route('product.edit', $product->id) }}" class="text-sm font-weight-bold mb-0 cursor-pointer text-warning">Edit</a>--}}
{{--                                            <form action="{{ route('product.destroy', $product->id) }}" method="POST" class="d-inline">--}}
{{--                                                @csrf--}}
{{--                                                @method('DELETE')--}}
{{--                                                <button type="submit" class="text-sm font-weight-bold mb-0 ps-2 cursor-pointer text-danger border-0 bg-transparent" onclick="return confirm('Xóa sản phẩm này?')">Delete</button>--}}
{{--                                            </form>--}}
{{--                                        </div>--}}
{{--                                    </td>--}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
