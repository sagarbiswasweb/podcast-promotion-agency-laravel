@extends('backend.master')

@section('title')
    View Plan
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
                    <li class="breadcrumb-item active" aria-current="page">View Plan</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- Row -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h3 class="card-title">View Plan</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-wrap text-md-nowrap table-bordered">
                                <tbody>
                                    <tr>
                                        <td>Service</td>
                                        <td>{{ $plan->service->serviceName }}</td>
                                    </tr>
                                    <tr>
                                        <td>Plan</td>
                                        <td>{{ $plan->planName }}</td>
                                    </tr>
                                    <tr>
                                        <td>Price</td>
                                        <td><span>$ </span>{{ $plan->planPrice }}</td>
                                    </tr>
                                    <tr>
                                        <td>Duration</td>
                                        <td>{{ $plan->planDuration }}<span> Days</span></td>
                                    </tr>
                                    <tr>
                                        <td>Features</td>
                                        <td>
                                            {{-- json decoded 'planFeatures' in list  --}}
                                            <ul>
                                                @foreach (json_decode($plan->planFeatures, true) as $feature)
                                                    <li>{{ $feature }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Description</td>
                                        <td>{!! $plan->planDescription !!}</td>
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