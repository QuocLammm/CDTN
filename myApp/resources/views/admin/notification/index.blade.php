@extends('layouts.app')

@section('content')
    @include('layouts.header', ['title' => 'Lịch sử thông báo'])
    <div class="container mt-4">
        @if($notifications->isEmpty())
            <p>Không có thông báo nào.</p>
        @else
            <ul class="list-group">
                @foreach($notifications as $notification)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>{{ $notification->user->full_name ?? 'Hệ thống' }}</strong>:
                            {{ $notification->content }}
                            <br>
                            <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                        </div>
                        @if($notification->status == 0)
                            <span class="badge bg-warning text-dark">Chưa đọc</span>
                        @else
                            <span class="badge bg-success">Đã đọc</span>
                        @endif
                    </li>
                @endforeach
            </ul>

            <div class="mt-3 d-flex justify-content-center">
                {{ $notifications->links('vendor.pagination.bootstrap-4') }} {{-- Phân trang với Bootstrap 4 --}}
            </div>
        @endif
    </div>
@endsection
