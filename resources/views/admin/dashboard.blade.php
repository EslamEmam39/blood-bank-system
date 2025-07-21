@extends('layouts.app')

@section('content')
<div class="app-content-header">
  <!--begin::Container-->
  <div class="container-fluid">
    <!--begin::Row-->
    <div class="row">
      <div class="col-sm-6">
        <h3 class="mb-0">تطبيق بنك الدم </h3>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
          {{-- <li class="breadcrumb-item"><a href="#">Home</a></li> --}}
          {{-- <li class="breadcrumb-item active" aria-current="page">>تطبيق بنك الدم </li> --}}
        </ol>
      </div>
    </div>
    <!--end::Row-->
  </div>
  <!--end::Container-->
</div>
<div class="app-content">
  <!--begin::Container-->
  <div class="container-fluid">
    <!--begin::Row-->
    <div class="row">
      <!--begin::Col-->
      <div class="col-lg-3 col-6">
        <!--begin::Small Box Widget 1-->
        <div class="small-box text-bg-primary">
          <div class="inner">
            <h3> {{$requestDonations->count()}}</h3> 
            <p>عدد طلبات التبرع</p>
          </div>
    <a href="{{ route('donations.index') }}" class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
            More info <i class="bi bi-link-45deg"></i>
          </a>
        </div>
       </div>
      <!--end::Col-->
      <div class="col-lg-3 col-6">
        <!--begin::Small Box Widget 2-->
        <div class="small-box text-bg-success">
          <div class="inner">
            <h3>{{$articles->count()}}<sup class="fs-5"></sup></h3>
            <p>عدد المقالات</p>
          </div>
   
          <a href="{{ route('articles.index') }}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
            More info <i class="bi bi-link-45deg"></i>
          </a>
        </div>
        <!--end::Small Box Widget 2-->
      </div>
      <!--end::Col-->
      <div class="col-lg-3 col-6">
        <!--begin::Small Box Widget 3-->
        <div class="small-box text-bg-warning">
          <div class="inner">
            <h3>{{ $clients->count() }}</h3>
            <p>عدد العملاء</p>
          </div>
       
          <a href="{{ route('clients.index') }}" class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
            More info <i class="bi bi-link-45deg"></i>
          </a>
        </div>
        <!--end::Small Box Widget 3-->
      </div>
      <!--end::Col-->
      <div class="col-lg-3 col-6">
        <!--begin::Small Box Widget 4-->
        <div class="small-box text-bg-danger">
          <div class="inner">
            <h3>{{$contactUs->count()}}</h3>
            <p>عدد الرسائل</p>
          </div>
       
          <a href="{{ route('contact.index') }}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
            More info <i class="bi bi-link-45deg"></i>
          </a>
        </div>
        <!--end::Small Box Widget 4-->
      </div>
      <!--end::Col-->
    </div>
    <!--end::Row-->
    <!--begin::Row-->
 
  </div>
  <!--end::Container-->
</div>
@endsection