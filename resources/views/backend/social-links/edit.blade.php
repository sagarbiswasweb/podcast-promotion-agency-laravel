@extends('backend.master')

@section('title')
    Edit Social Links 
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
                    <li class="breadcrumb-item active" aria-current="page">Edit Social Links</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- ROW -->
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h3 class="card-title">Edit Social Links</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.update-social-link', ['id' => $socialLink]) }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            <div class="form-row">
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-3">
                                    <label for="facebook">Facebook link</label>
                                    <input name="facebookLink" type="text" class="form-control @error('facebookLink') is-invalid @enderror" value="{{ old('facebookLink', $socialLink->facebookLink) }}" id="facebook" required>
                                    {{-- <div class="invalid-feedback">Please provide a valid link.</div> --}}
                                    @error('facebookLink')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-3">
                                    <label for="instagram">Instagram link</label>
                                    <input name="instagramLink" type="text" class="form-control @error('instagramLink') is-invalid @enderror" value="{{ old('instagramLink', $socialLink->instagramLink) }}" id="instagram" required>
                                    {{-- <div class="invalid-feedback">Please provide a valid link.</div> --}}
                                    @error('instagramLink')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-3">
                                    <label for="twitter">Twitter link</label>
                                    <input name="twitterLink" type="text" class="form-control @error('twitterLink') is-invalid @enderror" value="{{ old('twitterLink', $socialLink->twitterLink) }}" id="twitter" required>
                                    {{-- <div class="invalid-feedback">Please provide a valid link.</div> --}}
                                    @error('twitterLink')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-3">
                                    <label for="youtube">Youtube link</label>
                                    <input name="youtubeLink" type="text" class="form-control @error('youtubeLink') is-invalid @enderror" value="{{ old('youtubeLink', $socialLink->youtubeLink) }}" id="youtube" required>
                                    {{-- <div class="invalid-feedback">Please provide a valid link.</div> --}}
                                    @error('youtubeLink')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-3">
                                    <label for="linkedin">Linkedin link</label>
                                    <input name="linkedinLink" type="text" class="form-control @error('linkedinLink') is-invalid @enderror" value="{{ old('linkedinLink', $socialLink->linkedinLink) }}" id="linkedin" required>
                                    {{-- <div class="invalid-feedback">Please provide a valid link.</div> --}}
                                    @error('linkedinLink')
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