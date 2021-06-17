@include('partials.head')
@livewireStyles

</head>
<style>
.loader_bg{
    position: fixed;
    z-index: 999999;
    background: white;
    width: 100%;
    height: 100%;
}
.loader{
    border:0 solid transparent;
    border-radius: 50%;
    width: 150px !important;
    position: absolute;
    top: calc(50vh - 75px) ;
    left: calc(50vw - 75px);
}

.loader:before, .loader:after{
    content: '';
    border: 1em solid #0093f5;
    border-radius: 50%;
    width: 150px;
    height: 150px;
    position: absolute;
    top: 0;
    left: 0;
    animation: loader 2s linear infinite;
    opacity: 0;
}

.loader:before{
    animation-delay: .5s;
}
@keyframes loader{
    0%{
        transform: scale(0);
        opacity: 0;
    }
    50% {
        opacity: 1;

    }
    100%{
        transform: scale(1);
        opacity: 0;
    }
}

</style>
    <div class="loader_bg">
        <div class="loader"></div>
    
    </div>
<body class="c-app flex-row align-items-center bg-white" >
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
<script>
    setTimeout(function(){
        $('.loader_bg').fadeToggle();
        
        }, 1000);
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/perfect-scrollbar.min.js"></script>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://unpkg.com/@coreui/coreui/dist/js/coreui.min.js"></script>
@livewireScripts
</body>

</html>