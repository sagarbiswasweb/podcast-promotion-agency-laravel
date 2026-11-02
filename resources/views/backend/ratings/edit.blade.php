@extends('backend.master')

@section('title')
    Edit Plan Review & Rating 
@endsection

@section('content')
    <div class="main-container container-fluid">
                    
        <!-- PAGE-HEADER -->
        <div class="page-header">
            <div>
                <h1 class="page-title">Review & Rating</h1>
            </div>
            <div class="ms-auto pageheader-btn">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Services</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Review & Rating</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- ROW -->
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h3 class="card-title">Edit Plan Review & Rating</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.update-rating', ['id' => $rating]) }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            <div class="form-row">
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-3">
                                    <label for="service-select">Select Service</label>
                                    <select name="service" class="form-control form-select @error('service') is-invalid @enderror" id="service-select" data-bs-placeholder="Select Service">
                                        <option label="Choose Service" selected disabled></option>
                                        {{-- service data in select  --}}
                                        @foreach ($services as $service) 
                                            {{-- <option value="{{ $service->id }}" {{ old('service', $service->id) == $service->id ? 'selected' : '' }}>{{ $service->serviceName }}</option> --}}
                                            <option value="{{ $service->id }}" {{ old('service', $rating->plan->service->id ?? '') == $service->id ? 'selected' : '' }}>
                                                {{ $service->serviceName }}
                                            </option>
                                        @endforeach
                                    </select>
                                    {{-- <div class="invalid-feedback">Please select a valid service.</div> --}}
                                    @error('service')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-3">
                                    <label for="plan-select">Select Plan</label>
                                    <select name="plan" class="form-control form-select @error('plan') is-invalid @enderror" id="plan-select" data-bs-placeholder="Select Plan">
                                        <option label="Choose Plan" selected disabled></option>
                                        {{-- Plan options will be loaded here --}}
                                    </select>
                                    {{-- <div class="invalid-feedback">Please select a plan.</div> --}}
                                    @error('plan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-3">
                                    <label for="client-name">Client Name</label>
                                    <input name="clientName" type="text" class="form-control @error('clientName') is-invalid @enderror" value="{{ old('clientName', $rating->clientName) }}" id="client-name" required>
                                    {{-- <div class="invalid-feedback">Please provide client name.</div> --}}
                                    @error('clientName')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-3">
                                    <label for="plan-rating">Rating</label>
                                    <select name="planRating" class="form-control form-select @error('planRating') is-invalid @enderror" id="plan-rating" data-bs-placeholder="Rating">
                                        <option label="Choose Rating" {{ old('planRating') ? '' : 'selected' }} disabled></option>
                                        <option value="1" {{ old('planRating', $rating->planRating) == 1 ? 'selected' : '' }}>1 star</option>
                                        <option value="2" {{ old('planRating', $rating->planRating) == 2 ? 'selected' : '' }}>2 star</option>
                                        <option value="3" {{ old('planRating', $rating->planRating) == 3 ? 'selected' : '' }}>3 star</option>
                                        <option value="4" {{ old('planRating', $rating->planRating) == 4 ? 'selected' : '' }}>4 star</option>
                                        <option value="5" {{ old('planRating', $rating->planRating) == 5 ? 'selected' : '' }}>5 star</option>
                                    </select>
                                    {{-- <div class="invalid-feedback">Please choose your rating.</div> --}}
                                    @error('planRating')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-3">
                                    <label for="client-review">Client Review</label>
                                    <textarea name="clientReview" id="" rows="10" class="form-control @error('clientReview') is-invalid @enderror">{{ old('clientReview', $rating->clientReview) }}</textarea>
                                    @error('clientReview')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <button class="btn btn-primary mt-3" type="submit">Change Updates</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ROW CLOSED -->

        
    </div>

    {{-- show related plans in the select box when service is selected  --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const serviceSelect = document.getElementById('service-select');
            const planSelect = document.getElementById('plan-select');

            // On service change
            serviceSelect.addEventListener('change', function () {
                const serviceId = this.value;
                planSelect.innerHTML = '<option label="Loading..." selected disabled></option>';

                fetch(`{{ url('admin/get-plans-by-service') }}/${serviceId}`)
                    .then(response => response.json())
                    .then(plans => {
                        let options = '<option label="Choose Plan" selected disabled></option>';
                        plans.forEach(plan => {
                            options += `<option value="${plan.id}">${plan.planName}</option>`;
                        });
                        planSelect.innerHTML = options;
                    })
                    .catch(() => {
                        planSelect.innerHTML = '<option label="No plans found" selected disabled></option>';
                    });
            });

            // On page load, fetch plans for the selected service and select the correct plan
            @php
                $selectedService = old('service', $rating->plan->service->id ?? '');
                $selectedPlan = old('plan', $rating->plan_id ?? '');
            @endphp
            @if($selectedService)
                fetch(`{{ url('admin/get-plans-by-service') }}/{{ $selectedService }}`)
                    .then(response => response.json())
                    .then(plans => {
                        let options = '<option label="Choose Plan" selected disabled></option>';
                        let selectedPlan = '{{ $selectedPlan }}';
                        plans.forEach(plan => {
                            let selected = selectedPlan == plan.id ? 'selected' : '';
                            options += `<option value="${plan.id}" ${selected}>${plan.planName}</option>`;
                        });
                        planSelect.innerHTML = options;
                    })
                    .catch(() => {
                        planSelect.innerHTML = '<option label="No plans found" selected disabled></option>';
                    });
            @endif
        });
    </script>
    
@endsection