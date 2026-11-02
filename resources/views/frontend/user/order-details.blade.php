@extends('frontend.master')

@section('title')
    User Account
@endsection

@section('content')

  <!-- breadcrumb start -->
  <div class="breadcrumb-nav">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Track Order</li>
        </ol>
      </nav>
    </div>
  </div>
  <!-- breadcrumb end -->

  <section class="section-padding">
    <div class="container" style="margin-top: 5vh">

      <div class="box">
        @php
          // Plan/service data
          $serviceName  = data_get($order, 'plan.service.serviceName', '—');
          $planName     = data_get($order, 'plan.planName', '—');
          $planPrice    = (float) data_get($order, 'plan.planPrice', 0);
          $planDuration = (int) data_get($order, 'plan.planDuration', 0);

          // Status → badge class
          $statusKey  = strtolower($order->status ?? '');
          $statusText = ucfirst($order->status ?? '—');
          $badgeClass = match ($statusKey) {
            'pending', 'processing'   => 'warning',
            'delivered', 'completed'  => 'success',
            'cancelled', 'failed'     => 'danger',
            'received'                => 'received',   // <-- add this
            default                    => ''
          };

          // Dates
          $orderDate    = optional($order->created_at)?->timezone('Asia/Dhaka')->format('d M, Y');
          $deliveryDate = optional($order->created_at)
                            ? $order->created_at->copy()->addDays($planDuration)->timezone('Asia/Dhaka')->format('d M, Y')
                            : '—';

          // Countries can be array or JSON string or plain text
          $countriesRaw = $order->country ?? null;
          if (is_array($countriesRaw)) {
              $countriesText = implode(', ', $countriesRaw);
          } else {
              $decoded = json_decode($countriesRaw ?? '', true);
              $countriesText = is_array($decoded) ? implode(', ', $decoded) : (string)($countriesRaw ?? '—');
              $countriesText = trim($countriesText) === '' ? '—' : $countriesText;
          }

          // Additional text
          $extra = $order->additionalText ?? '—';
          $extra = trim((string)$extra) === '' ? '—' : $extra;
        @endphp

        <h3 class="pane-title" style="display:flex; align-items:center; gap:10px;">
          Order Details
          <span class="badge {{ $badgeClass }}">{{ $statusText }}</span>
        </h3>

        <div class="table-wrap mt-10">
          <table class="order-details table">
            <tbody>
              <tr>
                <th style="width:240px;">Order Date</th>
                <td>{{ $orderDate }}</td>
              </tr>
              <tr>
                <th>Delivery Date</th>
                <td>{{ $deliveryDate }}</td>
              </tr>
              <tr>
                <th>Status</th>
                <td><span class="badge {{ $badgeClass }}">{{ $statusText }}</span></td>
              </tr>
              <tr>
                <th>Transaction ID</th>
                <td>{{ $order->transactionId ?? '—' }}</td>
              </tr>
              <tr>
                <th>Plan</th>
                <td>{{ $serviceName }} — {{ $planName }} Plan</td>
              </tr>
              <tr>
                <th>Price</th>
                <td>${{ number_format($planPrice, 2) }} for {{ $planDuration }} days</td>
              </tr>
              <tr>
                <th>Link</th>
                <td>
                  @if(!empty($order->link))
                    <a href="{{ $order->link }}" class="table-link" target="_blank" rel="noopener">{{ $order->link }}</a>
                  @else
                    —
                  @endif
                </td>
              </tr>
              <tr>
                <th>Targeted Countries</th>
                <td>{{ $countriesText }}</td>
              </tr>
              <tr>
                <th>Additional Text</th>
                <td>{{ $extra }}</td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="mt-10">
          <a href="{{ route('user.track-order') }}" class="btn btn-light">Back to Orders</a>
        </div>
      </div>

    </div>
  </section>

@endsection
