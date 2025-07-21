@extends('layouts.app')

@section('content')
      <div class="col-12">
                <!--begin::Quick Example-->
                <div class="card card-primary card-outline mb-4">
                  <!--begin::Header-->
                  <div class="card-header"><div class="card-title">Update categories</div></div>
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
                  <form method="POST" action="{{ route('categories.update', $category->id)}}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                      <div class="mb-3">
                        <label  class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $category->name }}"/>
                      </div>
                    </div>
             
                    <div class="card-footer">
                         <button class="btn btn-success">حفظ</button>
                    </div>
                  </form>
                </div>
              </div>
              
@endsection