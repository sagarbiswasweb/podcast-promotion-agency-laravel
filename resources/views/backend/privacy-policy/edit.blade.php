@extends('backend.master')

@section('title')
    Edit Privacy Policy
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
                    <li class="breadcrumb-item active" aria-current="page">Edit privacy policy</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- ROW -->
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h3 class="card-title">Edit Privacy Policy</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.update-privacy-policy', ['id' => $privacyPolicy]) }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            <div class="form-row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-3">
                                    <label for="privacy-policy">Privacy policy</label>
                                    <textarea name="privacyPolicy" id="summernote" class="form-control @error('privacyPolicy') is-invalid @enderror">{{ old('privacyPolicy', $privacyPolicy->privacyPolicy) }}</textarea>
                                    @error('privacyPolicy')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <button class="btn btn-primary mt-3" type="submit">Update Privacy Policy</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ROW CLOSED -->

        
    </div>
@endsection