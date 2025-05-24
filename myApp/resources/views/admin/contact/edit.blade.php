@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@php
    $breadcrumbItems = [
        ['label' => 'Liên hệ', 'url' => route('admin.contact.index')],
        ['label' => 'Chi tiết liên hệ']
    ];
@endphp
@push('css')
    <style>
        .message-box {
            border: 1px solid #ccc;
            padding: 15px;
            border-radius: 5px;
            white-space: pre-wrap;
        }
    </style>
@endpush
@section('content')
    @include('layouts.header')
    <div class="container">
        <div class="card p-3">
            <h3>Chi tiết liên hệ</h3>
            <p><strong>Tên:</strong> {{ $contact->full_name }}</p>
            <p><strong>Email:</strong> {{ $contact->email }}</p>
            <p><strong>Số điện thoại:</strong> {{ $contact->phone }}</p>
            <p><strong>Nội dung:</strong></p>
            <div class="message-box" id="messagePreview" style="max-height: 150px; overflow: hidden; position: relative;">
                {!! Str::limit(strip_tags($contact->message), 200, '...') !!}
            </div>
            <button id="showFullMessageBtn" style="margin-top: 10px; cursor: pointer; color: blue; background: none; border: none;">
                Xem thêm
            </button>
            <p><strong>Trạng thái:</strong> {{ $contact->getStatusText() }}</p>
            <hr>

            <button id="replyButton" class="btn btn-success" style="width: 200px;" onclick="showReplyForm()">Phản hồi</button>

            {{-- Form phản hồi ẩn --}}
            <form id="replyForm" method="POST" action="{{ route('contacts.reply', $contact->id) }}" style="display: none; margin-top: 15px;">
                @csrf
                <textarea id="reply_message" name="reply_message" class="form-control" rows="5" placeholder="Nhập phản hồi tại đây...">{{ old('reply_message', $contact->reply_message) }}</textarea>
                @error('reply_message')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <button type="submit" class="btn btn-primary mt-2">Gửi phản hồi</button>
            </form>
        </div>
        <!-- Lịch sử phản hồi -->
        @if($contact->replies->count())
            <hr>
            <h4>Lịch sử phản hồi</h4>
            @foreach($contact->replies as $reply)
                <div class="card my-2 p-3">
                    <p><strong>Người phản hồi:</strong> {{ $reply->admin_name }}</p>
                    <p><strong>Thời gian:</strong> {{ \Carbon\Carbon::parse($reply->reply_date)->format('H:i d/m/Y') }}</p>
                    <p><strong>Nội dung:</strong></p>
                    <div class="message-box">
                        {!! ($reply->reply_message) !!}
                    </div>
                </div>
            @endforeach
        @endif

    </div>
@endsection

@push('js')
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script>
        function showReplyForm() {
            // Hiện form
            document.getElementById('replyForm').style.display = 'block';

            // Ẩn nút phản hồi
            document.getElementById('replyButton').style.display = 'none';

            // Khởi tạo CKEditor nếu chưa có
            if (!CKEDITOR.instances['reply_message']) {
                CKEDITOR.replace('reply_message');
            }
        }
    </script>
    <!-- Modal -->
    <div id="messageModal" style="display:none; position: fixed; top:0; left:0; width: 100vw; height: 100vh;
    background-color: rgba(0,0,0,0.5); z-index: 9999; justify-content: center; align-items: center;">
        <div style="background: white; padding: 20px; max-width: 800px; max-height: 80vh; overflow-y: auto; border-radius: 8px; position: relative;">
            <button id="closeModalBtn" style="position: absolute; top: 10px; right: 10px; cursor: pointer; font-size: 18px; border:none; background:none;">✖</button>
            <h3>Nội dung đầy đủ</h3>
            <div style="white-space: pre-wrap;">
                {!! $contact->message !!}
            </div>
        </div>
    </div>

    <script>
        const showBtn = document.getElementById('showFullMessageBtn');
        const modal = document.getElementById('messageModal');
        const closeBtn = document.getElementById('closeModalBtn');

        showBtn.addEventListener('click', () => {
            modal.style.display = 'flex';
        });

        closeBtn.addEventListener('click', () => {
            modal.style.display = 'none';
        });

        // Đóng modal khi click ngoài box nội dung
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });
    </script>

@endpush
