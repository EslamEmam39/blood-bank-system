@extends('layouts.app')

@section('content')
      <div class="col-12">
                <!--begin::Quick Example-->
                <div class="card card-primary card-outline mb-4">
                  <!--begin::Header-->
                  <div class="card-header"><div class="card-title">Create City</div></div>
                  <!--end::Header-->
                  <!--begin::Form-->

                @if ($errors->any())
                 <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                        @endforeach
                        </ul>
                     </div>
                    @endif
                  <form method="POST" action="{{ route('cities.store')}}">
                    @csrf
                    <div class="card-body">
                      <div class="mb-3">
                        <label  class="form-label">Name City</label>
                    <input type="text" name="name" class="form-control"/>
                      </div>
                    </div>
                        <div class="card-body">
                      <div class="mb-3">
                        <label  class="form-label">Name Governorate </label>
                            <select name="governorate_id" class="form-control">
                            @foreach($governorates as $gov)
                                <option value="{{ $gov->id }}">{{ $gov->name }}</option>
                            @endforeach
                            </select>
                      </div>
                    </div>
             
                    <div class="card-footer">
                         <button class="btn btn-success">حفظ</button>
                    </div>
                  </form>
                </div>
              </div>
              
@endsection