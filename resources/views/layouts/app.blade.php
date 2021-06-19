

@include('partials.head')

@livewireStyles

</head>
 <body class="c-app">

    @include('partials.sidebar')
    @include('partials.top-navbar')
    <div class="c-body">
        <main class="c-main">
            @yield('content')
        </main>
    <!-- Optional JavaScript -->
 <!-- Popper.js first, then CoreUI JS -->

 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/perfect-scrollbar.min.js"></script>
 <script src="https://unpkg.com/@popperjs/core@2"></script>
 <script src="https://unpkg.com/@coreui/coreui/dist/js/coreui.min.js"></script>
{{-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}

 @livewireScripts