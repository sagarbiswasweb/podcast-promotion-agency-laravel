<!DOCTYPE html>
<html lang="en">
<head>
  <title>
    @yield('title')
  </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('') }}frontend/assets/css/font-awesome.css">
  <link rel="stylesheet" href="{{ asset('') }}frontend/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('') }}frontend/assets/css/style.css">
  <link rel="stylesheet" href="{{ asset('') }}frontend/assets/css/responsive.css">
  <link rel="stylesheet" href="{{ asset('') }}frontend/assets/css/aos.css">
  <link rel="stylesheet" class="js-color-style" href="{{ asset('') }}frontend/assets/css/colors/color-1.css">
  <link rel="stylesheet" class="js-glass-style" href="{{ asset('') }}frontend/assets/css/glass.css" disabled>
</head>
<body>

<!-- page loader start -->
<div class="page-loader js-page-loader">
  <div></div>
</div>
<!-- page loader end -->

<!-- main wrapper start -->
<div class="main-wrapper">
  
  <!-- header start -->
  <header class="header">
    <div class="container">
      <div class="header-main d-flex justify-content-between align-items-center">
        <div class="header-logo">
          <a href="{{ route('user.dashboard') }}"><span>podcast</span>ranker</a>
          <small class="slogan">Rank Higher. Grow Faster.</small>
        </div>
        <button type="button" class="header-hamburger-btn js-header-menu-toggler">
          <span></span>
        </button>
        <div class="header-backdrop js-header-backdrop"></div>
        <nav class="header-menu js-header-menu">
          <button type="button" class="header-close-btn js-header-menu-toggler">
            <i class="fas fa-times"></i>
          </button>
          <ul class="menu">
            <li class="menu-item"><a href="{{ route('user.dashboard') }}">home</a></li>
            <li class="menu-item menu-item-has-children">
              <a href="#" class="js-toggle-sub-menu">services <i class="fas fa-chevron-down"></i></a>
              <ul class="sub-menu js-sub-menu">
                @foreach ($services as $service)
                  <li class="sub-menu-item">
                    <a href="{{ route('user.service-details', ['slug' => $service->slug]) }}">
                      {{ $service->serviceName }}
                    </a>
                  </li>
                @endforeach
              </ul>
            </li>
            <li class="menu-item"><a href="{{ route('user.message') }}">contact</a></li>
            <li class="menu-item"><a href="{{ route('user.testimonials') }}">Testimonials</a></li>
            
            <li class="menu-item menu-item-has-children">
              @auth
                  <a href="#" class="js-toggle-sub-menu">
                      {{ Auth::user()->name }} <i class="fas fa-chevron-down"></i>
                  </a>
                  <ul class="sub-menu js-sub-menu">
                      <li class="sub-menu-item">
                          <a href="{{ route('user.account') }}">My Account</a>
                      </li>
                      <li class="sub-menu-item">
                          <a href="{{ route('user.track-order') }}">Track Order</a>
                      </li>
                      <li class="sub-menu-item">
  <form method="POST" action="{{ route('logout.user') }}" class="sub-menu-form">
    @csrf
    <button type="submit" class="sub-menu-link logout">Logout</button>
  </form>
</li>

                  </ul>
              @endauth

              @guest
                  <a href="#" class="js-toggle-sub-menu">
                      Account <i class="fas fa-chevron-down"></i>
                  </a>
                  <ul class="sub-menu js-sub-menu">
                      <li class="sub-menu-item"><a href="{{ route('login') }}">Log In</a></li>
                      <li class="sub-menu-item"><a href="{{ route('signup.user') }}">Sign Up</a></li>
                      <li class="sub-menu-item"><a href="{{ route('user.track-order') }}">Track Order</a></li>
                  </ul>
              @endguest
            </li>

          </ul>
        </nav>
      </div>
    </div>
  </header>
  <!-- header end -->