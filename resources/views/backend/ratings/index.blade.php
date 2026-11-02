@extends('backend.master')

@section('title')
    All Reviews & Ratings 
@endsection

@section('content')
    <div class="main-container container-fluid">
                  
        <!-- PAGE-HEADER -->
        <div class="page-header">
            <div>
                <h1 class="page-title">All Review & Rating</h1>
            </div>
            <div class="ms-auto pageheader-btn">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Services</a></li>
                    <li class="breadcrumb-item active" aria-current="page">All Review & Rating</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- Row -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h3 class="card-title">Review & Rating DataTable</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-nowrap border-bottom w-100" id="responsive-datatable">
                                <thead>
                                    <tr>
                                        <th class="wd-15p border-bottom-0">SL</th>
                                        <th class="wd-15p border-bottom-0">Service name</th>
                                        <th class="wd-15p border-bottom-0">Plan</th>
                                        <th class="wd-15p border-bottom-0">Client Name</th>
                                        <th class="wd-15p border-bottom-0">Client Rating</th>
                                        <th class="wd-15p border-bottom-0">Client Review</th>
                                        <th class="wd-15p border-bottom-0">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ratings as $rating)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $rating->plan->service->serviceName }}</td>
                                            <td>{{ $rating->plan->planName }}</td>
                                            <td>{{ $rating->clientName }}</td>
                                            <td>{{ $rating->planRating }}<span> star</span></td>
                                            <td>{{ Str::limit(strip_tags($rating->clientReview), 30, '...') }}</td>
                                            <td>
                                                <a href="{{ route('admin.view-rating', ['id' => $rating]) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                                <a href="{{ route('admin.edit-rating', ['id' => $rating]) }}" class="btn btn-secondary"><i class="fa fa-edit"></i></a>
                                                {{-- <a href="javascript:void(0)" class="btn btn-danger"><i class="fa fa-trash"></i></a> --}}
                                                <form action="{{ route('admin.delete-rating', ['id' => $rating]) }}" method="POST" onsubmit="return confirm('Confirm deleting {{ $rating->planRating }}star rating from {{ $rating->plan->service->serviceName }}s {{$rating->plan->planName}} plan ?');" style="display:inline;">
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