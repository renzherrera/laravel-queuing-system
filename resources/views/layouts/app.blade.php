

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
    </div>
 @include('partials.footer')
</body>
</html>