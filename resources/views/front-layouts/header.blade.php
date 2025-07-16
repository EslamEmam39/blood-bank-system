<!doctype html>
<html lang="en" dir="rtl">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    {{-- <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css"
        integrity="sha384-vus3nQHTD+5mpDiZ4rkEPlnkcyTP+49BhJ4wJeJunw06ZAp+wzzeBPUXr42fi8If" crossorigin="anonymous"> --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css">


    <!--google fonts css-->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">

    <!--font awesome css-->
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link rel="icon" href="{{ asset('asset/imgs/Icon.png') }} ">

    <!--owl-carousel css-->
    <link rel="stylesheet" href="{{asset('asset/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ asset('asset/css/owl.theme.default.min.css')}}">

    <!--style css-->
    <link rel="stylesheet" href="{{ asset('asset/css/style.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('asset/css/style-ltr.css') }}"> --}}

    <title>Blood Bank</title>
</head>

<body>
    <!--upper-bar-->
    <div class="upper-bar">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="language">
                        <a href="index.html" class="ar active">عربى</a>
                        <a href="index-ltr.html" class="en inactive">EN</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="social">
                        <div class="icons">
                            <a href="{{ $settings->facebook_url }}" target="blank" class="facebook"><i
                                    class="fab fa-facebook-f"></i></a>
                            <a href="{{ $settings->instagram_url }}" target="blank" class="instagram"><i
                                    class="fab fa-instagram"></i></a>
                            <a href="{{ $settings->twitter_url }}" target="blank" class="twitter"><i
                                    class="fab fa-twitter"></i></a>
                            <a href="https://wa.me/{{ '2' . ltrim($settings->whatsapp, '0') }}" target="blank"
                                class="whatsapp"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>

                <!-- not a member-->
                <div class="col-lg-4">
                    <div class="info" dir="ltr">
                        <div class="phone">
                            <i class="fas fa-phone-alt"></i>
                            <p>2{{$settings->whatsapp}}</p>
                        </div>
                        <div class="e-mail">
                            <i class="far fa-envelope"></i>
                            <p>{{ $settings->email }}</p>
                        </div>
                    </div>

                    <!--I'm a member

                        <div class="member">
                            <p class="welcome">مرحباً بك</p>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    احمد محمد
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="index-1.html">
                                        <i class="fas fa-home"></i>
                                        الرئيسية
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="far fa-user"></i>
                                        معلوماتى
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="far fa-bell"></i>
                                        اعدادات الاشعارات
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="far fa-heart"></i>
                                        المفضلة
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="far fa-comments"></i>
                                        ابلاغ
                                    </a>
                                    <a class="dropdown-item" href="contact-us.html">
                                        <i class="fas fa-phone-alt"></i>
                                        تواصل معنا
                                    </a>
                                    <a class="dropdown-item" href="index.html">
                                        <i class="fas fa-sign-out-alt"></i>
                                        تسجيل الخروج
                                    </a>
                                </div>
                            </div>
                        </div>

                        -->

                </div>
            </div>
        </div>
    </div>


    <!--nav-->
    <div class="nav-bar">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand" href="{{ route('/') }}">
                    <img src="{{ asset('asset/imgs/logo.png') }}" class="d-inline-block align-top" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('/') }}">الرئيسية <span
                                    class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('about.app') }}">عن بنك الدم</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">المقالات</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('donation.request') }}">طلبات التبرع</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('about.app') }}">من نحن</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('contact.us') }}">اتصل بنا</a>
                        </li>
                    </ul>

                    <!--not a member-->
                    <div class="accounts">
                        @if (Auth::guard('client')->check())

                        <form method="POST" action="{{ route('client.logout') }}">
                            @csrf
                         <a href="{{ route('client.profile') }}" class="btn btn-secondary">الملف الشخصى</a>
                            <button type="submit" class="signin">تسجيل خروج</button>
                  

                        </form>
                        @else
                        <a href="{{ route('client.register') }}" class="create">إنشاء حساب جديد</a>
                        <a href="{{ route('client.login') }}" class="signin">الدخول</a>
                        @endif


                    </div>

                    {{-- I'm a member --}}
                    {{--
                    <a href="#" class="donate">
                        <img src="{{ asset('asset/imgs/transfusion.svg') }}">
                        <p>طلب تبرع</p>
                    </a> --}}


                </div>
            </div>
        </nav>
    </div>