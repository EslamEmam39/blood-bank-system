@extends('layouts.app')

@section('content')
 

   <div class="col-lg">
                 <div class="card card-primary card-outline mb-4">
                  <!--begin::Header--> 
                  <div class="card-header"><div class="card-title">تعديل الأعدادات</div></div>

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
 
                   <!--begin::Form-->
                  <form method="POST" action="{{ route('settings.update') }}">
                    @csrf
                    @method('PUT')
                     <div class="card-body">
                      <div class="mb-3">
                        <label for="phone" class="form-label">الهاتف</label>
                             <input type="text"  id="phone" name="phone" class="form-control" value="{{ $setting->phone ?? null }}">
                      </div>
                      <div class="mb-3">
                        <label for="email" class="form-label">البريد الألكتروني</label>
                             <input type="email"  id="email" name="email" class="form-control" value="{{ $setting->email ?? null }}">
                      </div>
                        <div class="mb-3">
                            <label>رابط تويتر</label>
                            <input type="url" name="twitter_url" class="form-control" value="{{ $setting->twitter_url ?? null }}">
                      </div>
                        <div class="mb-3">
                        <label>رابط فيسبوك</label>
                        <input type="url" name="facebook_url" class="form-control" value="{{ $setting->facebook_url  ?? null}}">
                      </div>
                        <div class="mb-3">
                     <label>رابط انستجرام</label>
                            <input type="url" name="instagram_url" class="form-control" value="{{ $setting->instagram_url  ?? null}}">
                      </div>
                        <div class="mb-3">
                        <label for="youtube_url" class="form-label">رابط اليوتيوب</label>
                            <input type="url" name="youtube_url" class="form-control" value="{{ $setting->youtube_url  ?? null}}">      
                      </div>
                        <div class="mb-3">
                        <label for="google_url" class="form-label">رابط جوجل</label>
                            <input type="url" name="google_url" class="form-control" value="{{ $setting->google_url  ?? null}}">
                      </div>
                        <div class="mb-3">
                              <label>الوتساب</label>
                            <input type="text" name="whatsapp" class="form-control" value="{{ $setting->whatsapp  ?? null}}">
                      </div>
                        <div class="mb-3">
                           <label>عن التطبيق</label>
                            <textarea name="about_app" class="form-control">{{ $setting->about_app ?? null }}</textarea>            
                      </div>
                       
            <div class="card-footer">
                       <button type="submit" class="btn btn-success">حفظ</button>
                    </div>
                   </form>
                  <!--end::Form-->
                </div>
          
              </div>
@endsection
