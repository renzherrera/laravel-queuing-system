@include('partials.head')
@livewireStyles
</head>

<body class="c-app flex-row align-items-center " >
    <div class="container-fluid  ">

       @yield('content')

     </div>
</body>

<!-- Optional JavaScript -->
<!-- Popper.js first, then CoreUI JS -->

@include('partials.footer')
@livewireScripts

 







