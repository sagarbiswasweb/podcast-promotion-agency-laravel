@extends('backend.master')

@section('title')
    All Team Member
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
                    <li class="breadcrumb-item active" aria-current="page">All Team Member</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- Row -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h3 class="card-title">All Team Member DataTable</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-nowrap border-bottom w-100" id="responsive-datatable">
                                <thead>
                                    <tr>
                                        <th class="wd-15p border-bottom-0">SL</th>
                                        <th class="wd-15p border-bottom-0">Service name</th>
                                        <th class="wd-15p border-bottom-0">Plan</th>
                                        <th class="wd-15p border-bottom-0">Position</th>
                                        <th class="wd-15p border-bottom-0">Name</th>
                                        <th class="wd-15p border-bottom-0">Image</th>
                                        <th class="wd-15p border-bottom-0">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($teams as $team)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $team->plan->service->serviceName }}</td>
                                            <td>{{ $team->plan->planName }}</td>
                                            <td>{{ $team->position == 1 ? 'Team Lead' : 'Team Member' }}</td>
                                            <td>{{ $team->memberName }}</td>
                                            <td>
                                                <img src="{{ asset($team->memberImage) }}" alt="image" class="img-fluid" style="width: 50px; height: 50px; border-radius: 50%;">
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.view-team', ['id' => $team]) }}" class="btn btn-primary" data-bs-toggle="tooltip" title="Show"><i class="fa fa-eye"></i></a>
                                                <a href="{{ route('admin.edit-team', ['id' => $team]) }}" class="btn btn-secondary" data-bs-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
                                                {{-- <a href="javascript:void(0)" class="btn btn-danger"><i class="fa fa-trash"></i></a> --}}
                                                <form action="{{ route('admin.delete-team', ['id' => $team]) }}" method="POST" onsubmit="return confirm('Confirm deleting {{ $team->memberName }} from {{ $team->plan->service->serviceName }}s {{$team->plan->planName}} plan team ?');" style="display:inline;">
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