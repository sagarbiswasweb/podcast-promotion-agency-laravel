@extends('backend.master')

@section('title', 'Email Details')

@section('content')
<div class="main-container container-fluid">

    <!-- PAGE HEADER -->
    <div class="page-header mb-4 d-flex align-items-center justify-content-between">
        <div>
            <h1 class="page-title">Email Details</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb p-0 bg-transparent mb-0">
                    <li class="breadcrumb-item">Custom Emails</li>
                    <li class="breadcrumb-item active" aria-current="page">Inbox</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ route('inbox.index') }}" class="btn btn-secondary btn-sm">← Back to Inbox</a>
        </div>
    </div>

    <!-- Email Card -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card p-4">
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-start flex-wrap">
                        <h4 class="mb-2">{{ $subject }}</h4>
                        <small class="text-muted ms-2">
                            {{ $dateBD }}
                        </small>
                    </div>
                    <div class="mt-2">
                        <div><strong>From:</strong> {{ $from }}</div>
                        <div><strong>To:</strong> {{ $to }}</div>
                    </div>
                </div>

                <hr>

                <div class="mt-3">
                    <strong>Body:</strong>
                    <div class="mt-2 p-3">
                        @if(!empty($isHtml) && $isHtml)
                            {!! $body !!}
                        @else
                            {!! nl2br(e($body)) !!}
                        @endif
                    </div>
                </div>

                @if(!empty($attachments))
                    <div class="mt-3">
                        <strong>Attachments:</strong>
                        <ul class="mt-2">
                            @foreach($attachments as $index => $att)
                                <li>
                                    <a href="{{ route('inbox.download', [$id, $index]) }}">
                                        📎 {{ $att['filename'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mt-4 d-flex gap-2">
                    <a class="btn btn-outline-primary btn-sm" href="{{ route('inbox.reply.form', $id) }}">Reply</a>

                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('inbox.index') }}">Back to Inbox</a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
