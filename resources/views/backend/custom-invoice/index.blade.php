@extends('backend.master')

@section('title')
    All Custom Invoices
@endsection

@section('content')
    <div class="main-container container-fluid">                   
        <!-- PAGE-HEADER -->
        <div class="page-header">
            <div>
                <h1 class="page-title">All Custom Invoices</h1>
            </div>
            <div class="ms-auto pageheader-btn">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Custom Invoice</a></li>
                    <li class="breadcrumb-item active" aria-current="page">All Custom Invoices</li>
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

        <!-- Row -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h3 class="card-title">All Custom Invoices</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-nowrap border-bottom w-100" id="responsive-datatable">
                                <thead>
                                    <tr>
                                        <th class="wd-15p border-bottom-0">SL</th>
                                        <th class="wd-15p border-bottom-0">Invoice Id</th>
                                        <th class="wd-15p border-bottom-0">Service name</th>
                                        <th class="wd-20p border-bottom-0">Client Name</th>
                                        <th class="wd-20p border-bottom-0">Sub Total</th>
                                        <th class="wd-20p border-bottom-0">Due</th>
                                        <th class="wd-15p border-bottom-0">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($customInvoices as $customInvoice)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>#{{ $customInvoice->id }}</td>
                                            <td>{{ $customInvoice->serviceName }}</td>
                                            <td>{{ $customInvoice->clientName }}</td>
                                            <td>${{ number_format(($customInvoice->price + $customInvoice->tips), 2) }}</td>
                                            <td>${{ number_format(($customInvoice->price + $customInvoice->tips - $customInvoice->amountPaid), 2) }}</td>
                                            <td>
                                                <a href="{{ route('admin.view-custom-invoice', ['id' => $customInvoice->id]) }}" class="btn btn-primary" data-bs-toggle="tooltip" title="Show"><i class="fa fa-eye"></i></a>
                                                <a href="{{ route('admin.edit-custom-invoice', ['id' => $customInvoice->id]) }}" class="btn btn-secondary" data-bs-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
                                                <a href="{{ route('custom-invoice.download', ['id' => $customInvoice->id]) }}" class="btn btn-yellow" data-bs-toggle="tooltip" title="Download"><i class="fa fa-download"></i></a>
                                                <form action="{{ route('admin.delete-custom-invoice', ['id' => $customInvoice->id]) }}" method="POST" onsubmit="return confirm('Confirm deleting the custom invoice #{{ $customInvoice->id }}?');" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    
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