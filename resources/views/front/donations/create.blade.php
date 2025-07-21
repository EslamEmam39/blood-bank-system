@extends('front.master')

@section('content')

<div class="create">
      <div class="form">
            <div class="container">
                <div class="path">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('/') }}}">الرئيسية</a></li>
                            <li class="breadcrumb-item active" aria-current="page">انشاء حساب جديد</li>
                        </ol>
                    </nav>
                </div>
          @if($errors->any())
           <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
          @endif
         
 
                @if(session('success'))
                  <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (session('info'))
    <div class="alert alert-info">
        {{ session('info') }}
    </div>

@endif

                <div class="account-form">
                    <form method="POST" action="{{route('donation.request.store')}}">
                        @csrf
                        <input type="text" id="patient_name" name="patient_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="اسم المريض">
                        <input type="text" id="hospital_name" name="hospital_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="اسم المستشفى">
                        <input type="text" id="hospital_address" name="hospital_address" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="عنوان المستشفى">
                        
                        <input type="number" id="patient_age" name="patient_age" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="عمرالمريض">
                        <input type="number" id="bags_num" name="bags_num" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="عدد اكياس الدم">
                        
                        
                        <select class="form-control" id="blood_type_id" name="blood_type_id">
                            <option selected disabled hidden value=""> المدينة</option>
                            @foreach ($cities as $city)
                            <option value="{{ $city->id}}">{{$city->name}}</option>
                      @endforeach
                        </select>
                        
                        <select class="form-control" id="cities" name="city_id">
                            <option  selected disabled hidden value="">فصيلة الدم</option>
                            @foreach ($bloodTypys as $bloodTypy)
                            <option value="{{$bloodTypy->id}}">{{$bloodTypy->name}}</option>
                            @endforeach
                        </select>
                        
                        <input type="text" class="form-control" id="exampleInputEmail1" name="phone" aria-describedby="emailHelp" placeholder="رقم الهاتف">

                        <textarea class="form-control" id="exampleInputEmail1" name="notes" aria-describedby="emailHelp" placeholder="وصف المريض">
                                                       
                          </textarea>

                          <div id="map">
                                <input type="text" name="latitude" class="form-control" id="latitude" placeholder="Latitude" readonly required>
                                <input type="text" name="longitude" class="form-control" id="longitude" placeholder="Longitude" readonly required>
                          </div> 

                            <button type="button" id="get-location-btn" class="btn btn-primary mb-3"> استخدم موقعي الحالي</button>

 
                         @if (Auth::guard('client')->check())
                         <div class="create-btn">
                            <input type="submit" value="إنشاء"></input>
                        </div>
                        @else
                            <div class="create-btn">
                            <a href="{{route('client.login')}}" class="btn btn-primary mb-3">تسجيل الدخول</a>
                         @endif
                     
                    </form>
                </div>
            </div>
        </div>
</div>

@endsection

@section('js')

<script>
    // إحداثيات افتراضية (مثلاً القاهرة)
    var defaultLat = 30.0444;
    var defaultLng = 31.2357;

    // إنشاء الخريطة
    var map = L.map('map').setView([defaultLat, defaultLng], 7);

    // تحميل الخريطة من OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // متغير لتحديد الماركر
    var marker;

    // عند الضغط على الخريطة
    map.on('click', function(e) {
        var lat = e.latlng.lat.toFixed(6);
        var lng = e.latlng.lng.toFixed(6);

        // تحديث الحقول
        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;

        // إزالة الماركر القديم إن وجد
        if (marker) {
            map.removeLayer(marker);
        }

        // إضافة ماركر جديد
        marker = L.marker([lat, lng]).addTo(map);
    });
 

document.getElementById('get-location-btn').addEventListener('click', function () {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            var lat = position.coords.latitude.toFixed(6);
            var lng = position.coords.longitude.toFixed(6);

            // تعبئة الحقول
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;

            // تركيز الخريطة على الموقع
            map.setView([lat, lng], 13);

            // إزالة الماركر القديم إن وجد
            if (marker) {
                map.removeLayer(marker);
            }

            // إضافة ماركر جديد
            marker = L.marker([lat, lng]).addTo(map);

        }, function (error) {
            alert('⚠️ لم يتم السماح بالوصول إلى الموقع.');
        });
    } else {
        alert('🌐 المتصفح لا يدعم تحديد الموقع.');
    }
});
</script>
@endsection