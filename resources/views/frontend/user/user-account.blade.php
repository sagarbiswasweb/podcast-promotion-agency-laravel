@extends('frontend.master')

@section('title')
    User Account
@endsection

@section('content')

  <!-- breadcrumb start -->
  <div class="breadcrumb-nav">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="javascript:void(0)">User</a></li>
          <li class="breadcrumb-item active" aria-current="page">My Account</li>
        </ol>
      </nav>
    </div>
  </div>
  <!-- breadcrumb end -->

  <section class="section-padding">
    <div class="container">

      {{-- flash/status --}}
      <div id="message-area" class="mb-4">
        @foreach (['status','success','message','error'] as $key)
          @if (session($key))
            <div class="alert">{{ session($key) }}</div>
          @endif
        @endforeach
      </div>

      <div class="account-grid grid">
        {{-- LEFT: Aside --}}
        <aside class="account-aside" style="grid-column: span 12;">
          <div class="box account-card">
            <div class="account-user">
              <div class="avatar">
                @php $avatar = null; @endphp
                @if($avatar)
                  <img src="{{ $avatar }}" alt="{{ Auth::user()->name }}">
                @else
                  <div class="avatar-fallback" aria-hidden="true">
                    {{ mb_strtoupper(mb_substr(Auth::user()->name,0,1)) }}
                  </div>
                @endif
              </div>
              <div class="u-meta">
                <h3 class="u-name">{{ Auth::user()->name }}</h3>
                <p class="u-email">{{ Auth::user()->email }}</p>
              </div>
            </div>

            <nav class="account-nav">
              <button type="button" class="anav active" data-pane="#pane-overview">Overview</button>
              <button type="button" class="anav" data-pane="#pane-orders">Orders</button>
              <button type="button" class="anav" data-pane="#pane-security">Security</button>

              {{-- Logout --}}
              <form method="POST" action="{{ route('logout.user') }}" class="mt-3">
                @csrf
                <button type="submit" class="anav danger">Log out</button>
              </form>
            </nav>
          </div>
        </aside>

        {{-- RIGHT: Main --}}
        <main class="account-main" style="grid-column: span 12;">

          {{-- Overview --}}
          <div id="pane-overview" class="apane active">
            <div class="box">
              <h3 class="pane-title">Welcome back, {{ Auth::user()->name }}</h3>
              <p class="muted">Manage your orders and account preferences from here.</p>

              @php
                $totalOrders = isset($orders) ? count($orders) : 0;
                $activePlans = isset($orders) ? $orders->where('status','pending')->count() : 0;
                $totalSpent = isset($orders)
                  ? $orders->whereIn('status', ['pending','delivered'])
                           ->sum(fn($o) => data_get($o, 'plan.planPrice', 0))
                  : 0;
              @endphp

              <div class="grid kpi-grid mt-3">
                <div class="kpi box-lite" style="grid-column: span 4;">
                  <span class="kpi-label">Total Orders</span>
                  <strong class="kpi-value">{{ $totalOrders }}</strong>
                </div>
                <div class="kpi box-lite" style="grid-column: span 4;">
                  <span class="kpi-label">Active Plans</span>
                  <strong class="kpi-value">{{ $activePlans }}</strong>
                </div>
                <div class="kpi box-lite" style="grid-column: span 4;">
                  <span class="kpi-label">Total Spent</span>
                  <strong class="kpi-value">${{ number_format($totalSpent, 2) }}</strong>
                </div>
              </div>
            </div>
          </div>

          {{-- Orders --}}
          <div id="pane-orders" class="apane">
            <div class="box">
              <h3 class="pane-title">Your Orders</h3>
              @if(!empty($orders) && count($orders))
                <div class="table-responsive mt-3">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>SL</th>
                        <th>Service</th>
                        <th>Plan</th>
                        <th>Price</th>
                        <th>Purchase Date</th>
                        <th>Delivery Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($orders as $order)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ data_get($order, 'plan.service.serviceName', '—') }}</td>
                          <td>{{ data_get($order, 'plan.planName', '—') }}</td>
                          <td>${{ number_format(data_get($order, 'plan.planPrice', 0), 2) }}</td>
                          <td>{{ optional($order->created_at)->timezone('Asia/Dhaka')->format('d M, Y') }}</td>
                          <td>
                            @php
                              $duration = (int) data_get($order, 'plan.planDuration', 0);
                              $delivery = optional($order->created_at)->copy()->addDays($duration);
                            @endphp
                            {{ optional($delivery)->timezone('Asia/Dhaka')->format('d M, Y') }}
                          </td>
                          <td>{{ ucfirst($order->status) }}</td>
                          <td>
                            <a class="btn btn-theme btn-sm"
                               href="{{ route('user.order-details', ['id' => $order->id]) }}">
                              View Details
                            </a>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              @else
                <p class="muted mb-0">No orders found.</p>
              @endif
            </div>
          </div>

          {{-- Security --}}
          <div id="pane-security" class="apane">
            <div class="box">
              <h3 class="pane-title">Security</h3>
              <ul class="feature-list">
                <li>Email: <strong>{{ Auth::user()->email }}</strong></li>
                <li>
                  Last login:
                  {{ isset($lastLoginAt) ? \Carbon\Carbon::parse($lastLoginAt)->diffForHumans() : '—' }}
                </li>
              </ul>
              <div class="divider"></div>
              <a href="{{ route('password.request') }}" class="btn btn-theme">Change Password</a>
            </div>
          </div>

        </main>
      </div>
    </div>
  </section>

  {{-- Tiny JS to switch panes --}}
  <script>
    (function(){
      const navs  = document.querySelectorAll('.account-nav .anav');
      const panes = document.querySelectorAll('.account-main .apane');

      function activate(target){
        panes.forEach(p => p.classList.remove('active'));
        navs.forEach(n => n.classList.remove('active'));
        const pane = document.querySelector(target);
        const btn  = Array.from(navs).find(n => n.dataset.pane === target);
        if(pane) pane.classList.add('active');
        if(btn)  btn.classList.add('active');
      }

      navs.forEach(btn => {
        btn.addEventListener('click', function(){
          const target = this.dataset.pane;
          if(target) activate(target);
        });
      });
    })();
  </script>

  {{-- Minimal account styles to blend with your system --}}
  <style>
    /* Layout */
    .account-grid { gap: 30px; }
    @media (min-width: 992px){
      .account-aside { grid-column: span 4 !important; }
      .account-main  { grid-column: span 8 !important; }
    }

    .account-card { display: grid; gap: 18px; }
    .account-user { display: flex; align-items: center; gap: 14px; }

    /* Avatar */
    .avatar{ height:56px; width:56px; border-radius:50%; overflow:hidden; background: var(--bg-white); border:1px solid var(--border-color-1); }
    .avatar img{ width:100%; height:100%; object-fit: cover; display:block; }
    .avatar-fallback{
      width:100%; height:100%; display:flex; align-items:center; justify-content:center;
      background: var(--bg-white); color: var(--main-color); font-weight:700; font-size:22px;
    }
    .u-name{ margin:0; font-weight:600; }
    .u-email{ margin:0; color: var(--black-70); font-size: 14px; }

    /* Nav */
    .account-nav{ display:flex; flex-direction: column; gap:8px; }
    .anav{
      width:100%; text-align:left; padding:10px 12px; border-radius:10px; border:1px solid var(--border-color-1);
      background: var(--bg-white); color: var(--black-90); cursor:pointer; transition: all .25s ease; font-weight:500;
    }
    .anav:hover{ border-color: var(--main-color); color: var(--main-color); }
    .anav.active{ background: color-mix(in srgb, var(--main-color) 10%, transparent); border-color: var(--main-color); }
    .anav.danger{ background: transparent; border-color: #e11d48; color:#e11d48; }
    .anav.danger:hover{ background:#e11d4820; }

    /* Panes */
    .apane{ display:none; }
    .apane.active{ display:block; }
    .pane-title{ margin:0 0 6px; font-weight:600; }
    .muted{ color: var(--black-70); }

    /* KPI */
    .box-lite{
      border:1px solid var(--border-color-1); border-radius:10px; padding:16px; background: var(--bg-white);
      box-shadow: 0 4px 14px rgba(0,0,0,.04);
    }
    .kpi-label{ display:block; font-size:14px; color: var(--black-70); }
    .kpi-value{ font-size:26px; font-weight:800; color: var(--black-90); }

    /* Table polish */
    .table>thead th{ white-space: nowrap; }
    .table td, .table th{ vertical-align: middle; }
    .btn.btn-sm{ padding:6px 12px; border-radius: 8px; font-size: 14px; }

    /* Divider */
    .divider{ height:1px; width:100%; background: var(--border-color-1); margin: 16px 0; }

    /* Status alert uses the styles already defined in your CSS (#message-area .alert) */
    /* ---------------- fix dark-mode contrast (account + shared UI) ---------------- */
body.t-dark{
  /* Make “card-ish” backgrounds dark too */
  --bg-white: hsl(240, 8%, 16%);        /* was white in light mode */
  /* (optional) slightly darker “white” token for boxes if you prefer */
  /* --white: hsl(240, 8%, 16%);  // you already set to ~21% — keep or tweak */
}

/* Ensure key containers pick up the dark surface + readable text */
body.t-dark .box,
body.t-dark .account-card,
body.t-dark .box-lite,
body.t-dark .anav,
body.t-dark .table,
body.t-dark .contact-card,
body.t-dark .info-card,
body.t-dark .signup-card,
body.t-dark .auth-card {
  background: var(--bg-white);
  color: var(--black-90);
  border-color: var(--border-color-2, var(--border-color-1));
}

/* The “active” tab chip: mix main color with the dark surface */
body.t-dark .anav.active{
  background: color-mix(in srgb, var(--main-color) 18%, var(--bg-white));
  border-color: var(--main-color);
  color: var(--black-90);
}

/* Avatar fallback tile shouldn’t be bright */
body.t-dark .avatar-fallback{
  background: var(--bg-white);
  color: var(--black-90);
}

/* Table header/body borders and text (you already had a table tweak—this complements it) */
body.t-dark .table thead th,
body.t-dark .table tbody td{
  color: var(--black-90);
  border-color: var(--border-color-2, #2e2e2e);
}

/* Status alert in dark mode (optional but recommended) */
body.t-dark #message-area .alert{
  background: #12351a;        /* deep green */
  color: #c9f3d3;
  border: 1px solid #1f5130;
}

  </style>

@endsection
