@extends('backend.master')

@section('title', 'View Reply')

@section('content')
<div class="main-container container-fluid">

    <!-- PAGE HEADER -->
    <div class="page-header mb-4">
        <h1 class="page-title">Conversation with {{ $message->senderName }}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb p-0 bg-transparent">
                <li class="breadcrumb-item">Messages</li>
                <li class="breadcrumb-item active" aria-current="page">View Reply</li>
            </ol>
        </nav>
    </div>

    <!-- Conversation Thread -->
    <div class="row justify-content-center">
        <div class="col-md-10">
            <!-- User Message -->
            <div class="mb-4">
                <small class="text-muted">From: <strong>{{ $message->senderName }}</strong> | {{ $message->created_at->timezone('Asia/Dhaka')->format('d M, Y h:i A') }}</small>
                <div class="p-3 rounded mt-1">
                    {{ $message->senderMessage }}
                </div>
            </div>

            <hr>

            <!-- Admin Replies -->
            @forelse ($message->replies as $reply)
                <div class="mb-4">
                    <small class="text-muted">Reply sent on {{ $reply->created_at->timezone('Asia/Dhaka')->format('d M, Y h:i A') }}</small>
                    <div class="p-3 rounded mt-1">
                        <strong>Subject: </strong>{{ $reply->subject }}<br>
                        <strong>Body: </strong>{!! nl2br(e($reply->body)) !!}
                    </div>

                    {{-- filepath: resources/views/backend/messages/view-reply.blade.php --}}
                    {{-- filepath: resources/views/backend/messages/view-reply.blade.php --}}
                    @if(!empty($reply->attachments) && is_array(json_decode($reply->attachments)))
                        <div class="mt-2">
                            <strong>Attachments:</strong>
                            <ul class="list-unstyled mb-0">
                                @foreach(json_decode($reply->attachments) as $file)
                                    <li>
                                        @if(is_string($file))
                                            <a href="{{ asset('storage/' . $file) }}" download class="text-decoration-none">
                                                📎 {{ basename($file) }}
                                            </a>
                                        @elseif(is_object($file) && property_exists($file, 'path'))
                                            <a href="{{ asset('storage/' . $file->path) }}" download class="text-decoration-none">
                                                📎 {{ basename($file->path) }}
                                            </a>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <div class="mt-2 text-muted">
                            <strong>Attachments:</strong> None
                        </div>
                    @endif
                </div>
            @empty
                <p class="text-center text-muted">No replies have been sent yet.</p>
            @endforelse

            <a href="{{ route('admin.show-messages') }}" class="btn btn-secondary btn-sm mt-3">Back to Messages</a>
        </div>
    </div>

</div>
@endsection
