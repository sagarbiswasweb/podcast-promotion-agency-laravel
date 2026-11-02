@extends('backend.master')

@section('title')
    Show Privacy Policy
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
                    <li class="breadcrumb-item active" aria-current="page">Show privacy policy</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- Row -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h3 class="card-title">Privacy Policy Data Table</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-nowrap border-bottom w-100" id="responsive-datatable">
                                <thead>
                                    <tr>
                                        <th class="wd-15p border-bottom-0">Privacy policy</th>
                                        <th class="wd-10p border-bottom-0">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($privacyPolicies as $privacyPolicy)
                                        <tr>
                                        <td>{!! Str::limit(strip_tags($privacyPolicy->privacyPolicy), 30, '...') !!}</td>
                                        <td>
                                            <a href="{{ route('admin.view-privacy-policy', ['id' => $privacyPolicy]) }}" class="btn btn-primary" data-bs-toggle="tooltip" title="show"><i class="fa fa-eye"></i></a>
                                            <a href="{{ route('admin.edit-privacy-policy', ['id' => $privacyPolicy]) }}" class="btn btn-secondary" data-bs-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
                                            {{-- <a href="javascript:void(0);" class="btn btn-danger" data-bs-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a> --}}
                                            <form action="{{ route('admin.delete-privacy-policy', ['id' => $privacyPolicy]) }}" method="POST" onsubmit="return confirm('Confirm deleting privacy policy ?');" style="display:inline;">
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