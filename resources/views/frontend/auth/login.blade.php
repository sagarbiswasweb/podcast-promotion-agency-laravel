@extends('frontend.master')

@section('title')
  Login
@endsection

{{-- Minimal fix: keep left & right icons vertically centered to input --}}
<style>
  .input-fixed{ position: relative; }
  .input-fixed .form-control{
    padding-left: 36px;   /* space for left icon */
    padding-right: 42px;  /* space for eye icon (harmless on email) */
  }
  .input-fixed .input-icon{
    position:absolute; left:12px; top:50%; transform:translateY(-50%);
    color: var(--black-70); font-size:14px; pointer-events:none;
  }
  .input-fixed .toggle-password{
    position:absolute; right:10px; top:50%; transform:translateY(-50%);
    border:0; background:transparent; color: var(--black-70); cursor:pointer; padding:4px; line-height:1;
  }
  .input-fixed .toggle-password:hover{ color: var(--main-color); }
  .caps-hint{ display:block; margin-top:6px; font-size:12px; color:#b54708; }
</style>

@section('content')
  <!-- breadcrumb -->
  <div class="breadcrumb-nav" data-aos="fade-down">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Log In</li>
        </ol>
      </nav>
    </div>
  </div>

  <!-- status message -->
  <div id="message-area" class="container mt-3" data-aos="fade-down" data-aos-delay="100">
    @if(session('status'))
      <div class="alert text-center">
        {{ session('status') }}
      </div>
    @endif
  </div>

  <!-- Login -->
  <section class="auth-section">
    <div class="container">
      <div class="row g-4 align-items-stretch">
        <!-- Left: Form -->
        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="60">
          <div class="auth-card h-100">
            @error('loginError')
              <div class="text-danger text-center mb-2">{{ $message }}</div>
            @enderror

            <div class="mb-2">
              <h2 class="auth-title text-capitalize mb-1">Welcome back</h2>
              <p class="auth-sub">Log in to continue growing your podcast</p>
            </div>

            <form method="POST" action="{{ route('login') }}" novalidate>
              @csrf

              {{-- Email (icon now inside .input-fixed) --}}
              <div class="form-group">
                <div class="input-fixed">
                  <i class="far fa-envelope input-icon"></i>
                  <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="form-control @error('email') is-invalid @enderror"
                    placeholder="Email address"
                    autocomplete="email"
                    autofocus
                  >
                </div>
                @error('email')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>

              {{-- Password (left lock + right eye both inside .input-fixed) --}}
              <div class="form-group">
                <div class="input-fixed">
                  <i class="fas fa-lock input-icon"></i>
                  <input
                    type="password"
                    name="password"
                    id="passwordField"
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder="Password"
                    autocomplete="current-password"
                  >
                  <button type="button" class="toggle-password" id="togglePasswordBtn" aria-label="Show password">
                    <i class="far fa-eye" id="togglePasswordIcon"></i>
                  </button>
                </div>

                <div class="caps-hint" id="capsHint">
                  <i class="fas fa-exclamation-triangle me-1"></i> Caps Lock is on
                </div>

                @error('password')
                  <small class="text-danger d-block mt-1">{{ $message }}</small>
                @enderror
              </div>

              {{-- Row: Remember + Forgot --}}
              <div class="d-flex align-items-center justify-content-between auth-row mb-3">
                <label class="d-flex align-items-center" style="gap:8px;">
                  <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                  <span>Remember me</span>
                </label>
                <a href="{{ route('password.request') }}">Forgot password?</a>
              </div>

              {{-- Submit --}}
              <button type="submit" class="btn btn-theme btn-block btn-form w-100">
                Log In
              </button>

              <p class="text-center mt-4 mb-0">
                New here? <a href="{{ route('signup.user') }}">Create an account</a>
              </p>
            </form>
          </div>
        </div>

        <!-- Right: Aside (unchanged) -->
        <div class="col-lg-6" data-aos="fade-left" data-aos-delay="120">
          <div class="auth-aside h-100 d-flex flex-column justify-content-center">
            <h3 class="mb-3">Why sign in?</h3>
            <div class="auth-bullet mb-3">
              <i class="fas fa-bolt"></i>
              <div><strong>Track progress</strong><br class="d-none d-md-block"> See your orders, reviews, and growth insights.</div>
            </div>
            <div class="auth-bullet mb-3">
              <i class="fas fa-user-shield"></i>
              <div><strong>Secure dashboard</strong><br class="d-none d-md-block"> Manage your plans and billing safely.</div>
            </div>
            <div class="auth-bullet">
              <i class="fas fa-sparkles"></i>
              <div><strong>Tailored recommendations</strong><br class="d-none d-md-block"> Get plan tips based on your goals.</div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
@endsection

