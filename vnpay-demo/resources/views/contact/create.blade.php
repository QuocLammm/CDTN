@extends('layouts.app')
@section('title','Form Request')
@section('content')
    <h2>Demo Form Request</h2>
    @if(session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif

    @if($errors->any())
        <ul style="color: red; text-decoration: none ">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('contact.submit') }}">
        @csrf
        <p style="border: 2px" >
            <label>Tên:</label><br>
            <input type="text" name="FullName" value="{{ old('FullName') }} ">
        </p>
        <p>
            <label>Email:</label><br>
            <input type="text" name="Email" value="{{ old('Email') }}">
        </p>
        <p>
            <label>Phone:</label><br>
            <input type="text" name="Phone" value="{{ old('Phone') }}">
        </p>
        <p>
            <label>Nội dung:</label><br>
            <textarea name="Message">{{ old('Message') }}</textarea>
        </p>
        <p>
            <button type="submit">Gửi</button>
        </p>
    </form>

@endsection
