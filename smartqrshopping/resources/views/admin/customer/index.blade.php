@extends('layouts.admin')
@section('title', 'Khách Hàng')
@push('styles')
    <style>
        /* Khung bọc cho bảng */
        .container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 20px; /* Thêm margin để tránh chồng lấp */
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th, .table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        .table thead {
            background-color: #744DAA;
            color: white;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            color: white;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .pagination {
            margin-top: 15px;
            display: flex;
            justify-content: center;
        }

        .pagination a {
            margin: 0 5px;
            padding: 8px 12px;
            border: 1px solid #007bff;
            color: #007bff;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .pagination a:hover {
            background-color: #007bff;
            color: white;
        }
    </style>
@endpush

@section('content')
    <div class="container customer-page">
         <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Danh sách khách hàng</h2>
            <a href="{{ route('customer.create') }}" class="btn btn-primary">Thêm mới</a>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên</th>
{{--                        <th>AVT</th>--}}
                        <th>Ngày sinh</th>
                        <th>Email</th>
                        <th>Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $index => $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->FullName }}</td>
{{--                            <td>--}}
{{--                                <img src="{{ asset('storage/' . $user->avatar) }}" width="50" height="50" class="rounded-circle">--}}
{{--                            </td>--}}
                            <td>{{ $user->Date_of_Birth }}</td>
                            <td>{{ $user->Email }}</td>
                            <td>
                                <a href="{{ route('customer.edit', $user->UserID) }}" class="btn btn-warning btn-sm">Sửa</a>
                                <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $user->UserID }}">Xóa</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <!-- Phân trang -->
                <div class="d-flex justify-content-center">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function () {
            $(".delete-btn").click(function () {
                let userID = $(this).data("id");

                Swal.fire({
                    title: "Bạn có chắc chắn muốn xóa?",
                    text: "Hành động này không thể hoàn tác!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Xóa ngay!",
                    cancelButtonText: "Hủy",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/customer/${userID}`, // Đúng đường dẫn
                            type: "DELETE",
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function (response) {
                                Swal.fire("Đã xóa!", "Khách hàng đã bị xóa.", "success").then(() => {
                                    location.reload();
                                });
                            },
                            error: function () {
                                Swal.fire("Lỗi!", "Đã xảy ra lỗi khi xóa.", "error");
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush



