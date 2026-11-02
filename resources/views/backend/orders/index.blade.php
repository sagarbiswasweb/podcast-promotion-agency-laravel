@extends('backend.master')

@section('title')
    Orders
@endsection

@section('content')
{{-- unseen orders tr background stye for ligt and dark theme  --}}
<style>
    .bg-unseen-warning {
        background-color: #fff3ca !important; /* Light mode default */
        color: #000 !important;
    }

    @media (prefers-color-scheme: dark) {
        .bg-unseen-warning {
            background-color: #4a3e1e !important; /* Darker yellow-brown shade */
            color: #fff !important;
        }
    }
</style>

    <div class="main-container container-fluid">
                 
        <!-- PAGE-HEADER -->
        <div class="page-header">
            <div>
                <h1 class="page-title">orders</h1>
            </div>
            <div class="ms-auto pageheader-btn">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">orders</a></li>
                    <li class="breadcrumb-item active" aria-current="page">All Orders</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- Row -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h3 class="card-title">All Orders</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-nowrap border-bottom w-100" id="responsive-datatable">
                                <thead>
                                    <tr>
                                        <th class="wd-15p border-bottom-0">SL</th>
                                        <th class="wd-20p border-bottom-0">Plan</th>
                                        <th class="wd-15p border-bottom-0">Price</th>
                                        <th class="wd-15p border-bottom-0">Order Date</th>
                                        <th class="wd-15p border-bottom-0">Deliverty Date</th>
                                        <th class="wd-10p border-bottom-0">Status</th>
                                        <th class="wd-10p border-bottom-0">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr class="{{ $order->seen ? '' : 'bg-unseen-warning' }}">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $order->plan->service->serviceName }} {{ $order->plan->planName }} Plan</td>
                                            <td>{{ $order->plan->planPrice }}</td>
                                            <td>{{ $order->created_at->timezone('Asia/Dhaka')->format('d M, Y') }}</td>
                                            {{-- <td>{{ $order->created_at->copy()->addDays($order->plan->planDuration)->timezone('Asia/Dhaka')->format('d M, Y ') }}</td> --}}
                                            <td>
                                              {{ $order->created_at
                                                    ? $order->created_at->copy()
                                                        ->addDays((int)($order->plan->planDuration ?? 0))
                                                        ->timezone('Asia/Dhaka')
                                                        ->format('d M, Y')
                                                    : '—' }}
                                            </td>
                                            <td>
                                                <form action="{{ route('admin.update-order-status', $order->id) }}" method="POST">
                                                    @csrf
                                                    <select name="status" class="form-select form-select-sm" onchange="this.form.submit()" style="color: {{ $order->status == 'pending' ? 'blue' : ($order->status == 'received' ? 'red' : 'green') }};">
                                                        <option style="color: red;" value="received" {{ $order->status == 'received' ? 'selected' : '' }}>Received</option>
                                                        <option style="color: blue;" value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                        <option style="color: green;" value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                                    </select>
                                                </form>
                                            </td>

                                            <td>
                                                <a href="{{ route('admin.view-order', ['id' => $order->id]) }}" class="btn btn-primary" data-bs-toggle="tooltip" title="show"><i class="fa fa-eye"></i></a>
                                                <a href="{{ route('admin.download-invoice', ['id' => $order->id]) }}" class="btn btn btn-secondary">Download Invoice</a>
                                                <form action="{{ route('admin.send-invoice', ['id' => $order->id]) }}" method="POST" style="display: inline-block;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary" onclick="return confirm('Send invoice to {{$order->user->name}}?')">Send Invoice via Email</button>
                                                </form>

                                                {{-- <form action="#" method="POST" onsubmit="return confirm('Confirm deleting the contact information?');" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" data-bs-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></button>
                                                </form> --}}
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