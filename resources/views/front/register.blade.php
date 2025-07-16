@extends('front.master')

@section('content')
         <!--form-->
        <div class="form py-5">
    <div class="container">
        <div class="path mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-light p-2 rounded">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">الرئيسية</a></li>
                    <li class="breadcrumb-item active" aria-current="page">إنشاء حساب جديد</li>
                </ol>
            </nav>
        </div>

        <div class="account-form bg-white p-4 rounded shadow-sm">
                              @if ($errors->any())
                 <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                        @endforeach
                        </ul>
                     </div>
                    @endif
            <form method="POST" action="{{ route('client.register.submit') }}">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <input type="text" name="name" class="form-control" placeholder="الاسم الكامل">
                    </div>

                    <div class="col-md-6 mb-3">
                        <input type="email" name="email" class="form-control" placeholder="البريد الإلكتروني">
                    </div>

                    <div class="col-md-6 mb-3">
                        <input type="text" name="birth_date" class="form-control" placeholder="تاريخ الميلاد" onfocus="this.type='date'">
                    </div>

                    <div class="col-md-6 mb-3">
                        <select name="blood_type_id" class="form-control">
                            <option selected disabled hidden>فصيلة الدم</option>
                            @foreach ( $bloodTypies as $bloodType )
                                    <option value="{{ $bloodType->id }}">{{ $bloodType->name }}</option>
                            @endforeach
                         
                       
                            <!-- باقي الفصائل -->
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <select class="form-control" id="governorates" name="governorate_id">
                            <option selected disabled hidden>المحافظة</option>

                            @foreach ($governorates as $gov )
                             <option value="{{ $gov->id }}"> {{$gov->name}}</option>
                            @endforeach
           
                         
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <select class="form-control" id="cities" name="city_id">
                            <option selected disabled hidden>المدينة</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <input type="text" name="phone" class="form-control" placeholder="رقم الهاتف">
                    </div>

                    <div class="col-md-6 mb-3">
                        <input type="text" name="donation_last_date" class="form-control" placeholder="آخر تاريخ تبرع" onfocus="this.type='date'">
                    </div>

                    <div class="col-md-6 mb-3">
                        <input type="password" name="password" class="form-control" placeholder="كلمة المرور">
                    </div>

                    <div class="col-md-6 mb-3">
                        <input type="password" name="password_confirmation" class="form-control" placeholder="تأكيد كلمة المرور">
                    </div>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success px-5">إنشاء</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let governorateSelect = document.getElementById('governorates');
        let citySelect = document.getElementById('cities');

        governorateSelect.addEventListener('change', function () {
            let governorateId = this.value;

            fetch(`/cities/${governorateId}`)
                .then(response => response.json())
                .then(data => {
                    citySelect.innerHTML = '<option selected disabled hidden>المدينة</option>';
                    for (const id in data) {
                        citySelect.innerHTML += `<option value="${id}">${data[id]}</option>`;
                    }
                });
        });
    });
</script>
@endsection