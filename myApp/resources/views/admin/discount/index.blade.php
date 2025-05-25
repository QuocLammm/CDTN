@extends('layouts.app')
@push('css')
    <style>
        .swal2-toast.swal2-success {
            background-color: #28a745 !important;
            color: #fff !important;
        }
    </style>
@endpush
@section('content')
    @include('layouts.header', ['title' => 'Danh sách mã giảm giá'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center pb-0">
                    <div class="d-flex flex-column align-items-start">
                        <h5 class="mb-0">Danh sách mã giảm giá</h5>
                        <a href="{{ route('show-discount.create') }}" class="btn btn-primary">Thêm mã giảm giá</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="supplierTable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Mã giảm giá</th>
                            <th>Mô tả</th>
                            <th>Phần trăm giảm</th>
                            <th class="text-center">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($discounts as $discount)
                            @php
                                $percent = $discount->discount_amount;
                                $formattedPercent = (floor($percent) == $percent) ? number_format($percent, 0) : number_format($percent, 1);
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $discount->discount_code }}</td>
                                <td class="text-truncate" style="max-width: 200px;" title="{{ $discount->description }}">
                                    {{ $discount->description }}
                                </td>
                                <td>{{ $formattedPercent }}%</td>
                                <td class="text-center">
                                    <a href="{{ route('show-discount.edit', $discount->discount_id) }}"
                                       class="btn btn-sm btn-outline-success me-1">Edit</a>
                                    <form action="{{ route('show-discount.destroy', $discount->discount_id) }}"
                                          method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-outline-danger btn-delete">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Không có mã giảm giá nào nào</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <!-- DataTables -->
    <script>
        $(document).ready(function () {
            $('#supplierTable').DataTable({
                pageLength: 5,
                lengthMenu: [5, 10, 25, 50, 100],
                language: {
                    search: "Tìm kiếm:",
                    lengthMenu: "Hiển thị _MENU_ mục",
                    paginate: {
                        first: "Đầu",
                        last: "Cuối",
                        next: "Tiếp",
                        previous: "Trước"
                    },
                    zeroRecords: "Không tìm thấy kết quả",
                    infoEmpty: "Không có dữ liệu",
                    infoFiltered: "(lọc từ _MAX_ mục)"
                }
            });
        });
    </script>
    @if (session('success'))

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: @json(session('success')),
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
            });
        </script>
    @endif
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Xử lý nút Delete
            const deleteButtons = document.querySelectorAll('.btn-delete');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    Swal.fire({
                        title: 'Bạn có chắc chắn muốn xoá?',
                        text: "Hành động này không thể hoàn tác!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Xoá',
                        cancelButtonText: 'Huỷ'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Submit form gần nhất (form bao quanh nút Delete)
                            this.closest('form').submit();
                        }
                    });
                });
            });
        });
    </script>
@endpush
