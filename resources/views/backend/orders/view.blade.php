@extends('backend.master')

@section('title')
    View Order
@endsection

@section('content')
    <div class="main-container container-fluid">
                  
        <!-- PAGE-HEADER -->
        <div class="page-header">
            <div>
                <h1 class="page-title">Order</h1>
            </div>
            <div class="ms-auto pageheader-btn">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Order</a></li>
                    <li class="breadcrumb-item active" aria-current="page">View Order</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- Row -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h3 class="card-title">View Order</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-wrap text-md-nowrap table-bordered">
                                <tbody>
                                    <tr>
                                        <td>Odrder Date</td>
                                        <td>{{ $order->created_at->timezone('Asia/Dhaka')->format('d M, Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Due Date</td>
                                        {{-- <td>{{ $order->created_at->copy()->addDays($order->plan->planDuration)->timezone('Asia/Dhaka')->format('d M, Y ') }}</td> --}}
                                        <td>{{ optional($order->created_at)->copy()->addDays((int)($order->plan->planDuration ?? 0))->timezone('Asia/Dhaka')->format('d M, Y') ?? '—' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Order Status</td>
                                        <td>{{ $order->status }}</td>
                                    </tr>
                                    <tr>
                                        <td>Transaction Id</td>
                                        <td>{{ $order->transactionId }}</td>
                                    </tr>
                                    <tr>
                                        <td>Client Name</td>
                                        <td>{{ $order->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Client Email</td>
                                        <td>{{ $order->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Client Phone</td>
                                        <td>{{ $order->phone }}</td>
                                    </tr>
                                    <tr>
                                        <td>Plan</td>
                                        <td>{{ $order->plan->service->serviceName }} {{ $order->plan->planName }} Plan</td>
                                    </tr>
                                    <tr>
                                        <td>Plan Price</td>
                                        <td>${{ $order->plan->planPrice }}</td>
                                    </tr>
                                    <tr>
                                        <td>Link</td>
                                        <td><a href="{{ $order->link }}" target="_blank">{{ $order->link }}</a></td>
                                    </tr>
                                    <tr>
                                        <td>Targated Countries</td>
                                        <td>{{ $order->country }}</td>
                                    </tr>
                                    <tr>
                                        <td>Additional Text</td>
                                        <td>{{ $order->additionalText }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->
    </div>

    {{-- order view korar pore unseen order er counter decrease korar jonno code  --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const isNew = {{ $order->seen ? 'false' : 'true' }};
            if (isNew) {
                const badge = document.getElementById('order-counter');
                if (badge) {
                    let count = parseInt(badge.innerText);
                    if (!isNaN(count) && count > 0) {
                        badge.innerText = count - 1;
                    }
                }
            }
        });
    </script>

@endsection