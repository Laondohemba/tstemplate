<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display a listing of notifications for the authenticated user.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $filter = $request->get('filter', 'all');
        
        $query = Notification::where('user_id', $user->id);
        
        switch ($filter) {
            case 'unread':
                $query->where('is_read', false);
                break;
            case 'read':
                $query->where('is_read', true);
                break;
            case 'recent':
                $query->where('created_at', '>=', now()->subDays(7));
                break;
        }
        
        $notifications = $query->latest()->paginate(20);
        
        if ($request->expectsJson()) {
            return response()->json([
                'notifications' => $notifications,
                'unread_count' => NotificationService::getUnreadCount($user),
            ]);
        }
        
        return view('notifications.index', compact('notifications', 'filter'));
    }

    /**
     * Mark a notification as read.
     */
    public function markAsRead(Request $request, $id)
    {
        $user = Auth::user();
        $notification = Notification::where('user_id', $user->id)->findOrFail($id);
        
        $notification->markAsRead();
        
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Notification marked as read',
                'unread_count' => NotificationService::getUnreadCount($user),
            ]);
        }
        
        return back()->with('success', 'Notification marked as read');
    }

    /**
     * Mark all notifications as read for the authenticated user.
     */
    public function markAllAsRead(Request $request)
    {
        $user = Auth::user();
        $count = NotificationService::markAllAsRead($user);
        
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => "Marked {$count} notifications as read",
                'unread_count' => 0,
            ]);
        }
        
        return back()->with('success', "Marked {$count} notifications as read");
    }

    /**
     * Get unread notification count.
     */
    public function unreadCount(Request $request)
    {
        $user = Auth::user();
        $count = NotificationService::getUnreadCount($user);
        
        return response()->json([
            'unread_count' => $count,
        ]);
    }

    /**
     * Get recent notifications.
     */
    public function recent(Request $request)
    {
        $user = Auth::user();
        $limit = $request->get('limit', 10);
        $notifications = NotificationService::getRecentNotifications($user, $limit);
        
        return response()->json([
            'notifications' => $notifications,
            'unread_count' => NotificationService::getUnreadCount($user),
        ]);
    }

    /**
     * Delete a notification.
     */
    public function destroy(Request $request, $id)
    {
        $user = Auth::user();
        $notification = Notification::where('user_id', $user->id)->findOrFail($id);
        
        $notification->delete();
        
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Notification deleted',
                'unread_count' => NotificationService::getUnreadCount($user),
            ]);
        }
        
        return back()->with('success', 'Notification deleted');
    }
}