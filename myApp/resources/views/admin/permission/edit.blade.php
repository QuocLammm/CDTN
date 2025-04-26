@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Phân quyền cho nhóm: {{ $role->role_name }}</h3>

        <form action="{{ route('show-permission.update', $role->role_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                @foreach ($groupedPermissions as $group => $permissions)
                    <div class="col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="card-header">{{ $group }}</div>
                            <div class="card-body">
                                @foreach ($permissions as $permission)
                                    <div class="form-check">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->permission_id }}"
                                               class="form-check-input"
                                            {{ in_array($permission->permission_id, $rolePermissions) ? 'checked' : '' }}>
                                        <label class="form-check-label">{{ $permission->description }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-success mt-3">Cập nhật quyền</button>
        </form>
    </div>
@endsection
