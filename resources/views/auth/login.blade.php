<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title>Laksa Medika</title>
    <meta name="description" content="Mobilekit HTML Mobile UI Kit">
    <meta name="keywords" content="bootstrap 4, mobile template, cordova, phonegap, mobile, html" />
    <link rel="icon" type="image/png" href="{{ URL::asset('assets/images/icon.png')}}" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ URL::asset('assets/images/icon.png')}}">
    <link rel="stylesheet" href="{{ URL::asset('asset/css/style.css')}}">
    <link rel="manifest" href="__manifest.json">
</head>

<body class="bg-white">

    <!-- loader -->
    <div id="loader">
        <div class="spinner-border text-primary" role="status"></div>
    </div>
    <!-- * loader -->


    <!-- App Capsule -->
    <div id="appCapsule" class="pt-0">

        <div class="login-form mt-1">
            <div class="section">
                <img src="{{ URL::asset('assets/images/icon.png')}}" alt="image" class="form-image">
            </div>
            <div class="section mt-1">
                <h1>Laksa Medika</h1>
                {{-- <h4>Silahkan Login...</h4> --}}
            </div>
            <div class="section mt-1 mb-5">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>

                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <label for="password" >{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>
            
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    
                
                    <div class="form-links mt-2">
                        <div>
                            <a href="{{ route('register') }}">Daftar Sekarang</a>
                        </div>
                        <div><a href="{{ route('password.request') }}" class="text-muted">Lupa Password?</a></div>
                    </div>

                    <div class="form-button-group">
                        <button type="submit" class="btn btn-success btn-block btn-lg">{{ __('Login') }}</button>
                    </div>

                </form>
            </div>
        </div>


    </div>
    <!-- * App Capsule -->



    <!-- ///////////// Js Files ////////////////////  -->
    <!-- Jquery -->
    <script src="{{ URL::asset('asset/js/lib/jquery-3.4.1.min.js')}}"></script>
    <!-- Bootstrap-->
    <script src="{{ URL::asset('asset/js/lib/jquery-3.4.1.min.js')}}"></script>
    <script src="{{ URL::asset('asset/js/lib/bootstrap.min.js')}}"></script>
    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.js"></script>
    <!-- Owl Carousel -->
    <script src="{{ URL::asset('asset/js/plugins/owl-carousel/owl.carousel.min.js')}}"></script>
    <!-- jQuery Circle Progress -->
    <script src="{{ URL::asset('asset/js/plugins/jquery-circle-progress/circle-progress.min.js')}}"></script>
    <!-- Base Js File -->
    <script src="{{ URL::asset('asset/js/base.js')}}"></script>


</body>

</html>