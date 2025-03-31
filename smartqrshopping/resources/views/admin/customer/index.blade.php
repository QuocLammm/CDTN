@extends('layouts.supper_page')
@section('title','Khách hàng')
@section('content')
        <div class="main-container">
            <h1>Danh sách khách hàng</h1>
            <div class="top-bar">
                <div class="top-bar-content">
                    <a href="{{ route('customer.create') }}" class="add-customer-btn">Thêm mới</a>
                </div>
                <div class="search-container">
                    <form action="{{ route('customer.index') }}" method="GET">
                        <div style="display: flex; align-items: center;">
                            <input type="text" name="search" placeholder="Nhập khách hàng cần tìm" value="{{ request()->query('search') }}">
                            @if($search)
                                <a
                                    href="{{ route('customer.index') }}"
                                    id="clearButton"
                                    style="text-decoration: none; color: #D5D5D5; font-size: 18px; cursor: pointer;">
                                    ✖
                                </a>
                            @endif
                            <button type="submit">Tìm kiếm</button>
                        </div>
                    </form>
                </div>
            </div>
             <!--Hiển thị thông báo tìm kiếm-->
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
                                <img src="{{ asset('/images/customers/' . $customer->avt) }}" alt="{{ $customer->FullName }}" style="width: 100px; height: auto;">
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
@endsection

