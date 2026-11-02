@include('backend.common.header')

    <!--APP-SIDEBAR-->
    @include('backend.common.sidebar')
    <!--/APP-SIDEBAR-->

    <!--app-content open-->
    <div class="app-content main-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            @yield('content')
            <!-- CONTAINER CLOSED -->

            {{-- sweet alert  --}}
            @include('sweetalert::alert')
        </div>
    </div>
    
    </div>
    
@include('backend.common.footer')