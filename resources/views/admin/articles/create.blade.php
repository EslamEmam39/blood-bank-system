@extends('layouts.app')

@section('content')
      <div class="col-12">
                <!--begin::Quick Example-->
                <div class="card card-primary card-outline mb-4">
                  <!--begin::Header-->
                  <div class="card-header"><div class="card-title">Create articles</div></div>
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
                  <form method="POST" action="{{ route('articles.store')}}" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                      <div class="mb-3">
                        <label  class="form-label">Artical category </label>
                            <select name="category_id" class="form-control">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                            </select>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="mb-3">
                        <label  class="form-label">title Artical</label>
                    <input type="text" name="title" class="form-control"/>
                      </div>
                    </div>
                              <div class="card-body">
                      <div class="mb-3">
                        <label  class="form-label">content Artical</label>
                    <input type="text" name="content" class="form-control"/>
                      </div>
                    </div>

                          <div class="card-body">
                      <div class="mb-3">
                        <label  class="form-label">Image Artical</label>
                    <input type="file" name="image" class="form-control"/>
                      </div>
                    </div>
                     
             
                    <div class="card-footer">
                         <button class="btn btn-success">حفظ</button>
                    </div>
                  </form>
                </div>
              </div>
              
@endsection