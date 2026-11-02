@extends('backend.master')

@section('title', 'Email Details')

@section('content')
<div class="main-container container-fluid">

    <!-- PAGE HEADER -->
    <div class="page-header mb-4">
        <h1 class="page-title">Email details of {{ $customEmail->to }}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb p-0 bg-transparent">
                <li class="breadcrumb-item">Custom Email</li>
                <li class="breadcrumb-item active" aria-current="page">Email Details</li>
            </ol>
        </nav>
    </div>

    <!-- Conversation Thread -->
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card p-5">
                <div class="mb-4">
                    <small class="text-muted">Reply sent on {{ $customEmail->created_at->timezone('Asia/Dhaka')->format('d M, Y h:i A') }}</small>
                    <div class="p-3 rounded mt-1">
                        <strong>Receipent: </strong>{{ $customEmail->to }}<br>
                        <strong>Subject: </strong>{{ $customEmail->subject }}<br>
                        <strong>Body: </strong>{!! nl2br(e($customEmail->message)) !!}
                    </div>

                    @if(!empty($customEmail->attachments) && is_array(json_decode($customEmail->attachments)))
                        <div class="mt-2">
                            <strong>Attachments:</strong>
                            <ul class="list-unstyled mb-0">
                                @foreach(json_decode($customEmail->attachments) as $file)
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
            </div>

            <a href="{{ route('admin.view-custom-email') }}" class="btn btn-secondary btn-sm mt-3">Back</a>
        </div>
    </div>

</div>
@endsection
