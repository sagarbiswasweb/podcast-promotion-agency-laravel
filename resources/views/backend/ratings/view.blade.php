@extends('backend.master')

@section('title')
    View Rating & Review
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
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Services</a></li>
                    <li class="breadcrumb-item active" aria-current="page">View Rating & Review</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- Row -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h3 class="card-title">View Rating & Review</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-wrap text-md-nowrap table-bordered">
                                <tbody>
                                    <tr>
                                        <td>Service</td>
                                        <td>{{ $rating->plan->service->serviceName }}</td>
                                    </tr>
                                    <tr>
                                        <td>Plan</td>
                                        <td>{{ $rating->plan->planName }}</td>
                                    </tr>
                                    <tr>
                                        <td>Client Name</td>
                                        <td>{{ $rating->clientName }}</td>
                                    </tr>
                                    <tr>
                                        <td>Plan Rating</td>
                                        <td>{{ $rating->planRating }}<span> Star</span></td>
                                    </tr>
                                    <tr>
                                        <td>Client Review</td>
                                        <td>{{ $rating->clientReview }}</td>
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