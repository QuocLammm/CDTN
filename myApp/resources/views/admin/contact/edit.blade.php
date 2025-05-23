@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@php
    $breadcrumbItems = [
        ['label' => 'Liên hệ', 'url' => route('admin.contact.index')],
        ['label' => 'Chi tiết liên hệ']
    ];
@endphp
@section('content')
    @include('layouts.header')
    <div class="container">
        <div class="card p-3">
            <h3>Chi tiết liên hệ</h3>
            <p><strong>Tên:</strong> {{ $contact->full_name }}</p>
            <p><strong>Email:</strong> {{ $contact->email }}</p>
            <p><strong>Số điện thoại:</strong> {{ $contact->phone }}</p>
            <p><strong>Nội dung:</strong> {!! nl2br(e($contact->message)) !!}</p>
            <p><strong>Trạng thái:</strong> {{ ucfirst($contact->status) }}</p>

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
@endpush
