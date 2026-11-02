@extends('backend.master')

@section('title')
    Custom Invoice Details
@endsection

@section('content')
    <div class="main-container container-fluid">
                  
        <!-- PAGE-HEADER -->
        <div class="page-header">
            <div>
                <h1 class="page-title">Custom Invoice Details</h1>
            </div>
            <div class="ms-auto pageheader-btn">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Custom Invoice</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Custom Invoice Details</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- Row -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h3 class="card-title">Custom Invoice Details for Client: {{ $customInvoice->clientName }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-wrap text-md-nowrap table-bordered">
                                <tbody>
                                    <tr>
                                        <td>Invoice Id</td>
                                        <td>#{{ $customInvoice->id }}</td>
                                    </tr>
                                    <tr>
                                        <td>Service Name</td>
                                        <td>{{ $customInvoice->serviceName }}</td>
                                    </tr>
                                    <tr>
                                        <td>Price</td>
                                        <td>{{ $customInvoice->price }}</td>
                                    </tr>
                                    <tr>
                                        <td>Duration</td>
                                        <td>{{ $customInvoice->duration }}</td>
                                    </tr>
                                    <tr>
                                        <td>Features</td>
                                        <td>{{ $customInvoice->features }}</td>
                                    </tr>
                                    <tr>
                                        <td>Link</td>
                                        <td><a href="{{ $customInvoice->link }}" target="__blank">{{ $customInvoice->link }}</a></td>
                                    </tr>
                                    <tr>
                                        <td>Targeted Country</td>
                                        <td>{{ $customInvoice->country }}</td>
                                    </tr>
                                    <tr>
                                        <td>Client Name</td>
                                        <td>{{ $customInvoice->clientName }}</td>
                                    </tr>
                                    <tr>
                                        <td>Client Email</td>
                                        <td>{{ $customInvoice->clientEmail }}</td>
                                    </tr>
                                    <tr>
                                        <td>Client Phone</td>
                                        <td>{{ $customInvoice->clientPhone }}</td>
                                    </tr>
                                    <tr>
                                        <td>Payment Method</td>
                                        <td>{{ $customInvoice->paymentMethod }}</td>
                                    </tr>
                                    <tr>
                                        <td>Transaction Id</td>
                                        <td>{{ $customInvoice->transactionId }}</td>
                                    </tr>
                                    <tr>
                                        <td>Amount Paid</td>
                                        <td>{{ $customInvoice->amountPaid }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tips</td>
                                        <td>{{ $customInvoice->tips }}</td>
                                    </tr>
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