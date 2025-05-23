<?php

namespace App\Http\Controllers;

use App\Models\UserMessages;
use App\Models\Reply;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class MessageController extends Controller
{

    public function postMessage(Request $request)
    {

        $request->validate([
            'message' => 'required|string|max:5000',
            'user_to' => 'required|email',
            'user_from' => 'required|email',
            'subject' => 'required|string',

        ], [
            'message.required' => 'Message is required!',
            'subject.required' => 'Subject is required!',

        ]);

        // Retrieve user IDs from emails
        $toUser = \App\Models\User::where('email', $request->user_to)->firstOrFail();
        $fromUser = \App\Models\User::where('email', $request->user_from)->firstOrFail();
        $usermessage = $request->message;

        if (!$fromUser || !$toUser) {
            return redirect()->back()->with('error', 'User not found.');
        }

        // Create a message
        UserMessages::create([
            'user_id' => Auth::user()->id,
            'message' => $usermessage,
            'subject' => $request->subject,
            'status' => 'sent',
            'sender_id' => $fromUser->id,
            'receiver_id' => $toUser->id,
            'read_at' => null
        ]);

        return redirect()->back()->with('success', 'User Message Uploaded');
    }


    public function updateSeenStatus($id, Request $request)
    {
        $message = UserMessages::find($id);
        // if (!$message) {
        //     return response()->json(['success' => false, 'message' => 'Message not found'], 404);
        // }

        // if ($request->query('status') !== 'received') {
        //     return response()->json(['success' => false, 'message' => 'Cannot update sent messages'], 403);
        // }

        // if ($message->status === 'sent') {
        //     return response()->json(['success' => false, 'message' => 'Unauthorized action'], 403);
        // }

        $message->read_at = Carbon::now();
        $message->save();

        return response()->json(['success' => true, 'message' => 'Message marked as seen']);
    }


    public function getMessages(Request $request)
    {

        $userId = Auth::id();

        $allPatients = User::where('user_type', 'patient')
            ->where('id', '!=', auth()->id())
            ->get();

        $allAdmins = User::whereIn('user_type', ['admin', 'staff'])
            ->where('id', '!=', auth()->id())
            ->get();


        // Ensure recipients is an array of emails
        $recipients = Auth::user()->user_type === 'patient'
            ? $allAdmins->pluck('email')->toArray()
            : $allPatients->pluck('email')->toArray();
        $status = $request->query('status', 'received');

        if ($status == 'sent') {
            $messages = UserMessages::where('sender_id', $userId)
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $messages = UserMessages::where('receiver_id', $userId)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('messages', compact('messages', 'allPatients', 'allAdmins', 'recipients'));
    }


    public function getReplies($messageId)
    {

        $replies = Reply::where('message_id', $messageId)
            ->with('sender:id,email,image_path') // Load sender details
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($reply) {
                return [
                    'id' => $reply->id,
                    'from_user_email' => $reply->sender->email,
                    'message' => $reply->message,
                    'sender_image' => $reply->sender->profile_image ?? '/images/default-avatar.png',
                    'created_at' => $reply->created_at->format('F j, Y h:i A'),
                ];
            });

        return response()->json($replies);
    }

    public function postReply(Request $request, $messageId)
    {
        $request->validate([
            'message' => 'required|string|max:5000',
            'user_to' => 'required|email',
            'user_from' => 'required|email',
            'subject' => 'required|string',
        ], [
            'message.required' => 'Message is required!',
            'subject.required' => 'Subject is required!',   
        ]);

        // Retrieve user IDs from emails
        $fromUser = \App\Models\User::where('email', $request->user_from)->firstOrFail();
        $toUser = \App\Models\User::where('email', $request->user_to)->firstOrFail();
        $usermessage = $request->message;



        if (!$fromUser || !$toUser) {
            return redirect()->back()->with('error', 'User not found.');
        }


        // Create the reply
        Reply::create([
            'message_id' => $messageId,
            'user_id' => auth()->id(),
            'message' => $usermessage,
            'subject' => $request->subject,
            'from_user_id' => $fromUser->id,
            'to_user_id' => $toUser->id,
        ]);

        return redirect()->back()->with('success', 'Reply sent successfully!');
    }
}
