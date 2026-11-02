@extends('backend.master')

@section('title')
    Edit Contact Info 
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
                    <li class="breadcrumb-item active" aria-current="page">Edit Contact Info</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- ROW -->
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h3 class="card-title">Edit Contact Info</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.update-contact-info', ['id' => $contactInfo]) }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            <div class="form-row">
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-3">
                                    <label for="email">Email</label>
                                    <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $contactInfo->email) }}" id="email" required>
                                    {{-- <div class="invalid-feedback">Please provide a valid email address.</div> --}}
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-3">
                                    <label for="phone">Phone</label>
                                    <input name="phone" type="number" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $contactInfo->phone) }}" id="phone" required>
                                    {{-- <div class="invalid-feedback">Please provide a valid phone number.</div> --}}
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-3">
                                    <label for="address">Address</label>
                                    <textarea name="addressDetails" id="summernote" class="form-control @error('addressDetails') is-invalid @enderror">{{ old('addressDetails', $contactInfo->addressDetails) }}</textarea>
                                    @error('addressDetails')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <button class="btn btn-primary mt-3" type="submit">Update Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ROW CLOSED -->
    </div>
@endsection