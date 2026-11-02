@extends('frontend.master')

@section('title')
    About Us
@endsection

@section('content')
    <!-- breadcrumb start -->
  <div class="breadcrumb-nav">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">About Us</li>
        </ol>
      </nav>
    </div>
  </div>
  <!-- breadcrumb end -->

  <!-- content start  -->
  <div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="mb-4">About Us</h1>
            <div class="row">
                @foreach ($aboutUs as $aboutUs)
                <div class="col-lg-8">
                    <p>{!! $aboutUs->aboutUsDetails !!}</p>
                </div>
                <div class="col-lg-4">
                    <img src="{{ $aboutUs->aboutUsImage }}" alt="About Us" class="img-fluid">
                </div>
                @endforeach
            </div>
        </div>
    </div>
  </div>
  <!-- content end  -->
@endsection