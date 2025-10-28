<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;

class NotificationService
{
    /**
     * Create a new notification.
     */
    public static function create(array $data): Notification
    {
        return Notification::create($data);
    }

    /**
     * Notify user about new inquiry.
     */
    public static function notifyInquiryReceived(User $user, $inquiry): Notification
    {
        return self::create([
            'user_id' => $user->id,
            'type' => 'inquiry_received',
            'title' => 'New Inquiry Received',
            'message' => "You have received a new inquiry: \"{$inquiry->subject}\"",
            'data' => [
                'inquiry_id' => $inquiry->id,
                'buyer_name' => $inquiry->buyer->name,
                'product_name' => $inquiry->product ? $inquiry->product->product_name : null,
                'service_name' => $inquiry->service ? $inquiry->service->company_name : null,
            ],
        ]);
    }

    /**
     * Notify user about inquiry response.
     */
    public static function notifyInquiryResponded(User $user, $inquiry): Notification
    {
        return self::create([
            'user_id' => $user->id,
            'type' => 'inquiry_responded',
            'title' => 'Inquiry Response Received',
            'message' => "Your inquiry \"{$inquiry->subject}\" has been responded to",
            'data' => [
                'inquiry_id' => $inquiry->id,
                'vendor_name' => $inquiry->vendor->name,
                'product_name' => $inquiry->product ? $inquiry->product->product_name : null,
                'service_name' => $inquiry->service ? $inquiry->service->company_name : null,
            ],
        ]);
    }

    /**
     * Notify user about new order.
     */
    public static function notifyOrderCreated(User $user, $order): Notification
    {
        return self::create([
            'user_id' => $user->id,
            'type' => 'order_created',
            'title' => 'New Order Received',
            'message' => "You have received a new order for \"{$order->product->product_name}\"",
            'data' => [
                'order_id' => $order->id,
                'buyer_name' => $order->buyer->name,
                'product_name' => $order->product->product_name,
                'quantity' => $order->quantity,
                'total_amount' => $order->total_amount,
            ],
        ]);
    }

    /**
     * Notify user about order status update.
     */
    public static function notifyOrderStatusUpdate(User $user, $order): Notification
    {
        return self::create([
            'user_id' => $user->id,
            'type' => 'order_status_update',
            'title' => 'Order Status Updated',
            'message' => "Your order for \"{$order->product->product_name}\" status has been updated to \"{$order->status}\"",
            'data' => [
                'order_id' => $order->id,
                'vendor_name' => $order->vendor->name,
                'product_name' => $order->product->product_name,
                'status' => $order->status,
            ],
        ]);
    }

    /**
     * Notify user about new message.
     */
    public static function notifyNewMessage(User $user, $message): Notification
    {
        return self::create([
            'user_id' => $user->id,
            'type' => 'new_message',
            'title' => 'New Message Received',
            'message' => "You have received a new message from {$message->sender->name}",
            'data' => [
                'message_id' => $message->id,
                'chat_id' => $message->chat_id,
                'sender_name' => $message->sender->name,
                'message_preview' => substr($message->message, 0, 100),
            ],
        ]);
    }

    /**
     * Notify user about service verification.
     */
    public static function notifyServiceVerification(User $user, $service, $status): Notification
    {
        $title = $status === 'verified' ? 'Service Verified' : 'Service Verification Required';
        $message = $status === 'verified' 
            ? "Your service \"{$service->company_name}\" has been verified and is now live"
            : "Your service \"{$service->company_name}\" requires verification";

        return self::create([
            'user_id' => $user->id,
            'type' => 'service_verification',
            'title' => $title,
            'message' => $message,
            'data' => [
                'service_id' => $service->id,
                'service_name' => $service->company_name,
                'verification_status' => $status,
            ],
        ]);
    }

    /**
     * Mark all notifications as read for a user.
     */
    public static function markAllAsRead(User $user): int
    {
        return Notification::where('user_id', $user->id)
            ->where('is_read', false)
            ->update([
                'is_read' => true,
                'read_at' => now(),
            ]);
    }

    /**
     * Get unread notification count for a user.
     */
    public static function getUnreadCount(User $user): int
    {
        return Notification::where('user_id', $user->id)
            ->where('is_read', false)
            ->count();
    }

    /**
     * Get recent notifications for a user.
     */
    public static function getRecentNotifications(User $user, $limit = 10)
    {
        return Notification::where('user_id', $user->id)
            ->latest()
            ->limit($limit)
            ->get();
    }
}
