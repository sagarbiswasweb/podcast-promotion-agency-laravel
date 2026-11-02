@extends('frontend.master')

@section('title')
    Pricing
@endsection

@section('content')
    <!-- breadcrumb start -->
  <div class="breadcrumb-nav">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Pricing</li>
        </ol>
      </nav>
    </div>
  </div>
  <!-- breadcrumb end -->

  <!-- content start  -->
  <div class="container">
    <div class="row">
        <div class="col-lg-12">
            {{-- loop to get services  --}}
            @foreach ($services as $service)
                <section class="service-pricing mb-5" id="pricing">
                <div class="container">
                <div class="section-title text-center">
                    <span class="title" data-aos="fade-up" data-aos-duration="600">pricing</span>
                    <h2 class="sub-title" data-aos="fade-up" data-aos-duration="600">{{$service->serviceName}} pricing</h2>
                </div>
                <div class="grid">

                    {{-- loop to et plan under each service  --}}
                    @foreach ($service->plans as $plan)
                    <div class="pricing-item" data-aos="fade-up" data-aos-duration="1000">
                        <div class="pricing-header">
                        <h3>basic</h3>
                        <div class="service-price"><span>$ {{ $plan->planPrice }}</span> {{$plan->planDuration}} days</div>
                        </div>
                        <div class="pricing-body">
                        <ul>
                            @foreach (json_decode($plan->planFeatures, true) as $feature)
                            <li><i class="fas fa-check"></i> {{ $feature }}</li>
                            @endforeach
                        </ul>
                        </div>
                        <div class="pricing-footer">
                        <a href="{{ route('user.plan-details', ['id' => $plan->id]) }}" class="btn">more deatils</a>
                        </div>
                    </div>
                    @endforeach
                    
                </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center mt-3">
                    <a href="{{ route('user.service-details', ['id' => $service->id]) }}" class="btn btn-theme">view all</a>
                    </div>
                </div>
            </section>
            @endforeach
        </div>
    </div>
  </div>
  <!-- content end  -->
@endsection