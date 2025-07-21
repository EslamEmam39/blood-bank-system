@extends('front.master')

@section('content')
<!--intro-->
<div class="intro">
    <div id="slider" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#slider" data-slide-to="0" class="active"></li>
            <li data-target="#slider" data-slide-to="1"></li>
            <li data-target="#slider" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item carousel-1 active">
                <div class="container info">
                    <div class="col-lg-5">
                        <h3>بنك الدم نمضى قدما لصحة أفضل</h3>
                        <p>
                            {!! \Illuminate\Support\Str::limit(optional($settings)->about_app, 100) !!}

                        </p>
                        <a href="#">المزيد</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item carousel-2">
                <div class="container info">
                    <div class="col-lg-5">
                        <h3>بنك الدم نمضى قدما لصحة أفضل</h3>
                        <p>
                            {!! \Illuminate\Support\Str::limit(optional($settings)->about_app, 80) !!}

                        </p>
                        <a href="#">المزيد</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item carousel-3">
                <div class="container info">
                    <div class="col-lg-5">
                        <h3>بنك الدم نمضى قدما لصحة أفضل</h3>
                        <p>
                            {!! \Illuminate\Support\Str::limit(optional($settings)->about_app, 50) !!}
                        </p>
                        <a href="#">المزيد</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--about-->
<div class="about">
    <div class="container">
        <div class="col-lg-6 text-center">
            <p>
                <span>بنك الدم</span>
                {!! Str::limit(optional($settings)->about_app, 250) !!}

            </p>
        </div>
    </div>
</div>

<!--articles-->
<div class="articles">
    <div class="container title">
        <div class="head-text">
            <h2>المقالات</h2>
        </div>
    </div>
    <div class="view">
        <div class="container">
            <div class="row">
                <!-- Set up your HTML -->
                <div class="owl-carousel articles-carousel">

                    @foreach ( $articles as $article)
                    <div class="card">
                        <div class="photo">
                            <img src="{{ asset('storage/' . $article->image) }}" class="card-img-top" alt="صوره مقال"
                                style="width: revert-layer;">
                            <a href="{{ route('article.details'  , $article->id) }}" class="click">المزيد</a>
                        </div>
                        <a href="#" class="favourite">
                            @if(auth()->guard('client')->check() &&
                                auth()->guard('client')->user()->favorites->contains($article->id))
                            <form method="POST" action="{{ route('favorites.remove' , $article->id) }}">
                                @csrf
                                <button type="submit" class="btn btn-danger">❤️ إزالة من المفضلة</button>
                            </form>
                            @else
                            <form method="POST" action="{{ route('favorites.add' , $article->id) }}">
                                @csrf
                                <button type="submit" class="btn btn-danger">❤️ اضافة إلى المفضلة</button>
                            </form>
                            @endif

                        </a>

                        <div class="card-body">
                            <h5 class="card-title">{{$article->title}}</h5>
                            <p class="card-text">{{ Str::limit($article->content, 50) }}</p>

                        </div>
                    </div>
                    @endforeach


                </div>
            </div>
        </div>
    </div>
</div>

<!--requests-->
<div class="requests">
    <div class="container">
        <div class="head-text">
            <h2>طلبات التبرع</h2>
        </div>
    </div>
    <div class="content">
        <div class="container">
            <form class="row filter" method="GET" action="{{ route('/') }}" role="search">
                @csrf
                <div class="col-md-5 blood">
                    <div class="form-group">
                        <div class="inside-select">
                            <select class="form-control" name="bloodTypy" id="exampleFormControlSelect1">
                                <option selected disabled>اختر فصيلة الدم</option>
                                @foreach ( $bloodTypys as $bloodTypy )
                                <option value="{{ $bloodTypy->id }}" {{ request('bloodTypy')==$bloodTypy ? 'selected'
                                    : '' }}>{{$bloodTypy->name}}</option>
                                @endforeach
                            </select>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 city">
                    <div class="form-group">
                        <div class="inside-select">
                            <select class="form-control" name="city" id="exampleFormControlSelect1">
                                <option selected disabled>اختر المدينة</option>
                                @foreach ( $cities as $city)
                                <option value="{{ $city->id }}" {{ request('city')==$city->id ? 'selected' : '' }}>
                                    {{$city->name}}
                                </option>
                                @endforeach

                            </select>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-1 search">
                    <button type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
            <div class="patients" id="results">
                @foreach ( $donations as $donation)

                <div class="details">
                    <div class="blood-type">
                        <h2 dir="ltr">{{$donation->bloodType->name}}</h2>
                    </div>
                    <ul>
                        <li><span>اسم الحالة:</span>{{$donation->patient_name}}</li>
                        <li><span>مستشفى:</span>{{$donation->hospital_name}}</li>
                        <li><span>المدينة:</span>{{$donation->city->name}}</li>
                    </ul>
                    <a href="inside-request.html">التفاصيل</a>
                </div>
                @endforeach


            </div>
            <div class="more">
                <a href="{{ route('donation.list') }}">المزيد</a>
            </div>
        </div>
    </div>
</div>

<!--contact-->
<div class="contact">
    <div class="container">
        <div class="col-md-7">
            <div class="title">
                <h3>اتصل بنا</h3>
            </div>
            <p class="text">يمكنك الإتصال بنا للإستفسار عن معلومة وسيتم الرد عليكم</p>
            <div class="row whatsapp">
                <a href="https://wa.me/{{ '2' . ltrim($settings->whatsapp) }}" target="_blank">
                    <img src="{{ asset('asset/imgs/whats.png') }}">
                    <p dir="ltr">{!! optional($settings)->whatsapp !!}</p>
                </a>
            </div>
        </div>
    </div>
</div>

<!--app-->
<div class="app">
    <div class="container">
        <div class="row">
            <div class="info col-md-6">
                <h3>تطبيق بنك الدم</h3>
                <p>
                    {!! \Illuminate\Support\Str::limit(optional($settings)->about_app, 150) !!}

                </p>
                <div class="download">
                    <h4>متوفر على</h4>
                    <div class="row stores">
                        <div class="col-sm-6">
                            <a href="#">
                                <img src="{{ asset('asset/imgs/google.png') }}">
                            </a>
                        </div>
                        <div class="col-sm-6">
                            <a href="#">
                                <img src="{{ asset('asset/imgs/ios.png') }}">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="screens col-md-6">
                <img src="{{ asset('asset/imgs/App.png') }}">
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')

@if(request('bloodTypy') || request('city'))
<script>
    window.onload = function() {
            const element = document.getElementById("results");
            if (element) {
                element.scrollIntoView({ behavior: 'smooth' });
            }
        }
</script>
@endif


@endsection