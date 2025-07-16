@extends('layouts.app')


@section('content')
      <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-12">
                <div class="card mb-4">
                  <div class="card-header"><h3 class="card-title">المدن</h3></div>
                  <!-- /.card-header -->
                  <div class="card-body">
                        @if(session('success'))
                         <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <a href="{{ route('cities.create') }}" type="button" class="btn btn-success mb-2">إضافة مدينه</a>

                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th style="width: 10px">id</th>
                          <th>name</th>
                          <th>governorateid</th>
                          <th>Action</th>
                         </tr>
                      </thead>
                      <tbody>
                             @foreach ($cities as $city)

                        <tr class="align-middle">
                          <td>{{$city->id}}</td>
                          <td>{{$city->name}}</td>
                          <td>{{$city->governorate->name}}</td>
                         <td>
                            <a href="{{ route('cities.edit' , $city->id)   }}" type="button" class="btn btn-success mb-2">Edit</a>
                            <form action="{{ route('cities.destroy', $city->id) }}" method="POST" style="display:inline-block;">
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
                       {{ $cities->links() }}

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
