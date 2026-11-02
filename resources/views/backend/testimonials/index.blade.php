@extends('backend.master')

@section('title')
    All Testimonials
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
                    <li class="breadcrumb-item active" aria-current="page">All Testimonials</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- Row -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h3 class="card-title">Testimonials DataTable</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-nowrap border-bottom w-100" id="responsive-datatable">
                                <thead>
                                    <tr>
                                        <th class="wd-15p border-bottom-0">SL</th>
                                        <th class="wd-15p border-bottom-0">Date</th>
                                        <th class="wd-15p border-bottom-0">Name</th>
                                        <th class="wd-20p border-bottom-0">Designation</th>
                                        <th class="wd-20p border-bottom-0">Rating</th>
                                        <th class="wd-20p border-bottom-0">Testimonial</th>
                                        <th class="wd-15p border-bottom-0">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($testimonials as $testimonial)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            {{-- <td>{{ \Carbon\Carbon::parse($testimonial->date)->format('d/m/Y') }}</td> --}}
                                            <td>{{ \Carbon\Carbon::parse($testimonial->date)->format('d F Y') }}</td>
                                            <td>{{ $testimonial->name }}</td>
                                            <td>{{ $testimonial->designation }}</td>
                                            <td>{{ $testimonial->rating }}<span> Star</span></td>
                                            <td>{{ Str::limit(strip_tags($testimonial->testimonial), 30, '...') }}</td>
                                            <td>
                                                <a href="{{ route('admin.view-testimonial', ['id' => $testimonial]) }}" class="btn btn-primary" data-bs-toggle="tooltip" title="View"><i class="fa fa-eye"></i></a>
                                                <a href="{{ route('admin.edit-testimonial', ['id' => $testimonial]) }}" class="btn btn-primary" data-bs-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
                                                {{-- <a href="javascript:void(0)" class="btn btn-danger"><i class="fa fa-trash"></i></a> --}}
                                                <form action="{{ route('admin.delete-testimonial', ['id' =>$testimonial]) }}" method="POST" onsubmit="return confirm('Confirm deleting the testimonial ?');" style="display:inline;">
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