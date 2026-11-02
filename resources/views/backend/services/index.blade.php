@extends('backend.master')

@section('title')
    All Services
@endsection

@section('content')
    <div class="main-container container-fluid">                   
        <!-- PAGE-HEADER -->
        <div class="page-header">
            <div>
                <h1 class="page-title">All Services</h1>
            </div>
            <div class="ms-auto pageheader-btn">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Services</a></li>
                    <li class="breadcrumb-item active" aria-current="page">All Services</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- Row -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h3 class="card-title">Services DataTable</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-nowrap border-bottom w-100" id="responsive-datatable">
                                <thead>
                                    <tr>
                                        <th class="wd-15p border-bottom-0">SL</th>
                                        <th class="wd-15p border-bottom-0">Service name</th>
                                        <th class="wd-20p border-bottom-0">Service image</th>
                                        <th class="wd-20p border-bottom-0">Service description</th>
                                        <th class="wd-15p border-bottom-0">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($services as $service)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $service->serviceName }}</td>
                                            <td>
                                                <img src="{{ asset($service->serviceImage) }}" alt="image" class="img-fluid" style="width: 50px; height: 50px; border-radius: 50%;">
                                            </td>
                                            <td>{{ Str::limit(strip_tags($service->serviceDetails), 30, '...') }}</td>
                                            <td>
                                                <a href="{{ route('admin.view-service', ['id' => $service]) }}" class="btn btn-primary" data-bs-toggle="tooltip" title="Show"><i class="fa fa-eye"></i></a>
                                                <a href="{{ route('admin.edit-service', ['id' => $service]) }}" class="btn btn-primary" data-bs-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
                                                {{-- <a href="{{ route('admin.delete-service', ['id' => $service]) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a> --}}
                                                <form action="{{ route('admin.delete-service', ['id' => $service->id]) }}" method="POST" onsubmit="return confirm('Confirm deleting {{ $service->serviceName }} service?');" style="display:inline;">
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