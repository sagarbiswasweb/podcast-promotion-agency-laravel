


@extends('backend.master')

@section('title')
    Message Reply Form
@endsection

@section('content')
    <div class="main-container container-fluid">
                      
        <!-- PAGE-HEADER -->
        <div class="page-header">
            <div>
                <h1 class="page-title">Send Custom Email</h1>
            </div>
            <div class="ms-auto pageheader-btn">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Send Custom Email</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- ROW -->
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h3 class="card-title">Reply to {{ $message->senderName }}</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('messages.sendReply', $message->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="to" class="form-label">Recipient Email</label>
                                <input readonly type="email" class="form-control" id="to" name="to" required value="{{ $message->senderEmail }}">
                            </div>

                            <div class="mb-3">
                                <label for="subject" class="form-label">Subject</label>
                                <input type="text" class="form-control" id="subject" name="subject" required value="Reply to your message">
                            </div>

                            <div class="mb-3">
                                <label for="reply_body" class="form-label">Message</label>
                                <textarea class="form-control" id="reply_body" name="reply_body" rows="6" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="attachments" class="form-label">Attachments</label>
                                <input type="file" class="form-control" id="attachments" name="attachments[]" multiple>
                            </div>

                            <button type="submit" class="btn btn-primary">Send Reply</button>
                            <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!-- ROW CLOSED -->

        
    </div>
@endsection