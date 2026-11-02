@extends('backend.master')

@section('title')
    Edit Testimonial
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
                    <li class="breadcrumb-item active" aria-current="page">Edit Testimonial</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- ROW -->
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h3 class="card-title">Edit Testimonials</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.update-testimonial', ['id' => $testimonial]) }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            <div class="form-row">
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-3">
                                    <label for="date">Date</label>
                                    <div class="input-group">
                                        <div class="input-group-text bg-primary-transparent text-primary">
                                            <i class="fe fe-calendar text-20"></i>
                                        </div>
                                        <input name="date" class="form-control fc-datepicker @error('date') is-invalid @enderror" id="date" placeholder="DD/MM/YYYY" value="{{ old('date', \Carbon\Carbon::parse($testimonial->date)->format('d/m/Y')) }}" type="text">
                                        @error('date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name', $testimonial->name) }}" required>
                                    {{-- <div class="valid-feedback">Looks good!</div> --}}
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-3">
                                    <label for="designation" class="form-label">Designation</label>
                                    <input name="designation" type="text" class="form-control @error('designation') is-invalid @enderror" id="designation" value="{{ old('designation', $testimonial->designation) }}" required>
                                    {{-- <div class="valid-feedback">Looks good!</div> --}}
                                    @error('designation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-3">
                                    <label for="rating">Rating</label>
                                    <select name="rating" class="form-control form-select @error('rating') is-invalid @enderror" id="rating" data-bs-placeholder="Rating">
                                        <option label="Choose Rating" {{ old('rating') ? '' : 'selected' }} disabled></option>
                                        <option value="1" {{ old('rating', $testimonial->rating) == 1 ? 'selected' : '' }}>1 star</option>
                                        <option value="2" {{ old('rating', $testimonial->rating) == 2 ? 'selected' : '' }}>2 star</option>
                                        <option value="3" {{ old('rating', $testimonial->rating) == 3 ? 'selected' : '' }}>3 star</option>
                                        <option value="4" {{ old('rating', $testimonial->rating) == 4 ? 'selected' : '' }}>4 star</option>
                                        <option value="5" {{ old('rating', $testimonial->rating) == 5 ? 'selected' : '' }}>5 star</option>
                                    </select>
                                    {{-- <div class="invalid-feedback">Please choose your rating.</div> --}}
                                    @error('rating')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-3">
                                    <label for="testimonial">Testimonial</label>
                                    <textarea name="testimonial" id="" rows="10" class="form-control @error('testimonial') is-invalid @enderror">{{ old('testimonial', $testimonial->testimonial) }}</textarea>
                                    @error('testimonial')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <button class="btn btn-primary mt-2" type="submit">Update Testimonial</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ROW CLOSED -->

        
    </div>
@endsection