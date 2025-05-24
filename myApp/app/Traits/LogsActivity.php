<?php

namespace App\Traits;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

trait LogsActivity
{
    public static function bootLogsActivity()
    {
        static::created(function ($model) {
            $model->logActivity('Tạo mới');
        });

        static::updated(function ($model) {
            $model->logActivity('Cập nhật');
        });

        static::deleted(function ($model) {
            $model->logActivity('Xóa');
        });
    }

    protected function logActivity($actionPrefix)
    {
        $user = Auth::user();

        $modelName = strtolower(class_basename($this));

        // Tạo action hoàn chỉnh, ví dụ: "Tạo mới sản phẩm"
        $action = $actionPrefix . ' ' . $modelName;

        ActivityLog::create([
            'user_id' => $user ? $user->user_id : null,
            'user_name' => $user ? $user->full_name : 'Guest',
            'user_image' => $user ? ($user->image ?? '') : '',
            'action' => $action,
            'module' => class_basename($this),
        ]);
    }

}
