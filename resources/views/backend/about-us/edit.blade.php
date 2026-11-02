@extends('backend.master')

@section('title')
    Add About Us 
@endsection

@section('content')
    <div class="main-container container-fluid">
               
        <!-- PAGE-HEADER -->
        <div class="page-header">
            <div>
                <h1 class="page-title">Others</h1>
            </div>
            <div class="ms-auto pageheader-btn">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Others</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add About Us</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- ROW -->
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h3 class="card-title">Add About Us</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.update-about-us', ['id' => $aboutUs]) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                            @csrf
                            <div class="form-row">
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-3">
                                    <label for="about-us-image" class="form-label">About us image</label>
                                    <input name="aboutUsImage" type="file" class="dropify @error('aboutUsImage') is-invalid @enderror" accept="image/*"  data-default-file="{{ asset($aboutUs->aboutUsImage) }}" id="about-us-image" data-height="200" />
                                    @error('aboutUsImage')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-3">
                                    <label for="about-us">About us details</label>
                                    <textarea name="aboutUsDetails" id="summernote" class="form-control @error('aboutUsDetails') is-invalid @enderror">{{ old('aboutUsDetails', $aboutUs->aboutUsDetails) }}</textarea>
                                    @error('aboutUsDetails')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <button class="btn btn-primary mt-3" type="submit">Update About Us</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ROW CLOSED -->

        
    </div>
@endsection