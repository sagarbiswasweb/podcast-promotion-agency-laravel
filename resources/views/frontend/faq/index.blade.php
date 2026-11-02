@extends('frontend.master')

@section('title')
  FAQ
@endsection

{{-- Page-specific styles --}}
<style>
  /* Shell */
  .faq-section{ position:relative; }
  .faq-hero{
    text-align:center; margin-bottom: 24px;
  }
  .faq-hero .sub{ color: var(--black-70); }

  /* Toolbar */
  .faq-toolbar{
    position:sticky; top: 74px; z-index:2;
    display:flex; flex-wrap:wrap; gap:10px; justify-content:center; align-items:center;
    padding:12px;
    border:1px solid var(--border-color-1);
    border-radius:12px;
    background: color-mix(in srgb, var(--white) 92%, transparent);
    box-shadow: 0 10px 24px rgba(0,0,0,.06);
    margin-bottom: 22px;
  }
  .faq-input{
    display:flex; align-items:center; gap:8px;
    padding:10px 12px;
    border:1px solid var(--border-color-1);
    border-radius:10px;
    background: var(--bg-white);
    min-width:280px; flex:1 1 280px;
  }
  .faq-input i{ color: var(--black-70); }
  .faq-input input{
    border:0; outline:0; width:100%; background:transparent; color: var(--black-90);
  }
  .faq-actions{ display:flex; gap:8px; }
  .faq-btn{
    border:1px solid var(--main-color);
    background: transparent; color: var(--main-color);
    padding:8px 12px; border-radius:999px; font-size:14px;
    transition: all .2s ease;
  }
  .faq-btn:hover{ background: var(--main-color); color:#fff; }
  .faq-clear{ border-color: var(--border-color-1); color: var(--black-90); }
  .faq-clear:hover{ background: var(--border-color-1); }

  /* Accordion card */
  .faq-accordion .accordion-item{
    border: 1px solid var(--border-color-1);
    border-radius:14px !important;
    overflow:hidden;
    background: var(--white);
    box-shadow: 0 14px 34px rgba(0,0,0,.06);
    transition: transform .25s ease, box-shadow .25s ease;
  }
  .faq-accordion .accordion-item:hover{ transform: translateY(-3px); box-shadow: 0 20px 48px rgba(0,0,0,.10); }
  .faq-accordion .accordion-item + .accordion-item{ margin-top:14px; }

  .faq-accordion .accordion-header{ position:relative; }
  .faq-accordion .accordion-button{
    gap:10px;
    padding: 16px 56px 16px 16px;
    background: transparent;
    color: var(--black-90);
    font-weight: 600;
    box-shadow:none !important;
  }
  /* remove default BS caret and use FA chevron */
  .faq-accordion .accordion-button::after{
    background-image:none !important;
    content: "\f078"; /* chevron-down */
    font-family: "Font Awesome 5 Free"; font-weight:900;
    color: var(--black-70);
    transform: none;
  }
  .faq-accordion .accordion-button:not(.collapsed)::after{
    transform: rotate(-180deg);
  }

  /* small action (copy link) */
  .faq-link{
    position:absolute; right:16px; top:50%; transform: translateY(-50%);
    border:0; background:transparent; color: var(--black-70);
  }
  .faq-link:hover{ color: var(--main-color); }

  .faq-accordion .accordion-body{
    padding: 0 16px 16px 16px;
    border-top:1px dashed var(--border-color-1);
    background: color-mix(in srgb, var(--white) 98%, transparent);
  }

  .faq-empty{
    display:none; text-align:center; padding: 18px;
    border:1px dashed var(--border-color-1); border-radius:12px;
    color: var(--black-70);
  }

  /* Dark mode */
  body.t-dark .faq-toolbar,
  body.t-dark .faq-accordion .accordion-item{
    background: color-mix(in srgb, var(--white) 96%, transparent);
    border-color: var(--border-color-2);
  }
  body.t-dark .faq-input{ background: var(--select-box-bg-color); border-color: var(--border-color-2); }
  body.t-dark .faq-input input::placeholder{ color: var(--black-70); opacity:.9; }
</style>

@section('content')
  <!-- breadcrumb -->
  <div class="breadcrumb-nav" data-aos="fade-down">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">FAQ</li>
        </ol>
      </nav>
    </div>
  </div>

  <section class="faq-section section-padding">
    <div class="container">

      <!-- Hero -->
      <div class="faq-hero" data-aos="fade-up">
        <h2 class="mb-2 fw-bold">Frequently Asked Questions</h2>
        <p class="sub">Quick answers to common questions about our services & plans.</p>
      </div>

      <!-- Toolbar -->
      <div class="faq-toolbar" data-aos="fade-up" data-aos-delay="80">
        <div class="faq-input">
          <i class="fas fa-search" aria-hidden="true"></i>
          <input id="faqSearch" type="text" placeholder="Search by keyword…" aria-label="Search FAQs">
        </div>
        <div class="faq-actions">
          <button type="button" class="faq-btn" id="expandAll"><i class="fas fa-plus-square me-1"></i> Expand all</button>
          <button type="button" class="faq-btn" id="collapseAll"><i class="fas fa-minus-square me-1"></i> Collapse all</button>
          <button type="button" class="faq-btn faq-clear" id="clearSearch"><i class="fas fa-times me-1"></i> Clear</button>
        </div>
      </div>

      <!-- Accordion -->
      <div class="faq-accordion accordion" id="faqAccordion" data-aos="fade-up" data-aos-delay="140">
        @foreach ($faqs as $faq)
          @php
            $collapseId = 'faq-' . $loop->index;
            $headingId  = 'heading-' . $loop->index;
            $q          = trim($faq->question ?? '');
            $a          = strip_tags($faq->answer ?? '');
            $searchBlob = Str::lower($q . ' ' . $a);
          @endphp
          <div class="accordion-item" data-search="{{ $searchBlob }}">
            <h2 class="accordion-header" id="{{ $headingId }}">
              <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}"
                      type="button"
                      data-bs-toggle="collapse"
                      data-bs-target="#{{ $collapseId }}"
                      aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                      aria-controls="{{ $collapseId }}">
                <i class="far fa-question-circle me-2" aria-hidden="true"></i>
                <span>{{ $q }}?</span>
              </button>

              <!-- copy deep link -->
              <button type="button" class="faq-link" data-link="#{{ $collapseId }}" aria-label="Copy link to this question">
                <i class="fas fa-link"></i>
              </button>
            </h2>

            <div id="{{ $collapseId }}"
                 class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                 aria-labelledby="{{ $headingId }}"
                 data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                {!! $faq->answer !!}
              </div>
            </div>
          </div>
        @endforeach
      </div>

      <div class="faq-empty mt-3" id="faqEmpty">
        <i class="fas fa-info-circle me-1" aria-hidden="true"></i> No FAQs matched your search. Try different keywords.
      </div>

      <!-- CTA -->
      <div class="text-center mt-4" data-aos="fade-up" data-aos-delay="180">
        <a href="{{ route('user.message') }}" class="btn btn-theme">
          <i class="far fa-paper-plane me-1"></i> Didn’t find your answer? Contact us
        </a>
      </div>
    </div>
  </section>

  <!-- Page JS -->
  <script>
    document.addEventListener('DOMContentLoaded', function(){
      const search   = document.getElementById('faqSearch');
      const clearBtn = document.getElementById('clearSearch');
      const expand   = document.getElementById('expandAll');
      const collapse = document.getElementById('collapseAll');
      const items    = Array.from(document.querySelectorAll('.faq-accordion .accordion-item'));
      const empty    = document.getElementById('faqEmpty');

      // Filter
      const applyFilter = () => {
        const q = (search.value || '').trim().toLowerCase();
        let visible = 0;

        items.forEach(item => {
          const hay = item.dataset.search || '';
          const show = !q || hay.includes(q);
          item.style.display = show ? '' : 'none';
          if (show) visible++;
        });

        empty.style.display = visible ? 'none' : 'block';
      };

      search.addEventListener('input', applyFilter);
      clearBtn.addEventListener('click', () => { search.value=''; applyFilter(); search.focus(); });

      // Expand/Collapse all (for visible items)
      const getCollapse = (el) => {
        const target = el.querySelector('.accordion-collapse');
        return target ? bootstrap.Collapse.getOrCreateInstance(target, { toggle:false }) : null;
      };

      expand.addEventListener('click', () => {
        items.forEach(it => { if (it.style.display !== 'none') getCollapse(it)?.show(); });
        setTimeout(() => AOS.refresh(), 200);
      });
      collapse.addEventListener('click', () => {
        items.forEach(it => { if (it.style.display !== 'none') getCollapse(it)?.hide(); });
      });

      // Deep-link: /faq#faq-3 opens that row
      const openFromHash = () => {
        const id = location.hash?.slice(1);
        if (!id) return;
        const el = document.getElementById(id);
        if (el && el.classList.contains('accordion-collapse')) {
          // reveal parent if filtered out
          const item = el.closest('.accordion-item');
          if (item){ item.style.display=''; }
          bootstrap.Collapse.getOrCreateInstance(el, { toggle:false }).show();
          // scroll into view a bit below the header
          el.addEventListener('shown.bs.collapse', () => {
            const y = el.getBoundingClientRect().top + window.scrollY - 90;
            window.scrollTo({ top: y, behavior: 'smooth' });
          }, { once:true });
        }
      };
      openFromHash();

      // Copy link buttons
      document.querySelectorAll('.faq-link').forEach(btn => {
        btn.addEventListener('click', async () => {
          const frag = btn.getAttribute('data-link');
          const url  = window.location.origin + window.location.pathname + frag;
          try{
            await navigator.clipboard.writeText(url);
            btn.innerHTML = '<i class="fas fa-check"></i>';
            setTimeout(()=> btn.innerHTML = '<i class="fas fa-link"></i>', 1200);
          }catch(e){
            // fallback
            prompt('Copy this link:', url);
          }
        });
      });
    });
  </script>
@endsection
