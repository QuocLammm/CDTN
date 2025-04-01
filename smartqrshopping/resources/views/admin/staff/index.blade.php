@extends('layouts.supper_page')
@section('title' ,'Nhân viên')
@section('content')
    <div class="main-container">
        <h1>Danh sách nhân viên</h1>
        <div class="top-bar">
            <div class="top-bar-content">
                <a href="{{ route('staff.create') }}" class="add-customer-btn">Thêm mới</a>
            </div>
        </div>

        <div class="table-container">
            <table id="productsTable" class="table table-striped">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên nhân viên</th>
                    <th class="avt-border">Hình ảnh</th>
                    <th>Email</th>
                    <th>Thao tác</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $key => $user)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $user->FullName }}</td>
                        <td>
                            <img src="/images/staff/{{ $user->avt }}" alt="Product Image" style="width: 100px; height: 100px;">
                        </td>
                        <td>{{ $user->Email}}</td>
                        <td>
                            <form action="{{ route('staff.edit', $user->UserID) }}" style="display:inline;">
                                <button type="submit" class="edit-button"><i class="fas fa-edit"></i></button>
                            </form>
                            <form action="{{ route('staff.destroy', $user->UserID) }}" method="POST" style="display:inline;" id="deleteForm{{ $user->UserID }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="delete-button" onclick="showDeleteModal(event, 'deleteForm{{ $user->UserID }}')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('reserved_js')
    <script>
        $(document).ready(function() {
            $('#productsTable').DataTable({
                pageLength: 4,
                lengthMenu: [4, 10, 25, 50, 100]
            });
        });
    </script>
@endsection
