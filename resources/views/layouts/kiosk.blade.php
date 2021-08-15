
    @include('partials.head')
    @livewireStyles
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
</head>
 <body style="margin:0; padding:0;" >
    <div class="loader_bg" >
        <div class="loader"></div>
    
    </div>
 
        <div class="row" >
            <div class="col-lg-5 col-md-12 col-sm"  >
                <img style=" height:100vh;" src="{{asset('images/login-background.jpg')}}" alt="">
            </div>
            <div class="col-md-7">
                @yield('content')
                @if( isset($slot) ) {{ $slot }} @endif
            </div>
        </div>
        


        <script src="{{asset('js/coreui.bundle.js')}}"></script>

        <script type="text/javascript" src="{{asset('assets/sweetalert2/sweetalert2.min.js')}}"></script>
        <script>
            setTimeout(function(){
            $('.loader_bg').fadeToggle();
            
            }, 1000);
            </script>
    <script>
    window.addEventListener('kiosk-success', event => {
        let timerInterval
Swal.fire({
            title: 'Thankyou!',
            html: 'Please get the Ticket and wait for your turn :)',
            timer: 5000,
            allowOutsideClick:false,
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading()
                const b = Swal.getHtmlContainer().querySelector('b')
                timerInterval = setInterval(() => {
                b.textContent = Swal.getTimerLeft()
                }, 10)
            },
            willClose: () => {
                clearInterval(timerInterval)
            }
            }).then((result) => {
            /* Read more about handling dismissals below */
            if (result.dismiss === Swal.DismissReason.timer) {
                window.location.href ="{{route('kiosk.departments')}}"
            }
            })
        })

    window.addEventListener('show-kiosk-modal', event => {
        $('#kioskModal').modal('show');
    })
    </script>
   @livewireScripts

 </body>
</html>
