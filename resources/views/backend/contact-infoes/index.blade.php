@extends('backend.master')

@section('title')
    Contact Info 
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
                    <li class="breadcrumb-item active" aria-current="page">Show Contact Info</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- Row -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h3 class="card-title">Contact Info Data Table</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-nowrap border-bottom w-100" id="responsive-datatable">
                                <thead>
                                    <tr>
                                        <th class="wd-15p border-bottom-0">Email</th>
                                        <th class="wd-20p border-bottom-0">Phone</th>
                                        <th class="wd-15p border-bottom-0">Address</th>
                                        <th class="wd-10p border-bottom-0">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contactInfos as $contactInfo)
                                        <tr>
                                            <td>{{ $contactInfo->email }}</td>
                                            <td>{{ $contactInfo->phone }}</td>
                                            <td>{{ Str::limit(strip_tags($contactInfo->addressDetails), 30, '...') }}</td>
                                            <td>
                                                <a href="{{ route('admin.view-contact-info', ['id' => $contactInfo]) }}" class="btn btn-primary" data-bs-toggle="tooltip" title="show"><i class="fa fa-eye"></i></a>
                                                <a href="{{ route('admin.edit-contact-info', ['id' => $contactInfo]) }}" class="btn btn-secondary" data-bs-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
                                                {{-- <a href="javascript:void(0);" class="btn btn-danger" data-bs-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a> --}}
                                                <form action="{{ route('admin.delete-contact-info', ['id' => $contactInfo]) }}" method="POST" onsubmit="return confirm('Confirm deleting the contact information?');" style="display:inline;">
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