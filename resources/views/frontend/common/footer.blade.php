<!-- footer start -->
  <footer class="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">
          <div class="col-sm-6 col-lg-3">
            <div class="footer-item">
              <h3 class="footer-logo"><span>podcast</span>rank</h3>
              <ul>
                <li><a href="{{ route('user.about-us') }}">about us</a></li>
                {{-- <li><a href="#">what we offer</a></li> --}}
                <li><a href="#">team</a></li>
                <li><a href="{{ route('user.privacy-policy') }}">privacy policy</a></li>
                <li><a href="#">blog</a></li>
              </ul>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="footer-item">
              {{-- <h3>learning</h3> --}}
              <ul class="mt-5">
                {{-- <li><a href="#">get the app</a></li> --}}
                <li><a href="{{ route('user.testimonials') }}">testimonials</a></li>
                <li><a href="{{ route('user.pricing') }}">pricing</a></li>
                <li><a href="{{ route('user.faqs') }}">faq</a></li>
              </ul>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="footer-item">
              <h3>more</h3>
              <ul>
                <li><a href="#">affiliates</a></li>
                <li><a href="#">become a member</a></li>
                <li><a href="#">training webinars</a></li>
                <li><a href="#">free personality test</a></li>
                <li><a href="{{ route('user.message') }}">help and support</a></li>
              </ul>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="footer-item">
              <h3>get in touch</h3>
              <ul>
                @if(!empty($socialLinks?->facebookLink))
                  <li><a href="{{ $socialLinks->facebookLink }}" target="_blank"><i class="fab fa-facebook social-icon"></i> facebook</a></li>
                @endif

                @if(!empty($socialLinks?->twitterLink))
                  <li><a href="{{ $socialLinks->twitterLink }}" target="_blank"><i class="fab fa-twitter social-icon"></i> twitter</a></li>
                @endif

                @if(!empty($socialLinks?->instagramLink))
                  <li><a href="{{ $socialLinks->instagramLink }}" target="_blank"><i class="fab fa-instagram social-icon"></i> instagram</a></li>
                @endif

                @if(!empty($socialLinks?->youtubeLink))
                  <li><a href="{{ $socialLinks->youtubeLink }}" target="_blank"><i class="fab fa-youtube social-icon"></i> youtube</a></li>
                @endif

                @if(!empty($socialLinks?->linkedinLink))
                  <li><a href="{{ $socialLinks->linkedinLink }}" target="_blank"><i class="fab fa-linkedin social-icon"></i> linkedin</a></li>
                @endif
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <div class="container">
        <p class="m-0 py-4 text-center">Copyright &copy;2025 PodcastRanker.net</p>
      </div>
    </div>
  </footer>
  <!-- footer end -->

</div>
<!-- main wrapper end -->

<!-- style switcher start -->
<div class="style-switcher js-style-switcher">
   <div class="style-switcher-toggler js-style-switcher-toggler">
     <i class="fas fa-cog"></i>
   </div>
   <h3>Style Switcher</h3>
   <div class="style-switcher-item">
     <p class="mb-2">Theme Colors</p>
     <!-- theme colors -->
     <div class="theme-colors js-theme-colors">
       <button type="button" data-js-theme-color="color-1" class="js-theme-color-item color-1"></button>
       <button type="button" data-js-theme-color="color-2" class="js-theme-color-item color-2"></button>
       <button type="button" data-js-theme-color="color-3" class="js-theme-color-item color-3"></button>
       <button type="button" data-js-theme-color="color-4" class="js-theme-color-item color-4"></button>
       <button type="button" data-js-theme-color="color-5" class="js-theme-color-item color-5"></button>
     </div>
   </div>
   <div class="style-switcher-item">
    <div class="form-check form-switch">
      <input class="form-check-input js-dark-mode" type="checkbox" role="switch" id="dark-mode">
      <label class="form-check-label" for="dark-mode">Dark Mode</label>
    </div>
   </div>
   <div class="style-switcher-item">
    <div class="form-check form-switch">
      <input class="form-check-input js-glass-effect" type="checkbox" role="switch" id="glass-effect">
      <label class="form-check-label" for="glass-effect">Glass Effect</label>
    </div>
   </div>
</div>
<!-- style switcher end -->


<script src="{{ asset('') }}frontend/assets/js/bootstrap.bundle.min.js"></script>  
<script src="{{ asset('') }}frontend/assets/js/main.js"></script>
<script src="{{ asset('') }}frontend/assets/js/aos.js"></script>
<script>
  window.addEventListener('load', () => {
    AOS.init({
      // key bits for scroll-up behavior:
      once: true,      // allow re-animations
      mirror: false,     // animate out while scrolling past & back up
      offset: 80,
      duration: 700,
      easing: 'ease-out-cubic',
      anchorPlacement: 'top-bottom'
    });

    // refresh after images/fonts load (optional but helpful)
    setTimeout(() => AOS.refreshHard(), 300);
  });
</script>

{{-- login page js  --}}
<script>
  // Auto-dismiss status alert
  (function(){
    const alertEl = document.querySelector('#message-area .alert');
    if(alertEl){
      setTimeout(() => {
        alertEl.classList.add('hide');
        alertEl.addEventListener('transitionend', () => alertEl.remove());
      }, 3500);
    }
  })();

  // Password show/hide + CapsLock detection
  (function(){
    const pwd = document.getElementById('passwordField');
    const btn = document.getElementById('togglePasswordBtn');
    const icon = document.getElementById('togglePasswordIcon');
    const caps = document.getElementById('capsHint');

    if(btn && pwd){
      btn.addEventListener('click', function(){
        const show = pwd.type === 'password';
        pwd.type = show ? 'text' : 'password';
        icon.classList.toggle('fa-eye', !show);
        icon.classList.toggle('fa-eye-slash', show);
        btn.setAttribute('aria-label', show ? 'Hide password' : 'Show password');
      });

      const checkCaps = (e) => {
        if (!e.getModifierState) return;
        caps.classList.toggle('show', e.getModifierState('CapsLock'));
      };
      ['keyup','keydown','focus'].forEach(ev => pwd.addEventListener(ev, checkCaps));
      pwd.addEventListener('blur', () => caps.classList.remove('show'));
    }
  })();
</script>


{{-- signup page  --}}
<script>
  // Toggle password visibility
  (function(){
    const toggle = (inputId, btnId, iconId) => {
      const input = document.getElementById(inputId);
      const btn   = document.getElementById(btnId);
      const icon  = document.getElementById(iconId);
      if(!input || !btn || !icon) return;
      btn.addEventListener('click', () => {
        const show = input.type === 'password';
        input.type = show ? 'text' : 'password';
        icon.classList.toggle('fa-eye', !show);
        icon.classList.toggle('fa-eye-slash', show);
        btn.setAttribute('aria-label', show ? 'Hide password' : 'Show password');
      });
    };
    toggle('password','togglePwd','togglePwdIcon');
    toggle('password_confirmation','toggleConfirm','toggleConfirmIcon');
  })();

  // Caps Lock detection
  (function(){
    const pwd = document.getElementById('password');
    const caps = document.getElementById('capsPwd');
    if(!pwd || !caps) return;
    const check = e => { if(e.getModifierState) caps.classList.toggle('show', e.getModifierState('CapsLock')); };
    ['keyup','keydown','focus'].forEach(ev=> pwd.addEventListener(ev, check));
    pwd.addEventListener('blur', ()=> caps.classList.remove('show'));
  })();

  // Password strength meter
  (function(){
    const pwd = document.getElementById('password');
    const bars = [ 'b1','b2','b3','b4' ].map(id=> document.getElementById(id));
    const label = document.getElementById('strengthLabel');
    if(!pwd || bars.some(b=>!b) || !label) return;

    const score = (val) => {
      let s = 0;
      if(val.length >= 8) s++;
      if(/[A-Z]/.test(val) && /[a-z]/.test(val)) s++;
      if(/\d/.test(val)) s++;
      if(/[^A-Za-z0-9]/.test(val)) s++;
      return s;
    };

    const update = (s) => {
      bars.forEach((b,i)=>{
        b.classList.toggle('active', i < s);
        b.classList.remove('s-1','s-2','s-3','s-4');
        if(i < s) b.classList.add(`s-${s}`);
      });
      label.textContent = ['weak','fair','good','strong'][Math.max(0,s-1)];
    };

    pwd.addEventListener('input', ()=> update(score(pwd.value)));
    update(0);
  })();

  // Confirm password match hint
  (function(){
    const pwd = document.getElementById('password');
    const conf = document.getElementById('password_confirmation');
    const hint = document.getElementById('matchHint');
    if(!pwd || !conf || !hint) return;
    const check = ()=>{
      if(conf.value.length === 0){ hint.className='match-hint'; return; }
      const ok = conf.value === pwd.value;
      hint.className = 'match-hint show ' + (ok ? 'ok' : 'bad');
      hint.innerHTML = ok
        ? '<i class="fas fa-check-circle me-1"></i> Passwords match'
        : '<i class="fas fa-info-circle me-1"></i> Passwords must match';
    };
    ['input','blur'].forEach(ev => { pwd.addEventListener(ev, check); conf.addEventListener(ev, check); });
    check();
  })();
</script>



{{-- for checkour page  --}}
<script>
  // Copy PayPal email
  (function(){
    const btn = document.getElementById('copyEmail');
    const el  = document.getElementById('paypalEmail');
    if(btn && el){
      btn.addEventListener('click', async () => {
        try{
          await navigator.clipboard.writeText(el.textContent.trim());
          btn.innerHTML = '<i class="far fa-check-circle me-1"></i> Copied';
          setTimeout(()=> btn.innerHTML = '<i class="far fa-copy me-1"></i> Copy', 1400);
        }catch(e){ /* fallback */ }
      });
    }
  })();

  // Limit + live counter for notes (500 chars)
  (function(){
    const textarea = document.getElementById('additional-text');
    const counter  = document.getElementById('chars');
    if(!textarea || !counter) return;

    const MAX = 500;
    const update = () => {
      if(textarea.value.length > MAX){
        textarea.value = textarea.value.slice(0, MAX);
      }
      counter.textContent = textarea.value.length + ' / ' + MAX;
    };
    textarea.addEventListener('input', update);
    update();
  })();
</script>


{{-- for message page  --}}
<script>
  // Copy helpers (address/phone/email)
  (function(){
    document.querySelectorAll('.copy-btn').forEach(btn=>{
      btn.addEventListener('click', async ()=>{
        const sel = btn.getAttribute('data-copy');
        const el  = sel ? document.querySelector(sel) : null;
        if(!el) return;
        const text = (el.innerText || el.textContent || '').trim();
        try{
          await navigator.clipboard.writeText(text);
          const old = btn.innerHTML;
          btn.innerHTML = '<i class="far fa-check-circle"></i> Copied';
          setTimeout(()=> btn.innerHTML = old, 1400);
        }catch(e){}
      });
    });
  })();

  // Live message counter (max 600)
  (function(){
    const field = document.getElementById('msgField');
    const out   = document.getElementById('msgChars');
    if(!field || !out) return;
    const MAX = 600;
    const update = ()=>{
      if(field.value.length > MAX) field.value = field.value.slice(0, MAX);
      out.textContent = field.value.length + ' / ' + MAX;
    };
    field.addEventListener('input', update);
    update();
  })();
</script>



{{-- for testimonial page --}}
<script>
    (function(){
      const grid   = document.getElementById('tGrid');
      const cards  = Array.from(grid.querySelectorAll('.t-item'));
      const search = document.getElementById('tSearch');
      const filter = document.getElementById('tFilter');
      const loadBtn= document.getElementById('tLoadBtn');

      let visible = 6; // initial cards
      const step  = 6;

      function passesFilter(card){
        const q = (search.value || '').trim().toLowerCase();
        const min = parseInt(filter.value || '0', 10);
        const rating = parseInt(card.dataset.rating || '0', 10);
        const hay = card.dataset.search || '';
        const okText = !q || hay.includes(q);
        const okRating = !min || rating >= min;
        return okText && okRating;
      }

      function render(){
        const filtered = cards.filter(passesFilter);
        cards.forEach(c => c.style.display = 'none');
        filtered.slice(0, visible).forEach(c => c.style.display = '');
        loadBtn.style.display = filtered.length > visible ? '' : 'none';
      }

      // events
      search.addEventListener('input', () => { visible = step; render(); });
      filter.addEventListener('change', () => { visible = step; render(); });
      loadBtn.addEventListener('click', () => { visible += step; render(); });

      // read more toggle
      grid.addEventListener('click', (e) => {
        const btn = e.target.closest('.t-read');
        if(!btn) return;
        const body = btn.closest('.t-body');
        const quote = body.querySelector('.t-quote');
        quote.style.display = (quote.style.display === 'none') ? '' : 'none';
        const more = body.querySelector('.t-more');
        if(!more.dataset.full){
          more.dataset.full = '1';
          more.textContent = quote.textContent; // keep a copy (simple)
        }
        more.style.display = (more.style.display === 'block') ? 'none' : 'block';
        btn.textContent = (more.style.display === 'block') ? 'Show less' : 'Read more';
        btn.setAttribute('aria-expanded', more.style.display === 'block' ? 'true' : 'false');
      });

      // initial
      render();
    })();
  </script>




<script>
(() => {
  const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  const nums = document.querySelectorAll('.fun-facts-item h2');

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(({ isIntersecting, target }) => {
      if (!isIntersecting) return;
      target.closest('.fun-facts-item')?.classList.add('in-view');
      if (!prefersReduced && !target.dataset.animated) {
        target.dataset.animated = '1';
        countUp(target);
      }
      observer.unobserve(target);
    });
  }, { threshold: 0.5 });

  nums.forEach(el => observer.observe(el));

  function countUp(el){
    const raw = el.textContent.trim();
    // capture number + any suffix (e.g., "+", "%")
    const m = raw.match(/^([\d.,]+)([^\d]*)$/);
    if (!m) return;

    const numPart = m[1].replace(/,/g, '');
    const end = parseFloat(numPart) || 0;
    const suffix = m[2] || '';
    const useComma = /,/.test(m[1]);

    // duration scales with magnitude (bounds: 900–2000ms)
    const duration = Math.max(900, Math.min(2000, end * 3));
    const start = performance.now();

    function tick(now){
      const t = Math.min(1, (now - start) / duration);
      const eased = 1 - Math.pow(1 - t, 3);   // easeOutCubic
      const current = Math.round(end * eased);
      el.textContent = (useComma ? current.toLocaleString() : String(current)) + suffix;
      if (t < 1) requestAnimationFrame(tick);
    }
    requestAnimationFrame(tick);
  }
})();
</script>



<script>
  (() => {
    const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const items = document.querySelectorAll('.fun-facts-item');
    const nums  = document.querySelectorAll('.fun-facts-item h2');

    // Mark all as "in view" so every card animates
    items.forEach(el => el.classList.add('in-view'));

    // Slow count-up for all numbers
    if (!prefersReduced) {
      nums.forEach(el => {
        if (!el.dataset.animated) {
          el.dataset.animated = '1';
          countUp(el);
        }
      });
    }

    function countUp(el){
      const raw = el.textContent.trim();
      const m = raw.match(/^([\d.,]+)([^\d]*)$/);  // number + suffix (e.g., "+")
      if (!m) return;

      const numPart = m[1].replace(/,/g, '');
      const end = parseFloat(numPart) || 0;
      const suffix = m[2] || '';
      const useComma = /,/.test(m[1]);

      // SLOWER: 3.0s base + scale with value (cap at 7s)
      const base = 3000;            // ms
      const perUnit = 25;           // ms per unit
      const duration = Math.max(base, Math.min(7000, base + end * perUnit));

      const start = performance.now();
      function tick(now){
        const t = Math.min(1, (now - start) / duration);
        const eased = 1 - Math.pow(1 - t, 3);   // easeOutCubic
        const current = Math.round(end * eased);
        el.textContent = (useComma ? current.toLocaleString() : String(current)) + suffix;
        if (t < 1) requestAnimationFrame(tick);
      }
      requestAnimationFrame(tick);
    }
  })();
</script>

</body>
</html>