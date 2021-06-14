@include('partials.head')
@livewireStyles

</head>
<body class="c-app flex-row align-items-center" >
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
                <div class="card-group">
                        @yield('content')
                 </div>
        </div>
    </div>
</div>

<!-- Optional JavaScript -->
<!-- Popper.js first, then CoreUI JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/perfect-scrollbar.min.js"></script>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://unpkg.com/@coreui/coreui/dist/js/coreui.min.js"></script>
@livewireScripts
</body>

</html>