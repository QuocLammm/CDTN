<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khách hàng</title>
    <link rel="stylesheet" href="/css/login/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Sharp" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    @include('layouts.sidebar')
    <main>
        <div class="main-container">
            <h1>Danh sách khách hàng</h1>
            <div class="top-bar">
                <div class="top-bar-content">
                    <a href="{{ route('customer.create') }}" class="add-customer-btn">Thêm mới</a>
                    <div class="search-container">
                        <form action="{{ route('customer.index') }}" method="GET">
                            <div style="position: relative;">
                                <input type="text" name="search" placeholder="Nhập loại sản phẩm cần tìm" value="{{ request()->query('search') }}">
                                @if($search)
                                    <a
                                        href="{{ route('customer.index') }}"
                                        id="clearButton"
                                        style="position: absolute; right: 20%; top: 50%; transform: translateY(-50%); text-decoration: none; color: #D5D5D5; font-size: 18px; cursor: pointer;">
                                        ✖
                                    </a>
                                @endif
                            </div>
                            <button type="submit">Tìm kiếm</button>
                        </form>
                    </div>
                </div>
            </div>
            {{-- Hiển thị thông báo tìm kiếm --}}
            @if ($searchPerformed && $search !== '')
                @if ($totalResults > 0)
                    <div id="search-notification" class="alert-success" style="text-align: center; color: green; margin-top: 10px;">
                        Tìm thấy {{ $totalResults }} khách hàng có tên chứa từ khóa: "{{ $search }}"
                    </div>
                @else
                    <div id="search-notification" class="alert-danger" style="text-align: center; color: red; margin-top: 10px;">
                        Không tìm thấy khách hàng có tên chứa từ khóa: "{{ $search }}"
                    </div>
                @endif
            @endif

            <div class="table-container">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Họ và tên</th>
                        <th class="avt-border">Hình ảnh</th>
                        <th>Email</th>
                        <th>Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($customers as $index => $customer)
                        <tr>
                            <td>{{ $customers->currentPage() * $customers->perPage() + $index + 1 - $customers->perPage() }}</td>
                            <td>{{ $customer->FullName }}</td>
                            <td>
                                <img src="{{ asset('/images/staff/' . $customer->avt) }}" alt="{{ $customer->FullName }}" style="width: 100px; height: auto;">
                            </td>
                            <td>{{ $customer->Email }}</td>
                            <td>
                                <form action="{{ route('customer.edit', $customer->UserID) }}" style="display:inline;">
                                    <button type="submit" class="edit-button"><i class="fas fa-edit"></i></button>
                                </form>
                                <form action="{{ route('customer.destroy', $customer->UserID) }}" method="POST" style="display:inline;" id="deleteForm{{ $customer->UserID }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="delete-button" onclick="showDeleteModal(event, 'deleteForm{{ $customer->UserID }}')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pagination">
                {{ $customers->links('pagination::bootstrap-4') }}
            </div>

        </div>
    </main>
    @include('layouts.right_section')
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function showDeleteModal(event, formId) {
        event.preventDefault();  // Prevent the default form submission
        const form = document.getElementById(formId);

        Swal.fire({
            title: 'Bạn có chắc chắn muốn xóa?',
            text: "Hành động này không thể hoàn tác!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Xóa',
            cancelButtonText: 'Hủy',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the form if the user confirms the deletion
                form.submit();
            }
        });
    }
</script>
<script src="/js/login/order.js"></script>
<script src="/js/login/index.js"></script>
</body>
</html>
