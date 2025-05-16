<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use App\Models\Notification;
use Illuminate\Support\Facades\Route;

// API để gần realtime Nitification
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/notification/unread-count', function () {
        $userId = Auth::id(); // Hoặc logic của bạn để lấy UserID thực sự

        $count = \App\Models\Notification::where('status', 0)
            ->where('user_id', $userId) // tuỳ yêu cầu
            ->count();

        return response()->json(['count' => $count]);
    });
});

