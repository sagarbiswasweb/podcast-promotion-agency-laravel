@extends('backend.master')

@section('title')
    All Custom Emails
@endsection

@section('content')

    <div class="main-container container-fluid">
                 
        <!-- PAGE-HEADER -->
        <div class="page-header">
            <div>
                <h1 class="page-title">Custom Emails</h1>
            </div>
            <div class="ms-auto pageheader-btn">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Custom Emails</a></li>
                    <li class="breadcrumb-item active" aria-current="page">All Custom Emails</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- Row -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h3 class="card-title">All Custom Emails</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-nowrap border-bottom w-100" id="responsive-datatable">
                                <thead>
                                    <tr>
                                        <th class="wd-15p border-bottom-0">SL</th>
                                        <th class="wd-15p border-bottom-0">Recepient Email</th>
                                        <th class="wd-15p border-bottom-0">Email Subject</th>
                                        <th class="wd-15p border-bottom-0">Email Body</th>
                                        <th class="wd-10p border-bottom-0">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customEmails as $customEmail)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $customEmail->to }}</td>
                                            <td>{{ $customEmail->subject }}</td>
                                            <td>{{ Str::limit(strip_tags($customEmail->message), 30, '...') }}</td>
                                            <td>
                                                <a href="{{ route('admin.view-custom-email-details', ['id' => $customEmail->id]) }}" class="btn btn-primary" data-bs-toggle="tooltip" title="show"><i class="fa fa-eye"></i></a>

                                                <form action="{{ route('admin.delete-custom-email', ['id' => $customEmail->id]) }}" method="POST" onsubmit="return confirm('Confirm deleting the email?');" style="display:inline;">
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