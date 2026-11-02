@extends('frontend.master')

@section('title')
  Checkout
@endsection

{{-- Page-specific styles (lightweight, non-conflicting) --}}
<style>
  
</style>

@section('content')
  <!-- breadcrumb -->
  <div class="breadcrumb-nav" data-aos="fade-down">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('user.pricing') }}">pricing</a></li>
          <li class="breadcrumb-item active" aria-current="page">checkout</li>
        </ol>
      </nav>
    </div>
  </div>

  <section class="section-padding">
    <div class="container">
      <!-- visual steps -->
      <div class="checkout-steps mb-4" data-aos="fade-up" data-aos-delay="80">
        <div class="step done"><span class="dot">1</span> choose plan</div>
        <div class="step done"><span class="dot">2</span> details</div>
        <div class="step active"><span class="dot">3</span> pay</div>
        <div class="step"><span class="dot">4</span> confirm</div>
      </div>

      <div class="row">
        <!-- LEFT: Form -->
        <div class="col-lg-8">
          <div class="checkout-card box" data-aos="fade-up" data-aos-delay="120">
            <h3 class="text-capitalize mb-2">Place Order</h3>
            <p class="form-note mb-3">
              Send <strong>${{ number_format($plan->planPrice, 2) }}</strong> to our PayPal and paste the transaction ID below. After payment, orders are usually verified within 1–2 hours. You will receive a confirmation email with invoice attached once your order is confirmed. If you have any questions, please <a href="{{ route('user.message') }}">contact us</a>.
            </p>
            <p class="form-note mb-3"><i>N.B: If you want to use different payment method, please feel free to <a href="{{ route('user.message') }}">contact us</a>.</i></p>

            <!-- PayPal helper -->
            <div class="pp-box mb-4">
              <div>
                <div class="small text-uppercase" style="letter-spacing:.3px; color:var(--black-70)">PayPal account</div>
                <div class="fw-semibold" id="paypalEmail">paypal@example.com</div> {{-- replace with your email --}}
              </div>
              <button type="button" class="copy-btn" id="copyEmail"><i class="far fa-copy me-1"></i> Copy</button>
            </div>

            <!-- Order form -->
            <form action="{{ route('user.order') }}" method="POST" novalidate>
              @csrf

              {{-- hidden: plan id --}}
              <input type="hidden" name="planId" value="{{ $plan->id }}">

              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="name" class="form-label">Name</label>
                  <input
                    type="text" id="name" name="name"
                    value="{{ auth()->user()->name }}"
                    class="form-control @error('name') is-invalid @enderror"
                    placeholder="Your full name" autocomplete="name">
                  @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6 mb-3">
                  <label for="email" class="form-label">Email address</label>
                  <input
                    type="email" id="email" name="email"
                    value="{{ auth()->user()->email }}"
                    class="form-control @error('email') is-invalid @enderror"
                    placeholder="name@domain.com" autocomplete="email">
                  @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
              </div>

              <div class="mb-3">
                <label for="phone" class="form-label">Phone number</label>
                <input
                  type="tel" id="phone" name="phone"
                  value="{{ old('phone') }}"
                  class="form-control @error('phone') is-invalid @enderror"
                  placeholder="+1 555 000 1234" inputmode="tel">
                @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              <div class="mb-3">
                <label for="transaction-id" class="form-label">Transaction ID</label>
                <input
                  type="text" id="transaction-id" name="transactionId"
                  value="{{ old('transactionId') }}"
                  class="form-control @error('transactionId') is-invalid @enderror"
                  placeholder="Paste the PayPal transaction ID">
                @error('transactionId') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              <div class="mb-3">
                <label for="link" class="form-label">Your Podcast Link</label>
                <input
                  type="url" id="link" name="link"
                  value="{{ old('link') }}"
                  class="form-control @error('link') is-invalid @enderror"
                  placeholder="https://your-podcast-link.example">
                @error('link') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              <div class="mb-3">
                <label class="form-label">Targeted Countries</label>
                <div>
                  <label class="pill-check"><input class="form-check-input" name="country[]" type="checkbox" value="USA"> USA</label>
                  <label class="pill-check"><input class="form-check-input" name="country[]" type="checkbox" value="Canada"> Canada</label>
                  <label class="pill-check"><input class="form-check-input" name="country[]" type="checkbox" value="UK"> UK</label>
                  <label class="pill-check"><input class="form-check-input" name="country[]" type="checkbox" value="Australia"> Australia</label>
                  <label class="pill-check"><input class="form-check-input" name="country[]" type="checkbox" value="Germany"> Germany</label>
                  <label class="pill-check"><input class="form-check-input" name="country[]" type="checkbox" value="Finland"> Finland</label>
                  <label class="pill-check"><input class="form-check-input" name="country[]" type="checkbox" value="India"> India</label>
                </div>
                @error('country') <div class="text-danger mt-1">{{ $message }}</div> @enderror
              </div>

              <div class="mb-2">
                <label for="additional-text" class="form-label">Additional Notes</label>
                <textarea
                  id="additional-text" name="additionalText" rows="4"
                  class="form-control @error('additionalText') is-invalid @enderror"
                  placeholder="Anything we should know? (goals, tone, preferences)">{{ old('additionalText') }}</textarea>
                @error('additionalText') <div class="invalid-feedback">{{ $message }}</div> @enderror
                <div class="d-flex justify-content-between mt-1">
                  <span class="form-note">We’ll review and follow up if we need more details.</span>
                  <span class="chars" id="chars">0 / 500</span>
                </div>
              </div>

              <div class="mt-4 d-flex align-items-center justify-content-between flex-wrap" style="gap:10px;">
                <div class="secure-note"><i class="fas fa-lock"></i> Secure, private, and encrypted processing</div>
                <button type="submit" class="btn btn-theme btn-block">Confirm Order</button>
              </div>
            </form>
          </div>
        </div>

        <!-- RIGHT: Order Summary -->
        <div class="col-lg-4 mt-4 mt-lg-0">
          <div class="checkout-card box sticky-summary" data-aos="fade-left" data-aos-delay="160">
            <h4 class="mb-1">{{ $plan->service->serviceName }}</h4>
            <p class="mb-3" style="color:var(--black-70)">{{ $plan->planName }} Plan</p>

            <div class="summary-price mb-3">
              <span>Total</span>
              <span class="amount">${{ number_format($plan->planPrice, 2) }}</span>
            </div>

            <h6 class="mb-2">What’s included</h6>
            <ul class="mb-3">
              @foreach (json_decode($plan->planFeatures, true) as $feature)
                <li class="summary-feature">{{ $feature }}</li>
              @endforeach
            </ul>

            <div class="small" style="color:var(--black-70)">
              <i class="fas fa-info-circle me-1" aria-hidden="true"></i> After payment, orders are usually verified within 1–2 hours.
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
@endsection

@push('scripts')

@endpush
