@extends('backend.master')

@section('title')
    View Contact Info
@endsection

@section('content')
    <div class="main-container container-fluid">
                  
        <!-- PAGE-HEADER -->
        <div class="page-header">
            <div>
                <h1 class="page-title">Contact Info</h1>
            </div>
            <div class="ms-auto pageheader-btn">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Others</a></li>
                    <li class="breadcrumb-item active" aria-current="page">View Contact Info</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- Row -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h3 class="card-title">View Contact Info</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-wrap text-md-nowrap table-bordered">
                                <tbody>
                                    <tr>
                                        <td>Email</td>
                                        <td>{{ $contactInfo->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Phone</td>
                                        <td>{{ $contactInfo->phone }}</td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td>{!! $contactInfo->addressDetails !!}</td>
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