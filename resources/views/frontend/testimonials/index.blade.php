@extends('frontend.master')

@section('title')
  Testimonials
@endsection

{{-- Page-specific styles --}}
<style>

</style>

@section('content')
  <!-- breadcrumb -->
  <div class="breadcrumb-nav" data-aos="fade-down">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Testimonials</li>
        </ol>
      </nav>
    </div>
  </div>

  @php
    $count = $testimonials->count();
    $avg   = $count ? round($testimonials->avg('rating'), 1) : 0;
    $avgInt = floor($avg);
    $hasHalf = ($avg - $avgInt) >= 0.5;
  @endphp

  <section class="t-section section-padding">
    <div class="container">
      <div class="section-title text-center">
        <span class="title" data-aos="fade-up">Testimonials</span>
        <h2 class="sub-title" data-aos="fade-up" data-aos-delay="70">Loved by podcasters worldwide</h2>

        <div class="t-stats" data-aos="fade-up" data-aos-delay="120">
          <div class="t-stars" aria-label="Average rating {{ $avg }} out of 5">
            @for($i=1;$i<=5;$i++)
              @if($i <= $avgInt)
                <i class="fas fa-star"></i>
              @elseif($hasHalf && $i === $avgInt+1)
                <i class="fas fa-star-half-alt"></i>
              @else
                <i class="far fa-star"></i>
              @endif
            @endfor
          </div>
          <span class="t-badge">{{ $avg }} / 5 • {{ $count }} reviews</span>
        </div>
      </div>

      <!-- Filter/Search toolbar -->
      <div class="t-toolbar" data-aos="fade-up" data-aos-delay="160">
        <div class="t-input">
          <i class="fas fa-search" aria-hidden="true"></i>
          <input type="text" id="tSearch" placeholder="Search by name or role…" aria-label="Search testimonials">
        </div>
        <div class="t-select">
          <i class="fas fa-filter" aria-hidden="true"></i>
          <select id="tFilter" aria-label="Filter by rating">
            <option value="">All ratings</option>
            <option value="5">5 stars</option>
            <option value="4">4 stars & up</option>
            <option value="3">3 stars & up</option>
            <option value="2">2 stars & up</option>
            <option value="1">1 star & up</option>
          </select>
        </div>
      </div>

      <!-- Cards -->
      <div class="t-grid" id="tGrid">
        @foreach ($testimonials as $t)
          @php
            $delay = min($loop->iteration * 60, 420);
            $initial = strtoupper(mb_substr($t->name ?? 'U', 0, 1));
            $rating = (int) ($t->rating ?? 0);
          @endphp

          <div class="t-col t-item"
               data-rating="{{ $rating }}"
               data-search="{{ Str::lower(trim(($t->name ?? '') . ' ' . ($t->designation ?? ''))) }}"
               data-aos="fade-up" data-aos-delay="{{ $delay }}">
            <article class="t-card">
              <div class="t-head">
                <div class="t-avatar" aria-hidden="true">{{ $initial }}</div>
                <div class="t-meta">
                  <div class="t-name">{{ $t->name }}</div>
                  <div class="t-role">{{ $t->designation }}</div>
                </div>
                <div class="t-right ms-auto">
                  <div class="t-date">{{ $t->date }}</div>
                  <div class="t-stars" aria-label="Rated {{ $rating }} out of 5">
                    @for($i=1;$i<=5;$i++)
                      @if($i <= $rating) <i class="fas fa-star"></i>
                      @else <i class="far fa-star"></i>
                      @endif
                    @endfor
                  </div>
                </div>
              </div>

              <div class="t-body">
                <p class="t-quote">{{ $t->testimonial }}</p>
                <div class="t-more"></div>
                <div class="t-actions">
                  <button type="button" class="t-read" aria-expanded="false">Read more</button>
                </div>
              </div>
            </article>
          </div>
        @endforeach
      </div>

      <!-- Load more -->
      <div class="t-load-wrap">
        <button class="t-load" id="tLoadBtn">Load more</button>
      </div>
    </div>
  </section>


@endsection
