@include('partials.head')
<title>Login | {{ settings('system_name') ?? ''}}</title>

@livewireStyles
 <body class="c-app flex-row align-items-center" >
        <div class="container">
            <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card-group">
                            <div class="card ">
                                <div class="card-body d-flex align-items-center" >
                                    <form action="{{route('login')}}"  style="width:100%" method="post">
                                        @csrf
                                        <h1>Login</h1>
                                        <p class="text-muted">Sign In to your account</p>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                <svg class="c-icon">
                                                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                                                </svg>
                                                </span>
                                            </div>
                                            <input name="email" id="email" class="form-control @error('email') is-invalid @enderror" type="text" placeholder="Username">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="input-group mb-4">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                <svg class="c-icon">
                                                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
                                                    </svg>
                                                    </span>
                                                </div>
                                            <input name="password" id="password" class="form-control @error('password') is-invalid @enderror" type="password" placeholder="Password">
                                            @error('password')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <button type="submit" class="btn btn-primary px-4">Login</button>
                                            </div>
                                            <div class="col-6 text-right">
                                                <button class="btn btn-link px-0" type="button">Forgot password?</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
                                <div class="card-body text-center">
                                    <div>
                                        <h2></h2>
                                        <img width="65%" src="{{asset("storage/logo/" . settings('logo'))}}" alt="">
                                        <p style="font-size: 1.2rem; margin-bottom: -1px;"><strong>Queueing Management System</strong></p>
                                        <p>City of San Fernando, Pampanga</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>

 </body>
</html>

