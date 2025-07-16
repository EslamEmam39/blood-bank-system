@extends('layouts.app')


@section('content')
      <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-12">
                <div class="card mb-4">
                  <div class="card-header"><h3 class="card-title">articles</h3></div>
                  <!-- /.card-header -->
                  <div class="card-body">
                        @if(session('success'))
                         <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <a href="{{ route('articles.create') }}" type="button" class="btn btn-success mb-2">إضافة مقاله</a>

                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th style="width: 10px">id</th>
                          <th>title</th>
                          <th>content</th>
                          <th>category_ID</th>
                          <th>image</th>
                                      <th>تاريخ النشر</th>

                          <th>Action</th>
                         </tr>
                      </thead>
                      <tbody>
                             @foreach ($articles as $article)

                        <tr class="align-middle">
                          <td>{{$article->id}}</td>
                          <td>{{$article->title}}</td>
                          <td>{{$article->content}}</td>
                           <td>{{$article->category->name}}</td>
                         <td><img src="{{ asset('storage/' . $article->image) }}" width="100"></td>
                                <td>{{ $article->created_at->format('Y-m-d') }}</td>

                         <td>
                            <a href="{{ route('articles.edit' , $article->id)   }}" type="button" class="btn btn-success mb-2">Edit</a>
                            <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mb-2" onclick="return confirm('هل أنت متأكد من الحذف؟')">Delete</button>
                            </form>                    
                             </td>
                         </tr>
                    @endforeach
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                       {{ $articles->links() }}

                </div>
                <!-- /.card -->
              
                <!-- /.card -->
              </div>
              <!-- /.col -->
           
              <!-- /.col -->
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
@endsection
