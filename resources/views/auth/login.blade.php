<!doctype html>
<html class="no-js" lang="ar">
<head>
    <meta https-equiv="content-type" content="text/html; charset=UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>تسجيل دخول</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{asset('css/favicon.ico')}}" type="image/gif" sizes="16x16">

    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('admin/dist/fonts/stylesheet.css')}}">

    <link rel="stylesheet" href="{{asset('admin/plugins/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/plugins/ionicons/dist/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/plugins/icon-kit/dist/css/iconkit.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}">
    <link rel="stylesheet" href="{{asset('admin/dist/css/theme.min.css')}}">
    <script src="{{asset('admin/src/js/vendor/modernizr-2.8.3.min.js')}}"></script>
</head>

<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<div class="auth-wrapper">
    <div class="container-fluid h-100">
        <div class="row flex-row h-100 bg-white">
            <div class="col-xl-8 col-lg-6 col-md-5 p-0 d-md-block d-lg-block d-sm-none d-none">
                <div class="lavalite-bg" style="background-image: url('{{asset('admin/img/auth/login-bg.jpg')}}')">
                    <div class="lavalite-overlay"></div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-7 my-auto p-0">
                <div class="authentication-form mx-auto" dir="rtl">
                    <div class="logo-centered">
                        <h3>Rajeh</h3>
                    </div>
                    <div class="text-center">
                        <h3>تسجيل الدخول الى لوحة التحكم</h3>
                        <p>سعداء برؤيتك</p>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <input  type="text" class="form-control @error('email') is-invalid   @enderror " placeholder="البريد الإلكتروني"  required autocomplete="email"  autofocus  name="email" value="{{ old('email') }}"  >
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <i class="ik ik-user"></i>
                        </div>

                        <div class="form-group">
                            <input  id="password"  type="password" name="password" class="form-control @error('password') is-invalid @enderror " autocomplete="current-password" placeholder="كلمه السر" required >
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <i class="ik ik-lock"></i>

                        </div>

                        <div class="row">

                            <div class="col text-left">
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="remember" id="item_checkbox" name="item_checkbox"  {{ old('remember') ? 'checked' : '' }}>
                                    <input class="form-check-input" type="checkbox"  name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <span class="custom-control-label" style="line-height: 15px;right: -56px;top: -2px;">&nbsp;{{ __('تذكرنى') }}</span>
                                </label>
                            </div>

                            <div class="col text-right">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}">
                                        {{ __('نسيت كلمه المرور') }}؟
                                    </a>
                                @endif
                            </div>

                        </div>
                        <div class="sign-btn text-center">
                            <button  type="submit" class="btn btn-theme">
                                {{ __('تسجيل الدخول') }}
                            </button>
                        </div>
                    </form>
                    {{--<div class="register">--}}
                    {{--<p>Don't have an account? <a href="register.html">Create an account</a></p>--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>window.jQuery || document.write('<script src="{{asset('admin/src/js/vendor/jquery-3.3.1.min.js')}}"><\/script>')</script>

<script src="{{asset('admin//plugins/popper.js/dist/umd/popper.min.js')}}"></script>
<script src="{{asset('admin/plugins/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('admin/plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('admin/plugins/screenfull/dist/screenfull.js')}}"></script>
<script src="{{asset('admin/dist/js/theme.js')}}"></script>
<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<script>
    (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
        function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
        e=o.createElement(i);r=o.getElementsByTagName(i)[0];
        e.src='https://www.google-analytics.com/analytics.js';
        r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
    ga('create','UA-XXXXX-X','auto');ga('send','pageview');
</script>
</body>
</html>
