@extends('frontend.master')

@section('title')
    Plan Details
@endsection

@section('content')
  <!-- breadcrumb start -->
  <div class="breadcrumb-nav" data-aos="fade-down" data-aos-delay="0">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Services</a></li>
          <li class="breadcrumb-item active" aria-current="page">Plan Details</li>
        </ol>
      </nav>
    </div>
  </div>
  <!-- breadcrumb end -->

  <!-- course details section start -->
  <section class="course-details section-padding">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">

          <!-- course header start -->
          <div class="course-header box" data-aos="fade-up" data-aos-delay="50">
            <h2 class="text-capitalize">{{$planDetails->planName}}</h2>
            <div class="rating" data-aos="zoom-in" data-aos-delay="120">
              <span class="average-rating">({{ number_format($averageRating, 1) }})</span>
              <span class="average-stars">
                @for ($i = 1; $i <= 5; $i++)
                    @if ($averageRating >= $i)
                        <i class="fas fa-star"></i>
                    @elseif ($averageRating >= ($i - 0.5))
                        <i class="fas fa-star-half-alt"></i>
                    @else
                        <i class="far fa-star"></i>
                    @endif
                @endfor
              </span>
            </div>
            <ul class="mb-0">
              <li data-aos="fade-up" data-aos-delay="180">total clients - <span>{{count($planDetails->ratings)}}</span></li>
              @if ($teamLead)
                <li data-aos="fade-up" data-aos-delay="240">team lead - <span><a href="#">{{ $teamLead->memberName }}</a></span></li>
              @else
                <li data-aos="fade-up" data-aos-delay="240"><span>No team lead assigned yet.</span></li>
              @endif
            </ul>
          </div>
          <!-- course header end -->

          <!-- course tabs start -->
          <nav class="course-tabs" data-aos="fade-up" data-aos-delay="80">
            <div class="nav nav-tabs border-0" id="nav-tab" role="tablist">
              <button class="nav-link active" id="course-curriculum-tab" data-bs-toggle="tab" data-bs-target="#course-curriculum" type="button" role="tab" aria-controls="course-curriculum" aria-selected="true">features</button>
              <button class="nav-link" id="course-description-tab" data-bs-toggle="tab" data-bs-target="#course-description" type="button" role="tab" aria-controls="course-description" aria-selected="false">description</button>
              <button class="nav-link" id="course-instructor-tab" data-bs-toggle="tab" data-bs-target="#course-instructor" type="button" role="tab" aria-controls="course-instructor" aria-selected="false">team</button>
              <button class="nav-link" id="course-reviews-tab" data-bs-toggle="tab" data-bs-target="#course-reviews" type="button" role="tab" aria-controls="course-reviews" aria-selected="false">reviews</button>
            </div>
          </nav>
          <!-- course tabs end -->

          <!-- tab panes start -->
          <div class="tab-content" id="nav-tabContent">

            <!-- course curriculum start -->
            <div class="tab-pane fade show active" id="course-curriculum" role="tabpanel" aria-labelledby="course-curriculum-tab">
              <div class="course-curriculum box" data-aos="fade-up" data-aos-delay="40">
                <h3 class="text-capitalize mb-4">Features</h3>
                <ul>
                  @foreach (json_decode($planDetails->planFeatures, true) as $feature)
                    <li data-aos="fade-up" data-aos-delay="{{ 80 + ($loop->index * 60) }}"><i class="fas fa-check"></i> {{ $feature }}</li>
                  @endforeach
                </ul>
              </div>
            </div>
            <!-- course curriculum end -->

            <!-- course description start -->
            <div class="tab-pane fade" id="course-description" role="tabpanel" aria-labelledby="course-description-tab">
              <div class="course-description box" data-aos="fade-up" data-aos-delay="60">
                <h3 class="text-capitalize mb-4">description</h3>
                {!! $planDetails->planDescription !!}
              </div>
            </div>
            <!-- course description end -->

            <!-- course instructor start -->
            <div class="tab-pane fade" id="course-instructor" role="tabpanel" aria-labelledby="course-instructor-tab">
              @foreach ($planDetails->teams as $team)
                <div class="course-instructor box mb-4" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 140 }}">
                  <h3 class="mb-3 text-capitalize">{{ $team->position == 1 ? 'Team Lead' : 'Team Member' }}</h3>
                  <div class="instructor-details">
                    <div class="details-wrap d-flex align-items-center flex-wrap">
                      <div class="left-box me-4" data-aos="zoom-in" data-aos-delay="120">
                        <div class="img-box">
                          <img src="{{ asset($team->memberImage) }}" class="rounded-circle" alt="instructor img" loading="lazy">
                        </div>
                      </div>
                      <div class="right-box" data-aos="fade-left" data-aos-delay="160">
                        <h4>{{ $team->memberName }}</h4>
                        <ul>
                          <li><i class="fas fa-star"></i> {{$team->memberRating}} Star</li>
                          <li><i class="fas fa-certificate"></i> {{ $team->totalReview }} Reviews</li>
                        </ul>
                      </div>
                    </div>
                    <div class="text" data-aos="fade-up" data-aos-delay="220">
                      <p class="mb-0">{!! $team->memberDescription !!}</p>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
            <!-- course instructor end -->

            <!-- course reviews start -->
            <div class="tab-pane fade" id="course-reviews" role="tabpanel" aria-labelledby="course-reviews-tab">
              <div class="course-reviews box" data-aos="fade-up" data-aos-delay="60">
                <!-- rating summary start -->
                <div class="rating-summary">
                  <h3 class="mb-4 text-capitalize" data-aos="fade-up">Clients feedback</h3>
                  <div class="row">
                    <div class="col-md-4 d-flex align-items-center justify-content-center text-center" data-aos="zoom-in" data-aos-delay="80">
                      <div class="rating-box">
                        <div class="average-rating">{{ number_format($averageRating, 1) }}</div>
                        <div class="average-stars">
                          @for ($i = 1; $i <= 5; $i++)
                              @if ($averageRating >= $i)
                                  <i class="fas fa-star"></i>
                              @elseif ($averageRating >= ($i - 0.5))
                                  <i class="fas fa-star-half-alt"></i>
                              @else
                                  <i class="far fa-star"></i>
                              @endif
                          @endfor
                        </div>
                        <div class="reviews">{{count($planDetails->ratings)}} Reviews</div>
                      </div>
                    </div>
                    <div class="col-md-8" data-aos="fade-left" data-aos-delay="120">
                      <div class="rating-bars">
                        @for ($i = 5; $i >= 1; $i--)
                          <div class="rating-bars-item" data-aos="fade-up" data-aos-delay="{{ 100 + (5-$i)*80 }}">
                            <div class="star-text">{{ $i }} Star</div>
                            <div class="progress">
                              <div class="progress-bar" style="width: {{ $starsPercent[$i] ?? 0 }}%;"></div>
                            </div>
                            <div class="percent">{{ $starsPercent[$i] ?? 0 }}%</div>
                          </div>
                        @endfor
                      </div>
                    </div>
                  </div>
                </div>
                <!-- rating summary end -->

                <!-- reviews filter start -->
                <div class="reviews-filter" data-aos="fade-up" data-aos-delay="140">
                  <h3 class="mb-4 text-capitalize">reviews</h3>
                  <form id="reviewFilterForm">
                    <div class="form-group">
                      <i class="fas fa-chevron-down select-icon"></i>
                      <select class="form-control" id="reviewFilter">
                        <option value="">All Reviews</option>
                        <option value="1">1 Star</option>
                        <option value="2">2 Stars</option>
                        <option value="3">3 Stars</option>
                        <option value="4">4 Stars</option>
                        <option value="5">5 Stars</option>
                      </select>
                    </div>
                  </form>
                </div>
                <!-- reviews filter end -->

                <!-- course reviews list start -->
                <div class="reviews-list" id="reviewsList">
                  @foreach ($planDetails->ratings as $rating)
                      @php
                          $nameParts = explode(' ', trim($rating->clientName));
                          $count = count($nameParts);

                          if ($count === 1) {
                              $initials = strtoupper(substr($nameParts[0], 0, 1));
                          } elseif ($count === 2) {
                              $initials = strtoupper(substr($nameParts[0], 0, 1) . substr($nameParts[1], 0, 1));
                          } else {
                              $initials = strtoupper(substr($nameParts[0], 0, 1) . substr(end($nameParts), 0, 1));
                          }
                      @endphp

                      <div class="reviews-item" data-rating="{{ $rating->planRating }}" data-aos="fade-up" data-aos-delay="{{ 160 + ($loop->index * 80) }}">
                          <div class="img-box">
                              <div class="client-initials">
                                  {{ $initials }}
                              </div>
                          </div>
                          <h4>{{ $rating->clientName }}</h4>
                          <div class="stars-rating">
                              @for ($i = 1; $i <= 5; $i++)
                                  @if ($i <= $rating->planRating)
                                      <i class="fas fa-star"></i>
                                  @else
                                      <i class="far fa-star"></i>
                                  @endif
                              @endfor
                          </div>
                          <p>{{ $rating->clientReview }}</p>
                      </div>
                  @endforeach
                </div>


                <button type="button" class="btn btn-theme" id="loadMoreBtn" data-aos="zoom-in" data-aos-delay="120">More Reviews</button>
              </div>
            </div>
            <!-- course reviews end -->
          </div>
          <!-- tab panes end -->

        </div>

        <div class="col-lg-4">
          <!-- course sidebar start -->
          <div class="course-sidebar box" data-aos="fade-left" data-aos-delay="60">
            <div class="img-box position-relative" data-bs-toggle="modal" data-bs-target="#video-modal" data-aos="zoom-in" data-aos-delay="120">
              <img src="{{ asset($planDetails->service->serviceImage) }}" class="w-100" alt="course img" loading="lazy">
            </div>

            {{-- showing price with 20% discount  --}}
            <div class="price d-flex align-items-center mb-3" data-aos="fade-up" data-aos-delay="160">
              @php
                $newPrice = $planDetails->planPrice;
                $oldPrice = $newPrice + ($newPrice * 0.20);
              @endphp
              <span class="price-old text-decoration-line-through">${{ number_format($oldPrice, 0) }}</span>
              <span class="price-new ms-2"> ${{ number_format($newPrice, 0) }}</span>
              <span class="price-discount ms-2">20% Off</span>
            </div>

            <h3 class="mb-3" data-aos="fade-up" data-aos-delay="180">Plan Features</h3>
            <ul>
              @foreach (json_decode($planDetails->planFeatures, true) as $feature)
                <li data-aos="fade-up" data-aos-delay="{{ 200 + ($loop->index * 60) }}"><i class="fas fa-check"></i> {{ $feature }}</li>
              @endforeach
            </ul>

            <div class="btn-wrap mt-4" data-aos="zoom-in" data-aos-delay="240">
              <a href="{{ route('user.checkout', ['id' => $planDetails->id]) }}" type="button" class="btn btn-theme btn-block">buy this plan</a>
            </div>
          </div>
          <!-- course sidebar end -->
        </div>

      </div>
    </div>
  </section>
  <!-- course details section end -->
@endsection

{{-- filter reviews and load more functionality  --}}

  <script>
    // Scroll animations (down & up)
    window.addEventListener('load', () => {
      AOS.init({
        once: false,          // re-animate on re-enter
        mirror: true,         // animate out past viewport & back up
        duration: 700,
        easing: 'ease-out-cubic',
        offset: 80,
        anchorPlacement: 'top-bottom'
      });

      // Refresh when switching tabs so new pane items animate properly
      document.querySelectorAll('[data-bs-toggle="tab"]').forEach(el=>{
        el.addEventListener('shown.bs.tab', () => AOS.refresh());
      });

      // Final pass after images/fonts
      setTimeout(() => AOS.refreshHard(), 400);
    });

    // Reviews filter + load more
    document.addEventListener("DOMContentLoaded", function () {
      const filterSelect = document.getElementById("reviewFilter");
      const reviews = Array.from(document.querySelectorAll(".reviews-item"));
      const loadMoreBtn = document.getElementById("loadMoreBtn");
      let visibleCount = 3;

      function updateDisplay() {
        const selectedRating = filterSelect.value;
        const filtered = selectedRating
          ? reviews.filter(r => r.dataset.rating === selectedRating)
          : reviews;

        reviews.forEach(r => r.style.display = "none");
        filtered.slice(0, visibleCount).forEach(r => { r.style.display = "block"; });

        loadMoreBtn.style.display = filtered.length > visibleCount ? "block" : "none";

        // AOS needs to recalc since we changed visibility
        AOS.refresh();
      }

      filterSelect.addEventListener("change", function () {
        visibleCount = 3;
        updateDisplay();
      });

      loadMoreBtn.addEventListener("click", function () {
        visibleCount += 3;
        updateDisplay();
      });

      updateDisplay();
    });
  </script>

