@extends('backend.master')

@section('title')
    Messages
@endsection

@section('content')
<style>
    .bg-unseen-warning {
        background-color: #fff3ca !important; /* Light mode default */
        color: #000 !important;
    }

    @media (prefers-color-scheme: dark) {
        .bg-unseen-warning {
            background-color: #4a3e1e !important; /* Darker yellow-brown shade */
            color: #fff !important;
        }
    }
</style>
    <div class="main-container container-fluid">
                 
        <!-- PAGE-HEADER -->
        <div class="page-header">
            <div>
                <h1 class="page-title">messages</h1>
            </div>
            <div class="ms-auto pageheader-btn">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">mesages</a></li>
                    <li class="breadcrumb-item active" aria-current="page">All User Messages</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- Row -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h3 class="card-title">All User Messages</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-nowrap border-bottom w-100" id="responsive-datatable">
                                <thead>
                                    <tr>
                                        <th class="wd-15p border-bottom-0">SL</th>
                                        <th class="wd-15p border-bottom-0">Time</th>
                                        <th class="wd-20p border-bottom-0">Name</th>
                                        <th class="wd-15p border-bottom-0">Email</th>
                                        <th class="wd-15p border-bottom-0">Phone</th>
                                        <th class="wd-15p border-bottom-0">Address</th>
                                        <th class="wd-10p border-bottom-0">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($messages as $message)
                                        <tr class="{{ $message->seen ? '' : 'bg-unseen-warning' }}">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $message->created_at->timezone('Asia/Dhaka')->format('d M, Y h:i A') }}</td>
                                            <td>{{ $message->senderName }}</td>
                                            <td>{{ $message->senderEmail }}</td>
                                            <td>{{ $message->senderPhone }}</td>
                                            <td>{{ Str::limit(strip_tags($message->senderMessage), 30, '...') }}</td>
                                            <td>
                                                <a href="{{ route('admin.view-message', ['id' => $message->id]) }}" class="btn btn-primary" data-bs-toggle="tooltip" title="show"><i class="fa fa-eye"></i></a>
                                                {{-- <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ $message->senderEmail }}&su=Reply to your message&body=Hi {{ $message->senderName }},%0D%0A%0D%0A" target="_blank" class="btn btn-secondary" data-bs-toggle="tooltip" title="Send Mail"><i class="fa fa-envelope"></i></a> --}}
                                                <a href="{{ route('messages.replyForm', $message->id) }}" class="btn btn-secondary" data-bs-toggle="tooltip" title="Send Mail">
                                                    <i class="fa fa-envelope"></i>
                                                </a>
                                                @if($message->replies->count() > 0)
                                                    <a href="{{ route('messages.viewReply', $message->id) }}" class="btn btn-info" data-bs-toggle="tooltip" title="View Reply">
                                                        <i class="fa fa-reply"></i>
                                                    </a>
                                                @endif

                                                <form action="{{ route('message.delete', ['id' => $message->id]) }}" method="POST" onsubmit="return confirm('Confirm deleting the message?');" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" data-bs-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->

    </div>
@endsection