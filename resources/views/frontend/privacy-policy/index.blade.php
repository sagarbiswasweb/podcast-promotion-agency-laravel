@extends('frontend.master')

@section('title')
    Privacy Policy
@endsection

@section('content')
    <!-- breadcrumb start -->
  <div class="breadcrumb-nav">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Privacy Policy</li>
        </ol>
      </nav>
    </div>
  </div>
  <!-- breadcrumb end -->

  <!-- content start  -->
  <div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="mb-4">Privacy Policy</h1>
            <div class="row">
                @foreach ($privacyPolicy as $privacyPolicy)
                <div class="col-lg-12">
                    <p>{!! $privacyPolicy->privacyPolicy !!}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
  </div>
  <!-- content end  -->
@endsection