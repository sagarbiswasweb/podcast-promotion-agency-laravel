@extends('backend.master')

@section('title')
    All Plans
@endsection

@section('content')
    <div class="main-container container-fluid">
                    
        <!-- PAGE-HEADER -->
        <div class="page-header">
            <div>
                <h1 class="page-title">Data Tables</h1>
            </div>
            <div class="ms-auto pageheader-btn">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data Tables</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- Row -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h3 class="card-title">File Export</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom  w-100">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">SL</th>
                                        <th class="border-bottom-0">Service</th>
                                        <th class="border-bottom-0">Plan</th>
                                        <th class="border-bottom-0">Price</th>
                                        <th class="border-bottom-0">Duration</th>
                                        <th class="border-bottom-0">Features</th>
                                        <th class="border-bottom-0">Description</th>
                                        <th class="border-bottom-0">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($plans as $plan)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $plan->service->serviceName }}</td>
                                            <td>{{ $plan->planName }}</td>
                                            <td><span>$ </span>{{ $plan->planPrice }}</td>
                                            <td>{{ $plan->planDuration }}<span> Days</span></td>
                                            <td>
                                                {{-- json decoded 'planFeatures' in list  --}}
                                                <ul>
                                                    @foreach (json_decode($plan->planFeatures, true) as $feature)
                                                        <li>{{ $feature }}</li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td>{{ Str::limit(strip_tags($plan->planDescription), 30, '...') }}</td>
                                            <td>
                                                <a href="{{ route('admin.view-plan', ['id' => $plan]) }}" class="btn btn-primary" data-bs-toggle="tooltip" title="show"><i class="fa fa-eye"></i></a>
                                                <a href="{{ route('admin.edit-plan', ['id' => $plan]) }}" class="btn btn-secondary" data-bs-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
                                                <form action="{{ route('admin.delete-plan', ['id' => $plan]) }}" method="POST" onsubmit="return confirm('Confirm deleting {{ $plan->planName }} plan from {{ $plan->service->serviceName }} service ?');" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" data-bs-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></button>
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