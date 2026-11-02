@extends('backend.master')

@section('title')
    View Team Member
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
                    <li class="breadcrumb-item active" aria-current="page">View Team Member</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- Row -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h3 class="card-title">View Team Member</h3>
                    </div>
                    <div class="card-body">
                        <div class="col-md-6 mb-3 ps-0">
                            <img src="{{ asset($team->memberImage) }}" alt="image" class="img-fluid" style="width: 150px; height: 150px; border-radius: 5%;">
                        </div>
                        <div class="table-responsive">
                            <table class="table text-wrap text-md-nowrap table-bordered">
                                <tbody>
                                    {{-- <tr>
                                        <td><img src="{{ asset($team->memberImage) }}" alt="image" class="img-fluid" style="width: 150px; height: 150px; border-radius: 5%;"></td>
                                    </tr> --}}
                                    <tr>
                                        <td>Name</td>
                                        <td>{{ $team->memberName }}</td>
                                    </tr>
                                    <tr>
                                        <td>Position</td>
                                        <td>{{ $team->position == 1 ? 'Team Lead' : 'Team Member' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Service</td>
                                        <td>{{ $team->plan->service->serviceName }}</td>
                                    </tr>
                                    <tr>
                                        <td>Plan</td>
                                        <td>{{ $team->plan->planName }}</td>
                                    </tr>
                                    <tr>
                                        <td>Rating</td>
                                        <td>{{ $team->memberRating }}<span> Star</span></td>
                                    </tr>
                                    <tr>
                                        <td>Total Review</td>
                                        <td>{{ $team->totalReview }}<span> Reviews</span></td>
                                    </tr>
                                    <tr>
                                        <td>Portfolio</td>
                                        <td><a href="{{ $team->portfolioLink }}" target="_blank">{{ $team->portfolioLink }}</a></td>
                                    </tr>
                                    <tr>
                                        <td>Review</td>
                                        <td>{!! $team->memberDescription !!}</td>
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