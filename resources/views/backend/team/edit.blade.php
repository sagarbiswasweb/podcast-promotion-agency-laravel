@extends('backend.master')

@section('title')
    Edit Team Member
@endsection

@section('content')
    <div class="main-container container-fluid">
                    
        <!-- PAGE-HEADER -->
        <div class="page-header">
            <div>
                <h1 class="page-title">Team</h1>
            </div>
            <div class="ms-auto pageheader-btn">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Services</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Team Member</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- ROW -->
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h3 class="card-title">Edit Team Member</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.update-team', ['id' => $team]) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                            @csrf
                            <div class="form-row">
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-3">
                                    <label for="service-select">Select Service</label>
                                    <select name="service" class="form-control form-select @error('service') is-invalid @enderror" id="service-select" data-bs-placeholder="Select Service">
                                        <option label="Choose Service" selected disabled></option>
                                        {{-- service data in select  --}}
                                        @foreach ($services as $service) 
                                            {{-- <option value="{{ $service->id }}" {{ old('service', $service->id) == $service->id ? 'selected' : '' }}>{{ $service->serviceName }}</option> --}}
                                            <option value="{{ $service->id }}" {{ old('service', $team->plan->service->id ?? '') == $service->id ? 'selected' : '' }}>
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
                                    <label for="position">Select Position</label>
                                    <select name="position" class="form-control form-select @error('position') is-invalid @enderror" id="position" data-bs-placeholder="Select Plan">
                                        <option label="Choose Position" {{ old('position') ? '' : 'selected' }} disabled></option>
                                        <option value="1" {{ old('position', $team->position) == 1 ? 'selected' : '' }}>Team Lead</option>
                                        <option value="2" {{ old('position', $team->position) == 2 ? 'selected' : '' }}>Team Member</option>
                                    </select>
                                    {{-- <div class="invalid-feedback">Please select position.</div> --}}
                                    @error('position')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-3">
                                    <label for="member-name">Name</label>
                                    <input name="memberName" type="text" class="form-control @error('memberName') is-invalid @enderror" id="member-name" value="{{ old('memberName', $team->memberName) }}" required>
                                    {{-- <div class="invalid-feedback">Please provide name.</div> --}}
                                    @error('memberName')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-3">
                                    <label for="member-image" class="form-label">Member Image</label>
                                    <input name="memberImage" type="file" class="dropify @error('memberImage') is-invalid @enderror" accept="image/*" data-default-file="{{ asset($team->memberImage) }}" id="member-image" data-height="200" />
                                    @error('memberImage')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-3">
                                    <label for="member-rating">Member Rating</label>
                                    <select name="memberRating" class="form-control form-select @error('memberRating') is-invalid @enderror" id="member-rating" data-bs-placeholder="Rating">
                                        <option label="Choose Member Rating" {{ old('memberRating') ? '' : 'selected' }} disabled></option>
                                        <option value="1" {{ old('memberRating', $team->memberRating) == 1 ? 'selected' : '' }}>1 star</option>
                                        <option value="2" {{ old('memberRating', $team->memberRating) == 2 ? 'selected' : '' }}>2 star</option>
                                        <option value="3" {{ old('memberRating', $team->memberRating) == 3 ? 'selected' : '' }}>3 star</option>
                                        <option value="4" {{ old('memberRating', $team->memberRating) == 4 ? 'selected' : '' }}>4 star</option>
                                        <option value="5" {{ old('memberRating', $team->memberRating) == 5 ? 'selected' : '' }}>5 star</option>
                                    </select>
                                    {{-- <div class="invalid-feedback">Please choose your member rating.</div> --}}
                                    @error('memberRating')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-3">
                                    <label for="total-review">Total Review (In Number)</label>
                                    <input name="totalReview" type="number" class="form-control @error('totalReview') is-invalid @enderror" id="total-review" value="{{ old('totalReview', $team->totalReview) }}" required>
                                    {{-- <div class="invalid-feedback">Please provide total review in number.</div> --}}
                                    @error('totalReview')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-3">
                                    <label for="portfolio-link">Portfolio Link</label>
                                    <input name="portfolioLink" type="text" class="form-control @error('portfolioLink') is-invalid @enderror" id="portfolio-link" value="{{ old('portfolioLink', $team->portfolioLink) }}" required>
                                    {{-- <div class="invalid-feedback">Please provide valid link.</div> --}}
                                    @error('portfolioLink')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-3">
                                    <label for="member-description">Description</label>
                                    <textarea name="memberDescription" id="summernote" class="form-control @error('memberDescription') is-invalid @enderror">{{ old('memberDescription', $team->memberDescription) }}</textarea>
                                    @error('memberDescription')
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
                $selectedService = old('service', $team->plan->service->id ?? '');
                $selectedPlan = old('plan', $team->plan_id ?? '');
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