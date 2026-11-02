@extends('backend.master')

@section('title')
    All FAQ
@endsection

@section('content')
    <div class="main-container container-fluid">
                  
        <!-- PAGE-HEADER -->
        <div class="page-header">
            <div>
                <h1 class="page-title">FAQ</h1>
            </div>
            <div class="ms-auto pageheader-btn">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Others</a></li>
                    <li class="breadcrumb-item active" aria-current="page">FAQ</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- Row -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h3 class="card-title">All FAQs</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-nowrap border-bottom w-100" id="responsive-datatable">
                                <thead>
                                    <tr>
                                        <th class="wd-15p border-bottom-0">SL</th>
                                        <th class="wd-15p border-bottom-0">Question</th>
                                        <th class="wd-15p border-bottom-0">Answer</th>
                                        <th class="wd-15p border-bottom-0">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($faqs as $faq)
                                       <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ Str::limit(strip_tags($faq->question), 30, '...') }}</td>
                                            <td>{{ Str::limit(strip_tags($faq->answer), 30, '...') }}</td>
                                            <td>
                                                <a href="{{ route('admin.view-faq', ['id' => $faq->id]) }}" class="btn btn-primary" data-bs-toggle="tooltip" title="Show"><i class="fa fa-eye"></i></a>
                                                <a href="{{ route('admin.edit-faq', ['id' => $faq->id]) }}" class="btn btn-secondary" data-bs-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
                                                <form action="{{ route('admin.delete-faq', ['id' => $faq->id]) }}" method="POST" onsubmit="return confirm('Confirm deleting the FAQ ?');" style="display:inline;">
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