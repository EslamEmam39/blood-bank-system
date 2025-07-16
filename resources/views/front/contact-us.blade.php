@extends('front.master')

@section('content')
 <!-- Contact Us -->
 <div class="contact-us">
<div class="contact-now">
    <div class="container">
        <!-- Breadcrumb -->
           <div class="path">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">الرئيسية</a></li>
                            <li class="breadcrumb-item active" aria-current="page">تواصل معنا</li>
                        </ol>
                    </nav>
                </div>

        <div class="row methods">
            <!-- Contact Info -->
            <div class="col-md-6">
          <div class="call">
                            <div class="title">
                                <h4>اتصل بنا</h4>
                            </div>
                            <div class="content">
                                <div class="logo">
                                    <img src="{{ asset('asset/imgs/logo.png') }}">
                                </div>
                                <div class="details">
                                    <ul>
                                        <li><span>الجوال:</span> 124123412312</li>
                                        <li><span>فاكس:</span> 234234234</li>
                                        <li><span>البريد الإلكترونى:</span> name@name.com</li>
                                    </ul>
                                </div>
                                <div class="social">
                                    <h4>تواصل معنا</h4>
                                    <div class="icons" dir="ltr">
                                        <div class="out-icon">
                                            <a href="#"><img src="{{ asset('asset/imgs/001-facebook.svg') }}"></a>
                                        </div>
                                        <div class="out-icon">
                                            <a href="#"><img src="{{ asset('asset/imgs/002-twitter.svg') }}"></a>
                                        </div>
                                        <div class="out-icon">
                                            <a href="#"><img src="{{ asset('asset/imgs/003-youtube.svg') }}"></a>
                                        </div>
                                        <div class="out-icon">
                                            <a href="#"><img src="{{ asset('asset/imgs/004-instagram.svg') }}"></a>
                                        </div>
                                        <div class="out-icon">
                                            <a href="#"><img src="{{ asset('asset/imgs/005-whatsapp.svg') }}"></a>
                                        </div>
                                        <div class="out-icon">
                                            <a href="#"><img src="{{ asset('asset/imgs/006-google-plus.svg') }}"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>
 
            <!-- Contact Form -->
            <div class="col-md-6">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                              @if ($errors->any())
                 <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                        @endforeach
                        </ul>
                     </div>
                    @endif
                <div class="contact-form  ">
                    <div class="title mb-3">
                        <h4 class="text-danger">تواصل معنا</h4>
                    </div>
                    <div class="fields">
                             <form method="POST" action="{{ route('contact.us') }}">
                        @csrf
                        <div class="mb-3">
                            <input type="hidden" class="form-control" name="client_id" placeholder="الإسم">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="title" placeholder="عنوان الرسالة">
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" name="message" rows="4" placeholder="نص الرسالة"></textarea>
                        </div>
                       
                        <button type="submit">ارسال</button>
                      
                    </form>
                    </div>
                
                </div>
            </div>
        </div>
    </div>
</div>
 </div>
 

@endsection