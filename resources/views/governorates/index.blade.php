@extends('layouts.app')


@section('content')
      <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-12">
                <div class="card mb-4">
                  <div class="card-header"><h3 class="card-title">المحافظات</h3></div>
                  <!-- /.card-header -->
                  <div class="card-body">
                        @if(session('success'))
                         <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <a href="{{ route('governorates.create') }}" type="button" class="btn btn-success mb-2">إضافة محافظة</a>

                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th style="width: 10px">id</th>
                          <th>name</th>
                          <th>Action</th>
                         </tr>
                      </thead>
                      <tbody>
                             @foreach ($governorates as $gov)

                        <tr class="align-middle">
                          <td>{{$gov->id}}</td>
                          <td>{{$gov->name}}</td>
                         <td>
                            <a href="{{ route('governorates.edit' , $gov->id)   }}" type="button" class="btn btn-success mb-2">Edit</a>
                            <form action="{{ route('governorates.destroy', $gov->id) }}" method="POST" style="display:inline-block;">
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
                       {{ $governorates->links() }}

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
