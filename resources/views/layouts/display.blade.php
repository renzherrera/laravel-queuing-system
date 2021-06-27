@include('partials.head')
@livewireStyles

</head>
<style>
.loader_bg{
    position: fixed;
    z-index: 999999;
    background: rgb(13, 48, 119);
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
    border: 1em solid #feffff;
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
    <style>
        *{
            padding: 0!important;
        }
        body {
            background:rgb(11,58,151) !important;
           
        }
        .btn-queue{
            padding: 40px !important;
            font-size: 25px;
            width: 25%;
            border: 0!important;
        }
        
        .btn-title{
            text-align: center
        }
     
        .logo {
            width: 100%;
            margin-top: 20px;
        }
        .card-bg{
            background:rgb(13, 48, 119) !important;


        }
        h2 {
            font-weight: 800;
            letter-spacing: 1px;
            font-size: 45px;
        }
        h3{
            position: relative;
            letter-spacing: 2px;
            opacity: 0.7;
            left: 20%;
        }
     
        </style>
<body class="c-app flex-row " >

<div class="container-fluid">

    <div class="header-container row align-items-center mb-3">
        <div class="logo col-md-4 text-center">
            <img style="width: 220px;" src="{{ asset("storage/logo/" . $settings->logo)}}"/>
        
        </div>
        <div class="col-md-8 half">
            <h2 class="text-white">{{$settings->system_name}}</h2>
            <h3 class="text-white">{{$settings->sub_name}}</h3>
        </div>
    </div>
    

    <div class="row justify-content-center">
    <div class="line"></div>
       
        <div class="col-md-10 pt-5">
                <div class="card-group card-bg mt-5 ">
                        @yield('content')
                 </div>
        </div>
    </div>
</div>
</div>
                    
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
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">

</body>
@livewireScripts
</html>
