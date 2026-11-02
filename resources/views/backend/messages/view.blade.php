@extends('backend.master')

@section('title')
    View Messages
@endsection

@section('content')
    <div class="main-container container-fluid">
                  
        <!-- PAGE-HEADER -->
        <div class="page-header">
            <div>
                <h1 class="page-title">Team</h1>
            </div>
            <div class="ms-auto pageheader-btn">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Messages</a></li>
                    <li class="breadcrumb-item active" aria-current="page">View Messages</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- Row -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h3 class="card-title">View Messages</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-wrap text-md-nowrap table-bordered">
                                <tbody>
                                    <tr>
                                        <td>Date Time</td>
                                        <td>{{ $message->created_at->timezone('Asia/Dhaka')->format('d M, Y h:i A') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Sender Name</td>
                                        <td>{{ $message->senderName }}</td>
                                    </tr>
                                    <tr>
                                        <td>Sender Email</td>
                                        <td>{{ $message->senderEmail }}</td>
                                    </tr>
                                    <tr>
                                        <td>Sender Phone</td>
                                        <td>{{ $message->senderPhone }}</td>
                                    </tr>
                                    <tr>
                                        <td>Message</td>
                                        <td>{!! $message->senderMessage !!}</td>
                                    </tr>
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