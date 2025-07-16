@extends('front.master')

@section('content')

<div class="donation-requests">
    <div class="all-requests">
         <div class="requests">
                    <div class="head-text">
                        <h2>طلبات التبرع</h2>
                    </div>
                    <div class="content">
                        <form class="row filter" method="GET" action="{{ route('donation.request') }}">
                            <div class="col-md-5 blood">
                                <div class="form-group">
                                    <div class="inside-select">
                                        <select class="form-control" name="bloodTypy" id="exampleFormControlSelect1">
                                            <option selected disabled >اختر فصيلة الدم</option>
                                            @foreach ( $bloodTypys as $bloodTypy )
                                                <option value="{{ $bloodTypy->id }}" {{ request('bloodTypy') == $bloodTypy->id ? 'selected' : '' }} >
                                                    {{$bloodTypy->name}}
                                                </option>
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
                                            @foreach ( $cities as $city )
                                                  <option value="{{ $city->id }}" {{ request('city') == $city->id ? 'selected' : '' }} >
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
                        <div class="patients">
                            @foreach ( $donationRequest as $donation )
                                  <div class="details">
                                <div class="blood-type">
                                    <h2 dir="ltr">{{$donation->bloodType->name}}</h2>
                                </div>
                                <ul>
                                    <li><span>اسم الحالة:</span>{{$donation->patient_name}}</li>
                                    <li><span>مستشفى:</span>{{$donation->hospital_name}}</li>
                                    <li><span>المدينة:</span>{{$donation->city->na}}</li>
                                </ul>
                                <a href="#">التفاصيل</a>
                            </div>
                            @endforeach
                           
                 
                        </div>
                        <div class="pages">
                            <nav aria-label="Page navigation example" dir="ltr">
                              {{ $donationRequest->links()  }}
                            </nav>
                        </div>
                    </div>
                </div>
    </div>
          
</div>
@endsection