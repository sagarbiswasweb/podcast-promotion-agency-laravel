@extends('backend.master')

@section('title', 'Reply Email')

@section('content')
<div class="main-container container-fluid">
    <div class="page-header mb-4 d-flex align-items-center justify-content-between">
        <div>
            <h1 class="page-title">Reply Email</h1>
            <ol class="breadcrumb p-0 bg-transparent mb-0">
                <li class="breadcrumb-item">Custom Emails</li>
                <li class="breadcrumb-item"><a href="{{ route('inbox.show', $id) }}">Details</a></li>
                <li class="breadcrumb-item active" aria-current="page">Reply</li>
            </ol>
        </div>
        <div>
            <a href="{{ route('inbox.show', $id) }}" class="btn btn-secondary btn-sm">← Back to Email</a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card p-4">
                @if(session('success'))
                    <div class="alert alert-success mb-3">{{ session('success') }}</div>
                @endif

                <form action="{{ route('admin.custom-email.send') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="is_reply" value="1">
                    <input type="hidden" name="in_reply_to" value="{{ $inReplyTo }}">    {{-- from headerinfo --}}
                    <input type="hidden" name="references" value="{{ $inReplyTo }}">     {{-- or existing refs --}}
                    <input type="hidden" name="replied_inbox_id" value="{{ $id }}">      {{-- IMAP msg no (optional) --}}

                    <div class="mb-3">
                        <label class="form-label">To</label>
                        <input type="email" name="to" class="form-control" value="{{ $to }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Subject</label>
                        <input type="text" name="subject" class="form-control" value="{{ Str::startsWith($subject,'Re:')?$subject:'Re: '.$subject }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Message</label>
                        <textarea name="message" class="form-control" rows="10" required>{{ old('message') }}</textarea>
                        <small class="text-muted d-block mt-1">You can write HTML if you want.</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Attachments</label>
                        <input type="file" name="attachments[]" class="form-control" multiple>
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm">Send Reply</button>
                </form>


            </div>
        </div>
    </div>
</div>
@endsection
