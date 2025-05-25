@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.header', ['title' => 'Liên hệ'])

    <div class="container-fluid py-4">
        <div class="card">

            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Danh sách liên hệ</h5>
                <a href="{{ route('contacts.export') }}" class="btn btn-success btn-sm">
                    Xuất Excel
                </a>
            </div>

            <div class="card-body px-3 pt-3 pb-2">
                <table id="contactsTable" class="display" style="width:100%">
                    <thead>
                    <tr>
                        <th>Họ tên</th>
                        <th>Email</th>
                        <th>SĐT</th>
                        <th>Tiêu đề</th>
                        <th>Trạng thái</th>
                        <th>Ngày gửi</th>
                        <td>Thao tác</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($contacts as $contact)
                        <tr>
                            <td>{{ $contact->full_name }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->phone }}</td>
                            <td>{{ $contact->subject }}</td>
                            <td>
                                @if ($contact->status == 'unread')
                                    <span class="badge bg-danger">Chưa đọc</span>
                                @else
                                    <span class="badge bg-success">Đã đọc</span>
                                @endif
                            </td>
                            <td>{{ $contact->sent_date }}</td>
                            <td>
                                <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-sm btn-primary">Xem</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $('#contactsTable').DataTable({
            "pageLength": 5,
            "language": {
                "search": "Tìm kiếm:",
                "lengthMenu": "Hiển thị _MENU_ bản ghi",
                "info": "Hiển thị _START_ đến _END_ của _TOTAL_ bản ghi",
                "paginate": {
                    "first": "Đầu",
                    "last": "Cuối",
                    "next": "Tiếp",
                    "previous": "Trước"
                },
                "zeroRecords": "Không tìm thấy kết quả",
                "infoEmpty": "Không có bản ghi nào",
                "infoFiltered": "(lọc từ _MAX_ bản ghi)"
            }
        });

    </script>
@endpush
