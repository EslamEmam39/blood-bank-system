@extends('layouts.app')

@section('content')
<div class="  d-flex justify-content-center align-items-center">
    @if (session('success'))
        <span>{{session('success')}}</span>
    @endif
       <div class="col-md-6 ">
                <!--begin::Quick Example-->
                <div class="card card-primary card-outline mb-4">
                  <!--begin::Header-->
                  <div class="card-header"><div class="card-title">Change password</div></div>
                  <!--end::Header-->
                  <!--begin::Form-->
                  <form method="POST" action="{{ route('admin.password.update' , $user->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">current_password</label>
                        <input type="password" name="current_password" class="form-control" id="exampleInputPassword1" />
                      </div>
                      @error('current_password')
                           <div class="text-danger">{{ $message }}</div>
                      @enderror
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" />
                      </div>
                        @error('password')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror

                     <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">password_confirmation</label>
                        <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword1" />
                      </div>
                           @error('password_confirmation')
                         <div class="text-danger">{{ $message }}</div>
                         @enderror
                    </div>
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <!--end::Footer-->
                  </form>
                  <!--end::Form-->
                </div>
   
              </div>
</div>

@endsection