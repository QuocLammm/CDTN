@extends('layouts.app')

@section('content')
    <div class="container">
        <br>
        <h3>Phân quyền cho người dùng: {{ $user->full_name }}</h3>

        <form action="{{ route('update-customer.permissions', $user->user_id) }}" method="POST">
            @csrf
            @method('POST') <!-- Cái này cần thiết khi sử dụng phương thức POST -->
            <div class="row">
                @foreach ($groupedPermissions as $group => $permissions)
                    <div class="col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="card-header font-weight-bold text-primary">
                                {{ $group }}
                            </div>
                            <div class="card-body">
                                @foreach ($permissions as $permission)
                                    <div class="form-check mb-2">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->permission_id }}"
                                               class="form-check-input"
                                            {{ in_array($permission->permission_id, $userPermissions) ? 'checked' : '' }}>
                                        <label class="form-check-label">
                                            {{ $permission->description }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <button type="submit" class="btn btn-primary mt-3">Cập nhật quyền</button>
        </form>
    </div>

@endsection
@push('js')
    <script>
        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Cập nhật quyền thành công!',
            text: '{{ session('success') }}',
            confirmButtonText: 'OK'
        });
        @endif
    </script>
@endpush

