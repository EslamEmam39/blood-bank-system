@extends('layouts.app')


@section('content')
<div class="col-12">
  @if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  <div class="card mb-4">
        <div class="card-header"><h3 class="card-title">Roles</h3></div>
    <div class="card-header">
      <h3 class="card-title">
        <a href="{{ route('role.create') }}" class="btn btn-primary"> Add Role</a>


      </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th style="width: 10px">#</th>
            <th>name</th>
            <th>guard_name</th>
            <th style="width: 40px">Edit</th>
            <th style="width: 40px">Delete</th>
          </tr>
        </thead>
        <tbody>
          @foreach ( $roles as $role )
          <tr class="align-middle ">
            <td>{{$role->id}}</td>
            <td>{{$role->name}}</td>
            <td>{{$role->guard_name}}</td>
         
               <td class="d-flex">
                    @can('role.edit')
              <a href="{{ route('role.edit' , $role->id) }}" class="btn btn-success"> Edit</a>
                   @endcan
            </td>
        
            
            <td>
              @can('role.destroy')
                     <form action="{{ route('roles.destroy', $role->id) }}" method="POST"
                        onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">حذف</button>
                      </form>
              @endcan
          
            </td>

          </tr>
          @endforeach


        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix">
      {{-- {{ $users->links() }} --}}
    </div>
  </div>
  <!-- /.card -->

</div>
@endsection