<!DOCTYPE html>
<html lang="en">
<head>
@include('components.head')
<!-- Scripts -->
@vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    @include('sweetalert::alert')
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    @include('components.navbar')
    @include('components.sidebar')
    <!-- [ Main Content ] start -->
    <div class="pc-container">
        <div class="pc-content">
            <!-- [ Main Content ] start -->
            @yield('content')
            <!-- [ Main Content ] end -->
        </div>
    </div>

    @include('components.footer')
    @stack('scripts')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <!-- [Page Specific JS] end -->
</body>
<!-- [Body] end -->

</html>
