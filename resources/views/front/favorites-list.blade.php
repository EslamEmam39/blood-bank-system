@extends('front.master')
@section('title','My Favourite Blood Donors')

@section('content')

<div class="article-details">
    <div class="inside-article">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('/') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a
                                href="{{ route('articles.list') }}">المقالات</a></li>
                        <li class="breadcrumb-item active" aria-current="page">الوقاية من الأمراض</li>
                    </ol>
                </nav>
            </div>

            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif



            <!--articles-->
            <div class="articles">
                <div class="title">
                    <div class="head-text">
                        <h2>جميع المقالات </h2>
                    </div>
                </div>
                <div class="view">
                    <div class="row">
                        <!-- Set up your HTML -->
                        <div class="owl-carousel articles-carousel">
                            @foreach ($favorites as $favorite )
                            <div class="card">
                                <div class="photo">
                                    <img src="{{ asset('storage/' . $favorite->image) }}" class="card-img-top"
                                        alt="...">

                                </div>
                                <a href="#" class="favourite">
                                    @if(auth()->guard('client')->check() &&
                                    auth()->guard('client')->user()->favorites->contains($favorite->id))
                                    <form method="POST" action="{{ route('favorites.remove' , $favorite->id) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">❤️ إزالة من المفضلة</button>
                                    </form>
                                    @else
                                    <form method="POST" action="{{ route('favorites.add' , $favorite->id) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">❤️ اضافة إلى المفضلة</button>
                                    </form>
                                    @endif
                                </a>

                                <div class="card-body">
                                    <h5 class="card-title">{{$favorite->title}}</h5>
                                    <p class="card-text">
                                        {{$favorite->content}}
                                    </p>
                                </div>
                            </div>
                            @endforeach


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection