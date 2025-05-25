@extends('layouts.app')
@php
    $breadcrumbItems = [
        ['label' => 'Mã giảm giá', 'url' => route('show-discount.index')],
        ['label' => 'Thêm mới mã giảm giá']
    ];
@endphp
@section('content')
    @include('layouts.header', ['breadcrumbItems' => $breadcrumbItems])

    <div class="container mt-4">
        <h3>Thêm mới mã giảm giá</h3>
        <form action="{{ route('show-discount.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="discount_code" class="form-label">Mã giảm giá</label>
                <input type="text" class="form-control" id="discount_code" name="discount_code" required placeholder="Nhập mã giảm giá">
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="discount_amount" class="form-label">% Giảm</label>
                    <input type="number" step="0.01" min="0" class="form-control" id="discount_amount" name="discount_amount" required placeholder="Ví dụ: 10.00">
                </div>

                <div class="col-md-4">
                    <label for="start_date" class="form-label">Ngày bắt đầu</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" required>
                </div>

                <div class="col-md-4">
                    <label for="end_date" class="form-label">Ngày kết thúc</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Mô tả</label>
                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Nhập mô tả"></textarea>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="status" name="status" checked>
                <label class="form-check-label" for="status">Kích hoạt</label>
            </div>

            <button type="submit" class="btn btn-primary">Thêm mã giảm giá</button>
            <a href="{{ route('show-discount.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>

    </div>
@endsection
