

@include('partials.head')

@livewireStyles

</head>
 <body class="c-app">

    @include('partials.sidebar')
    @include('partials.top-navbar')
    <div class="c-body">
        <main class="c-main p-0 m-0">
            @yield('content')
            @if( isset($slot) ) {{ $slot }} @endif

        </main>
    </div>
 {{-- @include('partials.footer') --}}

 <script type="text/javascript" src="{{asset('assets/toastr/toastr.min.js')}}"></script>

 <script>
    window.addEventListener('show-form', event => {
        $('#departmentModal').modal('show');
    })

    window.addEventListener('show-delete-modal', event => {
        $('#confirmationModal').modal('show');
    })

    window.addEventListener('after-insert-modal', event => {
        $('#departmentModal').modal('hide');
        toastr.success(event.detail.message, 'Success!');
    })

    window.addEventListener('show-counter-modal', event => {
        $('#counterModal').modal('show');
    })
    window.addEventListener('hide-counter-modal', event => {
        $('#counterModal').modal('hide');
        toastr.success(event.detail.message, 'Success!');
    })

    //Modal for Services
    window.addEventListener('show-service-modal', event => {
        $('#serviceModal').modal('show');
    })
    window.addEventListener('hide-service-modal', event => {
        $('#serviceModal').modal('hide');
        toastr.success(event.detail.message, 'Success!');
    }) //end of services modal


    //Modal for User
    window.addEventListener('show-user-modal', event => {
        $('#userModal').modal('show');
    })
    window.addEventListener('hide-user-modal', event => {
        $('#userModal').modal('hide');
        toastr.success(event.detail.message, 'Success!');
    }) //end of services modal

    window.addEventListener('alert', event => {
        toastr.success(event.detail.message, 'Success!');
    })

    window.addEventListener('info', event => {
        toastr.info(event.detail.message, );
    })

    window.addEventListener('updated', event => {
        toastr.success(event.detail.message, 'Success!');
    })

    window.addEventListener('replaySound', event => {
        replaySound();
    })

    window.addEventListener('playSound', event => {
        playSound();
    })

        
</script>
<script>
                
    function playSound() {
        

    let counter = document.getElementById("counter_id").value
    let text=  document.getElementById("ticket_number").value;
    var sound = document.getElementById("audio");
    sound.play();
    
    messageVoice = ("TicketNumber "+ text + "Please proceed to counter" + counter);
        responsiveVoice.speak(messageVoice);

    }

    
    function replaySound() {

        let counter = document.getElementById("counter_id").value
        let text=  document.getElementById("prev_ticket_number").value;
        var sound = document.getElementById("audio");
        sound.play();
        
        messageVoice = ("TicketNumber "+ text + "Please proceed to counter" + counter);
            responsiveVoice.speak(messageVoice);

        }

</script>

 @stack('js')
 @livewireScripts
 <script src="{{asset('js/coreui.bundle.js')}}"></script>

</body>
</html>