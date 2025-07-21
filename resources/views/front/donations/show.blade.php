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
                    <div class="form-group mb-3">
                        <label class="fw-bold">اسم المريض:</label>
                        <div class="form-control-plaintext">{{ $donationRequest->patient_name }}</div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="fw-bold">اسم المستشفى:</label>
                        <p class="form-control-plaintext">{{ $donationRequest->hospital_name }}</p>
                    </div>
                    <div class="form-group mb-3">
                        <label class="fw-bold">عنوان المستشفى:</label>
                        <p class="form-control-plaintext">{{ $donationRequest->hospital_address }}</p>
                    </div>
                    <div class="form-group mb-3">
                        <label class="fw-bold">عمر المريض:</label>
                        <p class="form-control-plaintext">{{ $donationRequest->patient_age }}</p>
                    </div>
                    <div class="form-group mb-3">
                        <label class="fw-bold">عدد أكياس الدم:</label>
                        <p class="form-control-plaintext">{{ $donationRequest->bags_num }}</p>
                    </div>

                    <div class="form-group mb-3">
                        <label class="fw-bold">المدينة:</label>
                        <p class="form-control-plaintext">{{ $donationRequest->city->name ?? '---' }}</p>
                    </div>


                    <div class="form-group mb-3">
                        <label class="fw-bold">فصيلة الدم:</label>
                        <p class="form-control-plaintext">{{ $donationRequest->bloodType->name ?? '---' }}</p>
                    </div>


                    <div class="form-group mb-3">
                        <label class="fw-bold">رقم الهاتف:</label>
                        <p class="form-control-plaintext">{{ $donationRequest->phone }}</p>
                    </div>

                    <div class="form-group mb-3">
                        <label class="fw-bold">وصف المريض:</label>
                        <p class="form-control-plaintext">{{ $donationRequest->notes }}</p>
                    </div>
                    @if ($donationRequest->latitude && $donationRequest->longitude)
                    <div class="form-group">
                        <label>موقع التبرع على الخريطة:</label>
                        <div id="map" style="height: 400px;"></div>
                    </div>
                    @else
                    <p> هذا الطلب غير محدد موقعًا. لا يوجد موقع محدد لهذا الطلب.</p>
                    @endif





                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var lat = {{ $donationRequest->latitude ?? 0 }};
        var lng = {{ $donationRequest->longitude ?? 0 }};

        // إنشاء الخريطة
        var map = L.map('map').setView([lat, lng], 13);

    
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // وضع ماركر في موقع التبرع
        L.marker([lat, lng]).addTo(map)
            .bindPopup('موقع التبرع')
            .openPopup();
    });
</script>

@endsection