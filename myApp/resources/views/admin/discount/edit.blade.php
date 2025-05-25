@extends('layouts.app')
@php
    $breadcrumbItems = [
        ['label' => 'Mã giảm giá', 'url' => route('show-discount.index')],
        ['label' => 'Cập nhật mã giảm giá']
    ];
@endphp
@section('content')
    @include('layouts.header')
    <div class="container">
        <br>
        <h3>Cập nhật mã giảm giá</h3>
        <form action="{{ route('show-discount.update', $discounts->discount_id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Các trường discount -->
            <div class="mb-3">
                <label for="discount_code" class="form-label">Mã giảm giá</label>
                <input type="text" class="form-control" id="discount_code" name="discount_code"
                       value="{{ old('discount_code', $discounts->discount_code) }}">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Mô tả</label>
                <textarea class="form-control" id="description" name="description">{{ old('description', $discounts->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="discount_amount" class="form-label">Phần trăm giảm</label>
                <input type="number" class="form-control" id="discount_amount" name="discount_amount"
                       value="{{ old('discount_amount', $discounts->discount_amount) }}">
            </div>

            <!-- Danh sách các discount_target -->
            <h5 class="mt-4">Danh sách áp dụng (Discount Targets)</h5>
            <div id="targets-wrapper">
                @foreach($discounts->targets as $index => $target)
                    <div class="target-row row mb-2">
                        <div class="col-md-4">
                            <select name="targets[{{ $index }}][target_type]" class="form-select target-type">
                                <option value="product" {{ $target->target_type === 'product' ? 'selected' : '' }}>Sản phẩm</option>
                                <option value="category" {{ $target->target_type === 'category' ? 'selected' : '' }}>Danh mục</option>
                                <option value="global" {{ $target->target_type === 'global' ? 'selected' : '' }}>Toàn bộ</option>
                            </select>
                        </div>
                        <div class="col-md-4 target-id-wrapper">
                            <select name="targets[{{ $index }}][target_id]" class="form-select">
                                @if($target->target_type === 'product')
                                    @foreach($products as $product)
                                        <option value="{{ $product->product_id }}"
                                            {{ $product->product_id == $target->target_id ? 'selected' : '' }}>
                                            {{ $product->product_name }}
                                        </option>
                                    @endforeach
                                @elseif($target->target_type === 'category')
                                    @foreach($categories as $category)
                                        <option value="{{ $category->category_id }}"
                                            {{ $category->category_id == $target->target_id ? 'selected' : '' }}>
                                            {{ $category->category_name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>

                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-danger remove-target">X</button>
                        </div>
                    </div>
                @endforeach
            </div>

            <button type="button" id="add-target" class="btn btn-outline-primary btn-sm mt-2">+ Thêm dòng</button>

            <div class="mt-4">
                <button type="submit" class="btn btn-success">Cập nhật mã giảm giá</button>
                <a href="{{ route('show-discount.index') }}" class="btn btn-secondary">Quay lại</a>
            </div>
        </form>
    </div>
@endsection
@push('js')
    <script>
        const products = @json($products);
        const categories = @json($categories);

        function renderTargetIdSelect(index, type) {
            let options = '<option value="">-- Chọn --</option>';
            if (type === 'product') {
                products.forEach(p => {
                    options += `<option value="${p.product_id}">${p.product_name}</option>`;
                });
            } else if (type === 'category') {
                categories.forEach(c => {
                    options += `<option value="${c.categoty_id}">${c.category_name}</option>`;
                });
            }
            return `<select name="targets[${index}][target_id]" class="form-select">${options}</select>`;
        }

        function toggleAddButton() {
            const anyGlobal = [...document.querySelectorAll('.target-type')].some(select => select.value === 'global');
            document.getElementById('add-target').style.display = anyGlobal ? 'none' : 'inline-block';
        }

        function handleTargetTypeChange(select) {
            const row = select.closest('.target-row');
            const type = select.value;
            const index = [...document.querySelectorAll('.target-type')].indexOf(select);
            const idWrapper = row.querySelector('.target-id-wrapper');

            if (type === 'global') {
                idWrapper.innerHTML = '';
                // Xóa các dòng khác trừ dòng hiện tại
                document.querySelectorAll('.target-row').forEach((r, i) => {
                    if (r !== row) r.remove();
                });
            } else {
                idWrapper.innerHTML = renderTargetIdSelect(index, type);
            }

            toggleAddButton();
        }

        document.getElementById('add-target').addEventListener('click', function () {
            const index = document.querySelectorAll('.target-row').length;
            const wrapper = document.getElementById('targets-wrapper');

            const row = document.createElement('div');
            row.className = 'target-row row mb-2';
            row.innerHTML = `
            <div class="col-md-4">
                <select name="targets[${index}][target_type]" class="form-select target-type">
                    <option value="product">Sản phẩm</option>
                    <option value="category">Danh mục</option>
                    <option value="global">Toàn bộ</option>
                </select>
            </div>
            <div class="col-md-4 target-id-wrapper">
                ${renderTargetIdSelect(index, 'product')}
            </div>
            <div class="col-md-4">
                <button type="button" class="btn btn-danger remove-target">X</button>
            </div>
        `;
            wrapper.appendChild(row);
            toggleAddButton();
        });

        document.addEventListener('change', function (e) {
            if (e.target.classList.contains('target-type')) {
                handleTargetTypeChange(e.target);
            }
        });

        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-target')) {
                e.target.closest('.target-row').remove();
                toggleAddButton();
            }
        });

        // Init on page load
        document.querySelectorAll('.target-type').forEach(select => {
            handleTargetTypeChange(select);
        });
    </script>
@endpush
