@include('frontend.common.header')

    @yield('content')

    {{-- sweet alert  --}}
    @include('sweetalert::alert')
@include('frontend.common.footer')