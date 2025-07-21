<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
        public function index(Request $request)
    {
        $client = $request->user();
        $notifications = $client->notifications()
            ->with('donationRequest.bloodType', 'donationRequest.city')
            ->orderBy('pivot_created_at', 'desc')
            ->paginate(20);
            // ->get();

        return response()->json([
            'status' => 200,
            'notifications' => $notifications
        ]);
    }

    public function markAsRead(Request $request, $notificationId)
    {
        $client = $request->user();
        $client->notifications()->updateExistingPivot($notificationId, ['is_read' => true]);

        return response()->json([
            'status' => 200,
            'message' => 'تم تحديد الإشعار كمقروء'
        ]);
    }

    public function unreadCount(Request $request)
    {
        $client = $request->user();
        $count = $client->notifications()
            ->wherePivot('is_read', false)
            ->count();

        return response()->json([
            'status' => 200,
            'unread_count' => $count
        ]);
    }
}
