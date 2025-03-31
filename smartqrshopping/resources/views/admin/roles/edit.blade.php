<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chỉnh sửa nhóm quyền</title>
    <link rel="stylesheet" href="/css/login/login.css">
    <link rel="stylesheet" href="/css/roles/edit.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Sharp" rel="stylesheet" />
</head>
<body>
<div class="container">
    @include('layouts.sidebar')
    <main>
        <h1>Chỉnh sửa nhóm quyền</h1>
        <form action="{{ route('roles.update', $role->RoleID) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- RoleName -->
            <div class="form-group">
                <label for="RoleName">Tên nhóm quyền<span class="required">*</span></label>
                <input type="text" id="RoleName" name="RoleName" value="{{ old('RoleName', $role->RoleName) }}" required>
            </div>

            <!-- Description -->
            <div class="form-group">
                <label for="Description">Mô tả</label>
                <textarea id="Description" name="Description">{{ old('Description', $role->Description) }}</textarea>
            </div>

            <!-- Danh sách quyền -->
            <h3>Phân quyền:</h3>
            <div class="permissions-container">
                <!-- Quản lý tài khoản người dùng -->
                <div class="permission-group">
                    <input type="checkbox" id="manage_users" class="group-checkbox"
                           data-group="users"
                        {{ in_array('view_users', $assignedPermissions) && in_array('add_users', $assignedPermissions) && in_array('edit_users', $assignedPermissions) && in_array('delete_users', $assignedPermissions) ? 'checked' : '' }}>
                    <label for="manage_users">Quản lý tài khoản người dùng</label>

                    <!-- Nút chọn tất cả và hủy tất cả -->
                    <div class="select-all">
                        <button type="button" id="select_all_users" class="select-button">Chọn tất cả</button>
                        <button type="button" id="deselect_all_users" class="select-button">Hủy tất cả</button>
                    </div>

                    <div class="sub-permissions">
                        <div class="permission-item">
                            <input type="checkbox" id="view_users" name="permissions[]" value="view_users"
                                {{ in_array('view_users', $assignedPermissions) ? 'checked' : '' }}>
                            <label for="view_users">Xem người dùng</label>
                        </div>
                        <div class="permission-item">
                            <input type="checkbox" id="add_users" name="permissions[]" value="add_users"
                                {{ in_array('add_users', $assignedPermissions) ? 'checked' : '' }}>
                            <label for="add_users">Thêm người dùng mới</label>
                        </div>
                        <div class="permission-item">
                            <input type="checkbox" id="edit_users" name="permissions[]" value="edit_users"
                                {{ in_array('edit_users', $assignedPermissions) ? 'checked' : '' }}>
                            <label for="edit_users">Chỉnh sửa người dùng</label>
                        </div>
                        <div class="permission-item">
                            <input type="checkbox" id="delete_users" name="permissions[]" value="delete_users"
                                {{ in_array('delete_users', $assignedPermissions) ? 'checked' : '' }}>
                            <label for="delete_users">Xóa người dùng</label>
                        </div>
                    </div>
                </div>

                <!-- Quản lý vai trò người dùng -->
                <div class="permission-group">
                    <input type="checkbox" id="manage_roles" class="group-checkbox"
                           data-group="roles"
                        {{ in_array('view_roles', $assignedPermissions) && in_array('assign_roles', $assignedPermissions) ? 'checked' : '' }}>
                    <label for="manage_roles">Quản lý vai trò người dùng</label>
                    <div class="sub-permissions">
                        <div class="permission-item">
                            <input type="checkbox" id="view_roles" name="permissions[]" value="view_roles"
                                {{ in_array('view_roles', $assignedPermissions) ? 'checked' : '' }}>
                            <label for="view_roles">Xem vai trò</label>
                        </div>
                        <div class="permission-item">
                            <input type="checkbox" id="assign_roles" name="permissions[]" value="assign_roles"
                                {{ in_array('assign_roles', $assignedPermissions) ? 'checked' : '' }}>
                            <label for="assign_roles">Gán vai trò</label>
                        </div>
                    </div>
                </div>

                <!-- Quản lý kho hàng -->
                <div class="permission-group">
                    <input type="checkbox" id="manage_inventory" class="group-checkbox"
                           data-group="inventory"
                        {{ in_array('view_inventory', $assignedPermissions) && in_array('add_inventory', $assignedPermissions) && in_array('edit_inventory', $assignedPermissions) && in_array('delete_inventory', $assignedPermissions) ? 'checked' : '' }}>
                    <label for="manage_inventory">Quản lý kho hàng</label>
                    <!-- Nút chọn tất cả và hủy tất cả -->
                    <div class="select-all">
                        <button type="button" id="select_all_orders" class="select-button">Chọn tất cả</button>
                        <button type="button" id="deselect_all_orders" class="select-button">Hủy tất cả</button>
                    </div>
                    <div class="sub-permissions">
                        <div class="permission-item">
                            <input type="checkbox" id="view_inventory" name="permissions[]" value="view_inventory"
                                {{ in_array('view_inventory', $assignedPermissions) ? 'checked' : '' }}>
                            <label for="view_inventory">Xem kho hàng</label>
                        </div>
                        <div class="permission-item">
                            <input type="checkbox" id="add_inventory" name="permissions[]" value="add_inventory"
                                {{ in_array('add_inventory', $assignedPermissions) ? 'checked' : '' }}>
                            <label for="add_inventory">Thêm hàng vào kho</label>
                        </div>
                        <div class="permission-item">
                            <input type="checkbox" id="edit_inventory" name="permissions[]" value="edit_inventory"
                                {{ in_array('edit_inventory', $assignedPermissions) ? 'checked' : '' }}>
                            <label for="edit_inventory">Chỉnh sửa kho hàng</label>
                        </div>
                        <div class="permission-item">
                            <input type="checkbox" id="delete_inventory" name="permissions[]" value="delete_inventory"
                                {{ in_array('delete_inventory', $assignedPermissions) ? 'checked' : '' }}>
                            <label for="delete_inventory">Xóa hàng trong kho</label>
                        </div>
                    </div>
                </div>

                <!-- Quản lý báo cáo tài chính -->
                <div class="permission-group">
                    <input type="checkbox" id="manage_financial_reports" class="group-checkbox"
                           data-group="financial_reports"
                        {{ in_array('view_financial_reports', $assignedPermissions) ? 'checked' : '' }}>
                    <label for="manage_financial_reports">Quản lý báo cáo tài chính</label>
                    <!-- Nút chọn tất cả và hủy tất cả -->
                    <div class="select-all">
                        <button type="button" id="select_all_users" class="select-button">Chọn tất cả</button>
                        <button type="button" id="deselect_all_users" class="select-button">Hủy tất cả</button>
                    </div>
                    <div class="sub-permissions">
                        <div class="permission-item">
                            <input type="checkbox" id="view_financial_reports" name="permissions[]" value="view_financial_reports"
                                {{ in_array('view_financial_reports', $assignedPermissions) ? 'checked' : '' }}>
                            <label for="view_financial_reports">Xem báo cáo tài chính</label>
                        </div>
                    </div>
                </div>

                <!-- Quản lý chương trình khuyến mãi -->
                <div class="permission-group">
                    <input type="checkbox" id="manage_promotions" class="group-checkbox"
                           data-group="promotions"
                        {{ in_array('view_promotions', $assignedPermissions) && in_array('add_promotions', $assignedPermissions) && in_array('edit_promotions', $assignedPermissions) && in_array('delete_promotions', $assignedPermissions) ? 'checked' : '' }}>
                    <label for="manage_promotions">Quản lý chương trình khuyến mãi</label>
                    <!-- Nút chọn tất cả và hủy tất cả -->
                    <div class="select-all">
                        <button type="button" id="select_all_users" class="select-button">Chọn tất cả</button>
                        <button type="button" id="deselect_all_users" class="select-button">Hủy tất cả</button>
                    </div>
                    <div class="sub-permissions">
                        <div class="permission-item">
                            <input type="checkbox" id="view_promotions" name="permissions[]" value="view_promotions"
                                {{ in_array('view_promotions', $assignedPermissions) ? 'checked' : '' }}>
                            <label for="view_promotions">Xem khuyến mãi</label>
                        </div>
                        <div class="permission-item">
                            <input type="checkbox" id="add_promotions" name="permissions[]" value="add_promotions"
                                {{ in_array('add_promotions', $assignedPermissions) ? 'checked' : '' }}>
                            <label for="add_promotions">Thêm khuyến mãi mới</label>
                        </div>
                        <div class="permission-item">
                            <input type="checkbox" id="edit_promotions" name="permissions[]" value="edit_promotions"
                                {{ in_array('edit_promotions', $assignedPermissions) ? 'checked' : '' }}>
                            <label for="edit_promotions">Chỉnh sửa khuyến mãi</label>
                        </div>
                        <div class="permission-item">
                            <input type="checkbox" id="delete_promotions" name="permissions[]" value="delete_promotions"
                                {{ in_array('delete_promotions', $assignedPermissions) ? 'checked' : '' }}>
                            <label for="delete_promotions">Xóa khuyến mãi</label>
                        </div>
                    </div>
                </div>

                <!-- Quản lý sự kiện -->
                <div class="permission-group">
                    <input type="checkbox" id="manage_events" class="group-checkbox"
                           data-group="events"
                        {{ in_array('view_events', $assignedPermissions) && in_array('add_events', $assignedPermissions) && in_array('edit_events', $assignedPermissions) && in_array('delete_events', $assignedPermissions) ? 'checked' : '' }}>
                    <label for="manage_events">Quản lý sự kiện</label>
                    <!-- Nút chọn tất cả và hủy tất cả -->
                    <div class="select-all">
                        <button type="button" id="select_all_users" class="select-button">Chọn tất cả</button>
                        <button type="button" id="deselect_all_users" class="select-button">Hủy tất cả</button>
                    </div>
                    <div class="sub-permissions">
                        <div class="permission-item">
                            <input type="checkbox" id="view_events" name="permissions[]" value="view_events"
                                {{ in_array('view_events', $assignedPermissions) ? 'checked' : '' }}>
                            <label for="view_events">Xem sự kiện</label>
                        </div>
                        <div class="permission-item">
                            <input type="checkbox" id="add_events" name="permissions[]" value="add_events"
                                {{ in_array('add_events', $assignedPermissions) ? 'checked' : '' }}>
                            <label for="add_events">Thêm sự kiện mới</label>
                        </div>
                        <div class="permission-item">
                            <input type="checkbox" id="edit_events" name="permissions[]" value="edit_events"
                                {{ in_array('edit_events', $assignedPermissions) ? 'checked' : '' }}>
                            <label for="edit_events">Chỉnh sửa sự kiện</label>
                        </div>
                        <div class="permission-item">
                            <input type="checkbox" id="delete_events" name="permissions[]" value="delete_events"
                                {{ in_array('delete_events', $assignedPermissions) ? 'checked' : '' }}>
                            <label for="delete_events">Xóa sự kiện</label>
                        </div>
                    </div>
                </div>



                {{--                <!-- Quản lý các quyền khác -->--}}
{{--                @foreach($permissions as $permission)--}}
{{--                    @if(!in_array($permission->PermissionName, ['view_users', 'add_users', 'edit_users', 'delete_users']))--}}
{{--                        <div class="permission-item">--}}
{{--                            <input type="checkbox"--}}
{{--                                   id="permission_{{ $permission->PermissionID }}"--}}
{{--                                   name="permissions[]"--}}
{{--                                   value="{{ $permission->PermissionID }}"--}}
{{--                                {{ in_array($permission->PermissionID, $assignedPermissions) ? 'checked' : '' }}>--}}
{{--                            <label for="permission_{{ $permission->PermissionID }}">--}}
{{--                                {{ $permission->PermissionName }} - {{ $permission->Description }}--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                @endforeach--}}
            </div>

            <div class="button-group">
                <button type="submit" class="btn-submit">Cập nhật</button>
                <a href="{{ route('roles.index') }}" class="btn-back">Quay Lại</a>
            </div>
        </form>
    </main>
    @include('layouts.right_section')
</div>
<script>




</script>
</body>
</html>
