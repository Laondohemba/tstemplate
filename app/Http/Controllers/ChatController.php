<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use App\Models\Message;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChatController extends Controller
{
    /**
     * Display a listing of chats for the authenticated user.
     */
    public function index(Request $request)
    {
        $user = request()->user();

        // Handle inquiry response - create chat and send initial message
        if ($request->has('inquiry_id') && $request->has('buyer_id') && $request->has('message')) {
            $buyerId = $request->get('buyer_id');
            $inquiryId = $request->get('inquiry_id');
            $message = $request->get('message');

            // Check if a chat already exists between these two users
            $existingChat = Chat::whereHas('users', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
                ->whereHas('users', function ($query) use ($buyerId) {
                    $query->where('user_id', $buyerId);
                })
                ->where('type', 'private')
                ->first();

            if ($existingChat) {
                // Send the response message
                $sentMessage = Message::create([
                    'chat_id' => $existingChat->id,
                    'sender_id' => $user->id,
                    'message' => $message,
                    'is_read' => false,
                ]);

                // Notify the buyer about the new message
                NotificationService::notifyNewMessage(User::find($buyerId), $sentMessage);

                // Update chat timestamp
                $existingChat->touch();

                return redirect()->route('chats.show', $existingChat->slug);
            } else {
                // Create a new chat
                $chat = Chat::create([
                    'slug'     => substr(md5(uniqid(time(), true)), 0, 32),
                    'type' => 'private',
                    'name' => null,
                ]);

                // Attach both users to the chat
                $chat->users()->attach([$user->id, $buyerId]);

                // Send the response message
                $sentMessage = Message::create([
                    'chat_id' => $chat->id,
                    'sender_id' => $user->id,
                    'message' => $message,
                    'is_read' => false,
                ]);

                // Notify the buyer about the new message
                NotificationService::notifyNewMessage(User::find($buyerId), $sentMessage);

                // Update chat timestamp
                $chat->touch();

                return redirect()->route('chats.show', $chat->slug);
            }
        }

        $chats = $user->chats()
            ->with([
                'users' => function ($query) use ($user) {
                    $query->where('users.id', '!=', $user->id);
                },
                'latestMessage.sender'
            ])
            ->latest('chats.updated_at')
            ->get();

        return view('chats.index', compact('chats'));
    }

    /**
 * Display a specific chat with its messages.
 */
public function show(Chat $chat)
{
    $user = request()->user();

    // Ensure the authenticated user is part of this chat
    if (!$chat->users->contains($user->id)) {
        abort(403, 'Unauthorized access to this chat.');
    }

    // Get all chats for the sidebar
    $chats = $user->chats()
        ->with([
            'users' => function ($query) use ($user) {
                $query->where('users.id', '!=', $user->id);
            },
            'latestMessage.sender'
        ])
        ->latest('chats.updated_at')
        ->get();

    // Get messages for this chat
    $messages = $chat->messages()
        ->with('sender')
        ->orderBy('created_at', 'asc')
        ->get();

    // Get the other user's last read message ID to determine read status
    $otherUser = $chat->users->where('id', '!=', $user->id)->first();
    $otherUserPivot = $chat->users()->where('user_id', $otherUser->id)->first();
    $otherUserLastReadMessageId = $otherUserPivot ? $otherUserPivot->pivot->last_message_id : null;

    // Get unread messages (messages sent by other users that haven't been read)
    $currentUserPivot = $chat->users()->where('user_id', $user->id)->first();
    $currentUserLastReadMessageId = $currentUserPivot ? $currentUserPivot->pivot->last_message_id : null;

    $unreadMessages = $chat->messages()
        ->where('sender_id', '!=', $user->id)
        ->when($currentUserLastReadMessageId, function ($query, $lastReadId) {
            $query->where('id', '>', $lastReadId);
        })
        ->get();

    //  Mark messages as read when user views the chat
    $latestMessageId = $chat->messages()
        ->where('sender_id', '!=', $user->id)
        ->latest('id')
        ->value('id');

    if ($latestMessageId) {
        $chat->users()->updateExistingPivot($user->id, [
            'last_message_id' => $latestMessageId,
            'updated_at' => now(),
        ]);

        // Optionally: update messages table for backward compatibility
        $chat->messages()
            ->where('sender_id', '!=', $user->id)
            ->where('id', '<=', $latestMessageId)
            ->where('is_read', false)
            ->update(['is_read' => true]);
    }

    return view('chats.show', compact(
        'chat',
        'chats',
        'messages',
        'unreadMessages',
        'otherUserLastReadMessageId'
    ));
}

    /**
     * Start a new chat with a user.
     */
    public function start($slug)
    {
        $authUser = request()->user();
        $user = User::where('slug', $slug)->first();

        // Check if a chat already exists between these two users
        $existingChat = Chat::whereHas('users', function ($query) use ($authUser) {
            $query->where('user_id', $authUser->id);
        })
            ->whereHas('users', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->where('type', 'private')
            ->first();

        if ($existingChat) {
            return redirect()->route('chats.show', $existingChat->slug);
        }

        // Create a new chat
        $chat = Chat::create([
            'slug'     => substr(md5(uniqid(time(), true)), 0, 32),
            'type' => 'private',
            'name' => null, // Private chats don't need names
        ]);

        // Attach both users to the chat
        $chat->users()->attach([$authUser->id, $user->id]);

        return redirect()->route('chats.show', $chat->slug);
    }

    /**
     * Send a message in a chat.
     */
    public function sendMessage(Request $request, Chat $chat)
    {
        $user = request()->user();

        // Ensure the authenticated user is part of this chat
        if (!$chat->users->contains($user->id)) {
            abort(403, 'Unauthorized access to this chat.');
        }

        $validated = $request->validate([
            'message' => 'required_without:attachment|string|max:5000',
            'attachment' => 'nullable|file|max:10240|mimes:jpg,jpeg,png,pdf,doc,docx,txt'
        ]);

        $messageData = [
            'chat_id' => $chat->id,
            'sender_id' => $user->id,
            'message' => $validated['message'] ?? null,
            'is_read' => false,
        ];

        // Handle file attachment if present
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('chat_attachments', $filename, 'public');

            // You might want to add an 'attachment' column to messages table
            // or create a separate attachments table
            $messageData['attachment'] = $path;

            // If no message text, set a default message
            if (!$messageData['message']) {
                $messageData['message'] = 'Sent an attachment';
            }
        }

        $message = Message::create($messageData);

        // Notify the recipient about the new message
        $recipient = $chat->users()->where('user_id', '!=', $user->id)->first();
        if ($recipient) {
            NotificationService::notifyNewMessage($recipient, $message);
        }

        // Update the chat's updated_at timestamp
        $chat->touch();

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => $message->load('sender')
            ]);
        }

        return redirect()->route('chats.show', $chat->slug);
    }

    /**
     * Mark messages as read in a chat.
     */
    public function markAsRead(Chat $chat)
    {
        $user = request()->user();

        // Ensure the authenticated user is part of this chat
        if (!$chat->users->contains($user->id)) {
            abort(403, 'Unauthorized access to this chat.');
        }

        // Get the latest message in the chat
        $lastMessage = $chat->messages()->latest('id')->first();

        if ($lastMessage) {
            // Update the pivot table with the last read message ID
            $chat->users()->updateExistingPivot($user->id, [
                'last_message_id' => $lastMessage->id
            ]);

            // Optionally: Mark messages as read in the messages table for backward compatibility
            // This updates the is_read column for messages sent by others
            $chat->messages()
                ->where('sender_id', '!=', $user->id)
                ->where('id', '<=', $lastMessage->id)
                ->where('is_read', false)
                ->update(['is_read' => true]);
        }

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'last_message_id' => $lastMessage ? $lastMessage->id : null
            ]);
        }

        return back();
    }
}
