@extends('backend.master')

@section('title')
    Edit Plan
@endsection

@section('content')
    <div class="main-container container-fluid">
                    
        <!-- PAGE-HEADER -->
        <div class="page-header">
            <div>
                <h1 class="page-title">Plans</h1>
            </div>
            <div class="ms-auto pageheader-btn">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Plans</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit plan</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- ROW -->
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h3 class="card-title">Edit Your Plans</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.update-plan', ['id' => $plan]) }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            <div class="form-row">
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-3">
                                    <label for="service-select">Select Service</label>
                                    <select name="service" class="form-control form-select @error('service') is-invalid @enderror" id="service-select" data-bs-placeholder="Select Service">
                                        <option label="Choose Service" selected disabled></option>
                                        @foreach ($services as $service) 
                                            <option value="{{ $service->id }}" {{ old('service', $plan->service_id) == $service->id ? 'selected' : '' }}>
                                                {{ $service->serviceName }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('service')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-3">
                                    <label for="plan-name">Plan Name</label>
                                    <input name="planName" type="text" class="form-control @error('planName') is-invalid @enderror" value="{{ $plan->planName }}" id="plan-name" required>
                                    {{-- <div class="invalid-feedback">Please provide a valid plan name.</div> --}}
                                    @error('planName')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-3">
                                    <label for="plan-price">Plan Price</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text bg-primary-transparent text-primary">$</span>
                                        <input name="planPrice" aria-label="Amount (to the nearest dollar)" class="form-control @error('planPrice') is-invalid @enderror" value="{{ $plan->planPrice }}" id="plan-price" type="number">
                                        <span class="input-group-text bg-primary-transparent text-primary">.00</span>
                                        {{-- <div class="invalid-feedback">Please provide a valid price.</div> --}}
                                        @error('planPrice')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-3">
                                    <label for="plan-duration">Duration</label>
                                    <div class="input-group mb-3">
                                        <input name="planDuration" aria-describedby="basic-addon1" id="plan-duration" aria-label="Username" class="form-control @error('planDuration') is-invalid @enderror" value="{{ $plan->planDuration }}" type="number" required>
                                        <span class="input-group-text bg-primary-transparent text-primary" id="basic-addon1">Days</span>
                                        {{-- <div class="invalid-feedback">Please provide a valid plan duration.</div> --}}
                                        @error('planDuration')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-3">
                                    <label>Plan Features</label>
                                    <div id="plan-features-container">
                                        @php
                                            // Use old input if validation fails, otherwise use features from DB
                                            $features = old('planFeatures', $features ?? ['']);
                                        @endphp
                                        @foreach($features as $index => $feature)
                                            <div class="input-group mb-2">
                                                <input name="planFeatures[]" type="text" class="form-control plan-feature-input @error('planFeatures.' . $index) is-invalid @enderror" value="{{ $feature }}" required>
                                                <button type="button" class="btn btn-danger remove-feature" style="{{ count($features) === 1 ? 'display: none;' : '' }}">Remove</button>
                                                @error('planFeatures.' . $index)
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        @endforeach
                                    </div>
                                    <button type="button" class="btn btn-success btn-sm" id="add-feature"><i class="ion ion-plus"></i> Add more plan features</button>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-3">
                                    <label for="plan-description">Plan Description</label>
                                    <textarea name="planDescription" id="summernote" class="form-control @error('planDescription') is-invalid @enderror">{{ $plan->planDescription }}</textarea>
                                    @error('planDescription')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <button class="btn btn-primary mt-3" type="submit">Update Plan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ROW CLOSED -->
    </div>
@endsection