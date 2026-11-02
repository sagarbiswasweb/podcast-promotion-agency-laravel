@extends('frontend.master')

@section('title')
  Contact
@endsection

{{-- Page-specific styles (scoped & lightweight) --}}
<style>

</style>

@section('content')
  <!-- breadcrumb -->
  <div class="breadcrumb-nav" data-aos="fade-down">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Contact</li>
        </ol>
      </nav>
    </div>
  </div>

  <section class="contact-hero">
    <div class="container">
      <div class="contact-head" data-aos="fade-up" data-aos-delay="40">
        <span class="contact-tag">Get in touch</span>
        <h2 class="sub-title mt-2">We’d love to hear from you</h2>
        <p class="mb-0" style="color:var(--black-70)">Questions, feedback, or custom requests—drop us a line.</p>
      </div>

      <div class="row g-4">
        <!-- Left: Info -->
        <div class="col-md-6">
          <!-- Address -->
          <div class="info-card" data-aos="fade-up" data-aos-delay="80">
            <div class="icon-box"><i class="fas fa-map-marker-alt"></i></div>
            <h4>Address</h4>
            @if ($contactInfo && $contactInfo->addressDetails)
              <p id="addrText">{!! $contactInfo->addressDetails !!}</p>
              <div class="info-actions">
                <button class="copy-btn" data-copy="#addrText"><i class="far fa-copy"></i> Copy address</button>
              </div>
            @else
              <p>No address found.</p>
            @endif
          </div>

          <!-- Phone -->
          <div class="info-card" data-aos="fade-up" data-aos-delay="120">
            <div class="icon-box"><i class="fas fa-phone"></i></div>
            <h4>Phone</h4>
            @if ($contactInfo && $contactInfo->phone)
              <p id="phoneText">{!! $contactInfo->phone !!}</p>
              <div class="info-actions">
                <button class="copy-btn" data-copy="#phoneText"><i class="far fa-copy"></i> Copy</button>
                <a class="open-btn" href="tel:{{ strip_tags($contactInfo->phone) }}"><i class="fas fa-phone-alt"></i> Call</a>
              </div>
            @else
              <p>No phone found.</p>
            @endif
          </div>

          <!-- Email -->
          <div class="info-card" data-aos="fade-up" data-aos-delay="160">
            <div class="icon-box"><i class="fas fa-envelope"></i></div>
            <h4>Email</h4>
            @if ($contactInfo && $contactInfo->email)
              <p id="emailText">{!! $contactInfo->email !!}</p>
              <div class="info-actions">
                <button class="copy-btn" data-copy="#emailText"><i class="far fa-copy"></i> Copy</button>
                <a class="open-btn" href="mailto:{{ strip_tags($contactInfo->email) }}"><i class="far fa-paper-plane"></i> Mail</a>
              </div>
            @else
              <p>No email found.</p>
            @endif
          </div>
        </div>

        <!-- Right: Form -->
        <div class="col-md-6" data-aos="fade-left" data-aos-delay="120">
          <div class="contact-card box">
            <h3 class="form-title text-center mb-3">Leave a Message</h3>

            @if (session('status'))
              <div class="alert text-center mb-3">{{ session('status') }}</div>
            @endif

            <form action="{{ route('user.send-message') }}" method="POST" novalidate>
              @csrf

              {{-- honeypot (simple anti-bot) --}}
              <input type="text" name="website" style="position:absolute; left:-10000px; top:auto; width:1px; height:1px; overflow:hidden;" tabindex="-1" autocomplete="off">

              <div class="form-group">
                <i class="far fa-user input-icon"></i>
                <input
                  name="senderName" type="text"
                  class="form-control @error('senderName') is-invalid @enderror"
                  placeholder="Name"
                  value="{{ old('senderName', Auth::check() ? Auth::user()->name : '') }}"
                  autocomplete="name">
                @error('senderName') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              <div class="form-group">
                <i class="far fa-envelope input-icon"></i>
                <input
                  name="senderEmail" type="email"
                  class="form-control @error('senderEmail') is-invalid @enderror"
                  placeholder="Email"
                  value="{{ old('senderEmail', Auth::check() ? Auth::user()->email : '') }}"
                  autocomplete="email">
                @error('senderEmail') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              <div class="form-group">
                <i class="fas fa-phone input-icon"></i>
                <input
                  name="senderPhone" type="tel"
                  class="form-control @error('senderPhone') is-invalid @enderror"
                  placeholder="Phone"
                  value="{{ old('senderPhone') }}"
                  inputmode="tel" autocomplete="tel">
                @error('senderPhone') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              <div class="form-group">
                <i class="far fa-comment-dots input-icon"></i>
                <textarea
                  name="senderMessage"
                  class="form-control @error('senderMessage') is-invalid @enderror"
                  placeholder="Message (max 600 characters)"
                  id="msgField">{{ old('senderMessage') }}</textarea>
                @error('senderMessage') <div class="invalid-feedback">{{ $message }}</div> @enderror
                <div class="msg-meta">
                  <span class="form-note">We usually reply within 24 hours.</span>
                  <span class="chars" id="msgChars">0 / 600</span>
                </div>
              </div>

              <button type="submit" class="btn btn-block btn-theme btn-form w-100">Send message</button>
            </form>
          </div>
        </div>

      </div>
    </div>
  </section>
@endsection
