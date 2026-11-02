@extends('frontend.master')

@section('title')
  Sign Up
@endsection

@section('content')
  <!-- breadcrumb -->
  <div class="breadcrumb-nav" data-aos="fade-down">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Sign Up</li>
        </ol>
      </nav>
    </div>
  </div>

  <!-- signup -->
  <section class="signup-hero">
    <div class="container">
      <div class="row g-4 align-items-stretch">
        <!-- form -->
        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="60">
          <div class="signup-card h-100">
            <div class="mb-2">
              <h2 class="mb-1 fw-bold">Create your account</h2>
              <p class="mb-0" style="color:var(--black-70)">Join creators growing their podcasts with us.</p>
            </div>

            <form action="{{ route('register.user') }}" method="POST" novalidate>
              @csrf

              {{-- Name --}}
              <div class="form-group">
                <div class="input-wrap">
                  <i class="far fa-user input-icon"></i>
                  <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    class="form-control @error('name') is-invalid @enderror"
                    placeholder="Full name"
                    autocomplete="name"
                    required
                  >
                </div>
                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
              </div>

              {{-- Email --}}
              <div class="form-group">
                <div class="input-wrap">
                  <i class="far fa-envelope input-icon"></i>
                  <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="form-control @error('email') is-invalid @enderror"
                    placeholder="Email address"
                    autocomplete="email"
                    required
                  >
                </div>
                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
              </div>

              {{-- Password --}}
              <div class="form-group">
                <div class="input-wrap">
                  <i class="fas fa-lock input-icon"></i>
                  <input
                    type="password"
                    name="password"
                    id="password"
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder="Create a password"
                    autocomplete="new-password"
                    required
                  >
                  <button class="toggle-password" type="button" id="togglePwd" aria-label="Show password">
                    <i class="far fa-eye" id="togglePwdIcon"></i>
                  </button>
                </div>

                <div class="caps-hint" id="capsPwd"><i class="fas fa-exclamation-triangle me-1"></i> Caps Lock is on</div>

                <div class="strength" aria-live="polite" aria-atomic="true">
                  <div class="strength-bars">
                    <span class="strength-bar" id="b1"></span>
                    <span class="strength-bar" id="b2"></span>
                    <span class="strength-bar" id="b3"></span>
                    <span class="strength-bar" id="b4"></span>
                  </div>
                  <span class="strength-label" id="strengthLabel">weak</span>
                </div>

                @error('password') <small class="text-danger d-block mt-1">{{ $message }}</small> @enderror
              </div>

              {{-- Confirm Password --}}
              <div class="form-group">
                <div class="input-wrap">
                  <i class="fas fa-lock input-icon"></i>
                  <input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    class="form-control"
                    placeholder="Confirm password"
                    autocomplete="new-password"
                    required
                  >
                  <button class="toggle-password" type="button" id="toggleConfirm" aria-label="Show confirm password">
                    <i class="far fa-eye" id="toggleConfirmIcon"></i>
                  </button>
                </div>
                <div class="match-hint" id="matchHint"><i class="fas fa-info-circle me-1"></i> Passwords must match</div>
              </div>

              {{-- Terms --}}
              <div class="d-flex align-items-center justify-content-between mb-3">
                <label class="d-flex align-items-center" style="gap:8px;">
                  <input type="checkbox" name="agree" required>
                  <span>I agree to the <a href="{{ route('user.privacy-policy') }}">Privacy Policy</a></span>
                </label>
                <a href="{{ route('login') }}">Have an account?</a>
              </div>

              <button type="submit" class="btn btn-theme btn-block btn-form w-100">Sign Up</button>
            </form>
          </div>
        </div>

        <!-- aside (value props) -->
        <div class="col-lg-6" data-aos="fade-left" data-aos-delay="120">
          <div class="signup-aside h-100 d-flex flex-column justify-content-center">
            <h3 class="mb-3">You’ll love this:</h3>
            <div class="aside-item">
              <i class="fas fa-chart-line"></i>
              <div><strong>Growth analytics</strong><br class="d-none d-md-block">Track reach, engagement & plan performance.</div>
            </div>
            <div class="aside-item">
              <i class="fas fa-shield-check"></i>
              <div><strong>Secure dashboard</strong><br class="d-none d-md-block">Your data is protected with modern best-practices.</div>
            </div>
            <div class="aside-item">
              <i class="fas fa-sparkles"></i>
              <div><strong>Personalized tips</strong><br class="d-none d-md-block">Get recommendations tailored to your goals.</div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
@endsection
