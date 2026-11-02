@extends('backend.master')

@section('title')
    Create Custom Invoice
@endsection

@section('content')
    <div class="main-container container-fluid">
                    
        <!-- PAGE-HEADER -->
        <div class="page-header">
            <div>
                <h1 class="page-title">Custom Invoice</h1>
            </div>
            <div class="ms-auto pageheader-btn">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Custom Invoice</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->

        @if(session('invoice_id'))
            <div class="alert alert-success">
                Invoice created successfully! 
                <a href="{{ route('custom-invoice.download', session('invoice_id')) }}" target="_blank">Download PDF</a>
            </div>
        @endif


        <!-- ROW -->
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h3 class="card-title">Create Custom Invoice</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.store-custom-invoice') }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            <div>
                                <h4>Service Details</h4>
                                <hr>
                                <div class="form-row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-3">
                                        <label for="service-name">Service Name</label>
                                        <input name="serviceName" type="text" class="form-control @error('serviceName') is-invalid @enderror" value="{{ old('serviceName') }}" id="service-name" required>
                                        @error('serviceName')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-3">
                                        <label for="price">Price</label>
                                        <input name="price" type="number" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" id="price" required>
                                        @error('price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-3">
                                        <label for="duration">Duration</label>
                                        <input name="duration" type="text" class="form-control @error('duration') is-invalid @enderror" value="{{ old('duration') }}" id="duration" required>
                                        @error('duration')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-3">
                                        <label for="features">Features</label>
                                        <textarea name="features" type="text" class="form-control @error('features') is-invalid @enderror" value="{{ old('features') }}" id="country" required></textarea>
                                        @error('features')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-3">
                                        <label for="link">Link</label>
                                        <input name="link" type="url" class="form-control @error('link') is-invalid @enderror" value="{{ old('link') }}" id="link" required>
                                        @error('link')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-3">
                                        <label for="country">Targated Country</label>
                                        <textarea name="country" type="text" class="form-control @error('country') is-invalid @enderror" value="{{ old('country') }}" id="country" required></textarea>
                                        @error('country')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-5">
                                <h4>Client Details</h4>
                                <hr>
                                <div class="form-row">
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-3">
                                        <label for="client-name">Client Name</label>
                                        <input name="clientName" type="text" class="form-control @error('clientName') is-invalid @enderror" value="{{ old('clientName') }}" id="client-name" required>
                                        @error('clientName')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-3">
                                        <label for="client-email">Client Email</label>
                                        <input name="clientEmail" type="email" class="form-control @error('clientEmail') is-invalid @enderror" value="{{ old('clientEmail') }}" id="client-email" required>
                                        @error('clientEmail')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-3">
                                        <label for="client-phone">Client Phone</label>
                                        <input name="clientPhone" type="text" class="form-control @error('clientPhone') is-invalid @enderror" value="{{ old('clientPhone') }}" id="client-phone" required>
                                        @error('clientPhone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mt-5">
                                <h4>Payment Details</h4>
                                <hr>
                                <div class="form-row">
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-3">
                                        <label for="payment-method">Payment Method</label>
                                        <input name="paymentMethod" type="text" class="form-control @error('paymentMethod') is-invalid @enderror" value="{{ old('paymentMethod') }}" id="payment-method" required>
                                        @error('paymentMethod')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-3">
                                        <label for="transaction-id">Transaction Id</label>
                                        <input name="transactionId" type="text" class="form-control @error('transactionId') is-invalid @enderror" value="{{ old('transactionId') }}" id="transaction-id" required>
                                        @error('transactionId')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-3">
                                        <label for="amount-paid">Amount Paid</label>
                                        <input name="amountPaid" type="integer" class="form-control @error('amountPaid') is-invalid @enderror" value="{{ old('amountPaid') }}" id="amount-paid" required>
                                        @error('amountPaid')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-3">
                                        <label for="tips">Tips</label>
                                        <input name="tips" type="integer" class="form-control @error('tips') is-invalid @enderror" value="{{ old('tips') }}" id="tips" required>
                                        @error('tips')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <button class="btn btn-primary mt-3" type="submit">Create Invoice</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ROW CLOSED -->
    </div>
    
@endsection