<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Mail\ReplyToMessage;
use App\Models\Message;
use App\Models\MessageReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

use function Pest\Laravel\delete;

class MessageController extends Controller
{
    public function showMessages(){
        $messages = Message::orderBy('created_at', 'desc')->get();
        return view('backend.messages.index', [
            'messages' => $messages
        ]);
    }

    public function viewMessage($id){
        $message = Message::find($id);

        if (!$message->seen) {
            $message->seen = true;
            $message->save();
        }

        return view('backend.messages.view', [
            'message' => $message
        ]);
    }

    // Get unseen message count
    public function getUnseenCount(){
        $count = Message::where('seen', false)->count();
        return response()->json(['unseenCount' => $count]);
    }

    // Get unseen message dropdown HTML
    public function unseenDropdown(){
        $unseenMessages = Message::where('seen', false)->latest()->take(5)->get();
        return view('backend.common.unseen-messages-dropdown', compact('unseenMessages'))->render();
    }

    // Mark a message as seen
    public function markSeen($id){
        try {
            $message = Message::findOrFail($id);
            if (!$message->seen) {
                $message->seen = true;
                $message->save();
            }
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function showReplyForm($id)
    {
        $message = Message::findOrFail($id);

        return view('backend.messages.reply', compact('message'));
    }


    // message reply 
    public function sendReply(Request $request, $id)
    {
        $message = Message::findOrFail($id);

        $uploadedFiles = [];
        $storedPaths = [];

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('message-reply', 'public');
                $storedPaths[] = $path;
                $uploadedFiles[] = $file;
            }
        }

        $reply = MessageReply::create([
            'message_id' => $message->id,
            'to_email' => $request->to,
            'subject' => $request->subject,
            'body' => $request->reply_body,
            'attachments' => json_encode($storedPaths),
        ]);

        Mail::to($request->to)->send(new ReplyToMessage(
            $request->subject,
            $request->reply_body,
            $uploadedFiles
        ));

        return redirect()->route('admin.show-messages')->with('success', 'Reply sent successfully.');
    }


    
    // delete message 
    public function deleteMessage($id)
    {
        $message = Message::with('replies')->findOrFail($id);

        // Delete attachments from replies
        foreach ($message->replies as $reply) {
            if ($reply->attachments) {
                $attachments = json_decode($reply->attachments, true) ?? [];
                foreach ($attachments as $path) {
                    Storage::disk('public')->delete($path); // delete file from storage
                }
            }
        }

        // Delete the replies
        $message->replies()->delete();

        // Finally delete the message itself
        $message->delete();

        Alert::success('Success', 'Message and related replies deleted successfully.');
        return back();
    }


    
    public function viewReply($id)
    {
        $message = Message::with('replies')->findOrFail($id);
        return view('backend.messages.view-reply', compact('message'));
    }




}
