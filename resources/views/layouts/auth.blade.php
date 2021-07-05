

    @include('partials.head')
    @livewireStyles
</head>
 <body class="c-app flex-row align-items-center" >
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-group">
                        <div class="card-body">
                            @yield('content')
                        </div>
                     </div>
            </div>
        </div>
    </div>
 
    @include('partials.footer')

 </body>
</html>
