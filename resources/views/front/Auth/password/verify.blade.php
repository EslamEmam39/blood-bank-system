@extends('front.master')

@section('content')



       <div class="form py-5">
                <div class="container">
                    <div class="path mb-4">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb bg-light p-2 rounded">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">الرئيسية</a></li>
                                <li class="breadcrumb-item active" aria-current="page"> طلب تغير كلمةالمرور</li>
                            </ol>
                        </nav>
                    </div>

        @if (session('success'))
               <div class="alert alert-success">{{ session('success') }}</div>

               @elseif(session('error'))
                   <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

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
                        <form action="{{ route('client.password.reset') }}" method="POST">
                            @csrf

                            <div class="text-center mb-4">
                                <img src="{{ asset('asset/imgs/logo.png') }}" style="width: 300px">
                            </div>

                            <div class="form-group mb-3">
                                <input type="text" name="phone" class="form-control" placeholder="أدخل رقم الهاتف " >
                                @error('phone')
                                    <small class="text-danger d-block mt-1">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" name="pin_code" class="form-control" placeholder="كود التحقق" >

                                @error('pin_code')
                                    <small class="text-danger d-block mt-1">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" name="password" class="form-control" placeholder="كلمة المرور الجديدة" >
                                @error('password')
                                    <small class="text-danger d-block mt-1">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" name="password_confirmation" class="form-control" placeholder="تأكيد كلمة المرور" >
                                @error('password_confirmation')
                                    <small class="text-danger d-block mt-1">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="row align-items-center justify-content-center mt-4">
                                <div class="col-md-6 text-center mb-2 mb-md-0">
                                    <button type="submit" class="btn btn-success w-100">إعادة تعييل كلمة المرور</button>
                                </div>

                            </div>

                        </form>
                    </div>
                </div>
            </div>



@endsection