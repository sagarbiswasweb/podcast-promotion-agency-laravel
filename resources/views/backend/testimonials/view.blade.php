@extends('backend.master')

@section('title')
    View Testimonial
@endsection

@section('content')
    <div class="main-container container-fluid">
                  
        <!-- PAGE-HEADER -->
        <div class="page-header">
            <div>
                <h1 class="page-title">Testimonial</h1>
            </div>
            <div class="ms-auto pageheader-btn">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Others</a></li>
                    <li class="breadcrumb-item active" aria-current="page">View Testimonial</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- Row -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h3 class="card-title">View Testimonial</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-wrap text-md-nowrap table-bordered">
                                <tbody>
                                    <tr>
                                        <td>Date</td>
                                        <td>{{ \Carbon\Carbon::parse($testimonial->date)->format('d F Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Name</td>
                                        <td>{{ $testimonial->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Designation</td>
                                        <td>{{ $testimonial->designation }}</td>
                                    </tr>
                                    <tr>
                                        <td>Rating</td>
                                        <td>{{ $testimonial->rating }}<span> Star</span></td>
                                    </tr>
                                    <tr>
                                        <td>Testimonial</td>
                                        <td>{!! $testimonial->testimonial !!}</td>
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