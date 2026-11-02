<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Mail\CustomEmail;
use App\Models\CustomEmail as CustomEmailModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class CustomEmailController extends Controller
{
    public function create()
    {
        return view('backend.custom-email.create');
    }




    // app/Http/Controllers/backend/CustomEmailController.php

    public function send(Request $request)
    {
        $request->validate([
            'to' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'attachments.*' => 'nullable|file|max:10240',
            // reply-specific (optional)
            'is_reply'        => 'nullable|boolean',
            'in_reply_to'     => 'nullable|string',
            'references'      => 'nullable|string',
            'replied_inbox_id'=> 'nullable|integer',
        ]);

        $attachmentsPaths = [];
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $attachmentsPaths[] = $file->store('custom-email-attachments', 'public');
            }
        }

        // Save to DB (same table)
        $emailRecord = \App\Models\CustomEmail::create([
            'to'              => $request->to,
            'subject'         => $request->subject,
            'message'         => $request->message,
            'attachments'     => json_encode($attachmentsPaths),
            'source'          => $request->boolean('is_reply') ? 'reply' : 'custom',
            'in_reply_to'     => $request->in_reply_to,
            'references'      => $request->references,
            'replied_inbox_id'=> $request->replied_inbox_id,
        ]);

        $uploaded = $request->file('attachments') ?? [];

        // Send with headers + attachments
        Mail::to($request->to)->send(
            new \App\Mail\CustomEmail(
                $request->subject,
                $request->message,
                $uploaded,
                $request->in_reply_to,
                $request->references
            )
        );

        Alert::success('Success', 'Mail sent successfully');
        return back();
    }




    public function index(){
        $customEmails = CustomEmailModel::all()->sortByDesc('created_at');
        return view('backend.custom-email.index', compact('customEmails'));
    }



    public function view($id)
    {
        $customEmail = CustomEmailModel::findOrFail($id);
        return view('backend.custom-email.view', compact('customEmail'));
    }



    public function destroy($id)
    {
        $customEmail = CustomEmailModel::findOrFail($id);

        // Delete related attachments from storage
        if (!empty($customEmail->attachments)) {
            $attachments = json_decode($customEmail->attachments, true);

            if (is_array($attachments)) {
                foreach ($attachments as $file) {
                    if (is_string($file) && Storage::disk('public')->exists($file)) {
                        Storage::disk('public')->delete($file);
                    } elseif (is_array($file) && isset($file['path']) && Storage::disk('public')->exists($file['path'])) {
                        Storage::disk('public')->delete($file['path']);
                    }
                }
            }
        }

        // Delete database record
        $customEmail->delete();

        Alert::success('Success', 'Custom email deleted successfully');
        return redirect()->route('admin.view-custom-email');
    }
    

}
