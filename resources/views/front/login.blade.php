@extends('front.master')

@section('content')
<div class="form py-5">
    <div class="container">
        <div class="path mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-light p-2 rounded">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">الرئيسية</a></li>
                    <li class="breadcrumb-item active" aria-current="page">تسجيل الدخول</li>
                </ol>
            </nav>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="signin-form bg-white p-4 rounded shadow-sm">
            <form action="{{ route('client.login') }}" method="POST">
                @csrf

                <div class="text-center mb-4">
                    <img src="{{ asset('asset/imgs/logo.png') }}" style="width: 300px">
                </div>

                <div class="form-group mb-3">
                    <input type="text" name="phone" class="form-control" placeholder="رقم الجوال" value="{{ old('phone') }}">
                    @error('phone')
                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="كلمة المرور">
                    @error('password')
                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                    @enderror
                </div>

                <div class="row mb-4 align-items-center">
                    <div class="col-md-6">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">تذكرني</label>
                        </div>
                    </div>
                    <div class="col-md-6 text-end">
                        <img src="{{ asset('asset/imgs/complain.png') }}" style="width: 30px">
                        <a href="{{ route('password.request') }}" class="ms-1">هل نسيت كلمة المرور؟</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 text-start mb-2 mb-md-0">
                        <button type="submit" class="btn btn-success w-100">دخول</button>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('client.register') }}" class="btn btn-dark w-100">إنشاء حساب جديد</a>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

        
@endsection