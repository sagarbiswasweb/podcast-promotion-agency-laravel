
<style>
  .alert {
    background: #d4edda;
    color: #155724;
    padding: 10px 15px;
    border-radius: 6px;
    margin-bottom: 20px;
    border: 1px solid #c3e6cb;
  }
</style>

@extends('frontend.master')

@section('title')
    Password Reset 
@endsection

@section('content')
    <!-- breadcrumb start -->
  <div class="breadcrumb-nav">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Reset Password</li>
        </ol>
      </nav>
    </div>
  </div>
  <!-- breadcrumb end -->

  <div id="message-area">
      @if(session('status'))
          <div class="alert text-center">
              {{ session('status') }}
          </div>
      @endif
  </div>

  <!-- login section start -->
  <section class="login-section section-padding">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6 col-xl-5">
          <div class="login-form box">
            @error('loginError')
                    <div class="text-danger text-center">{{ $message }}</div>
                @enderror
            <h2 class="form-title text-center">Reset Password</h2>
            <form method="POST" action="{{ route('password.request') }}">
                @csrf
              <div class="form-group">
                <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email', Auth::check() ? Auth::user()->email : '') }}"">
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
              <button type="submit" class="btn btn-theme btn-block btn-form">Get Reset Link</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- login section end -->

@endsection