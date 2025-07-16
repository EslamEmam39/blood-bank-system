@extends('layouts.app')

@section('content')
      <div class="col-12">
                <!--begin::Quick Example-->
                <div class="card card-primary card-outline mb-4">
                  <!--begin::Header-->
                  <div class="card-header"><div class="card-title">Update article</div></div>
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
                  <form method="POST" action="{{ route('articles.update', $article->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                           <div class="card-body">
                      <div class="mb-3">
                        <label  class="form-label">article category </label>
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
                    <input type="text" name="title" class="form-control" value="{{ $article->title }}"/>
                      </div>
                    </div>
                          <div class="card-body">
                      <div class="mb-3">
                        <label  class="form-label">content article </label>
                    <input type="text" name="content" class="form-control" value="{{ $article->content }}"/>
                      </div>
                    </div>
                          <div class="card-body">
                      <div class="mb-3">
                        <label  class="form-label">Image Artical</label>
                      <input type="file" name="image" class="form-control"/>
                      </div>
                    </div>

                
             
                    <div class="card-footer">
                         <button class="btn btn-success">تعديل</button>
                    </div>
                  </form>
                </div>
              </div>
              
@endsection