@extends('backend.master')

@section('title')
    View Social Links
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
                    <li class="breadcrumb-item active" aria-current="page">View Social Links</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- Row -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h3 class="card-title">View Social Links</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-wrap text-md-nowrap table-bordered">
                                <tbody>
                                    <tr>
                                        <td>Facebook</td>
                                        <td>
                                            <a href="{{ $socialLink->facebookLink }}" target="_blank">{{ $socialLink->facebookLink }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Instagram</td>
                                        <td>
                                            <a href="{{ $socialLink->instagramLink }}" target="_blank">{{ $socialLink->instagramLink }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Twitter</td>
                                        <td>
                                            <a href="{{ $socialLink->twitterLink }}" target="_blank">{{ $socialLink->twitterLink }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Youtube</td>
                                        <td>
                                            <a href="{{ $socialLink->youtubeLink }}" target="_blank">{{ $socialLink->youtubeLink }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Linkedin</td>
                                        <td>
                                            <a href="{{ $socialLink->linkedinLink }}" target="_blank">{{ $socialLink->linkedinLink }}</a>
                                        </td>
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