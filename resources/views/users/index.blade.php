@extends('layouts.app')


@section('content')
     <div class="col-12">
            @if(session('success'))
                         <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                 <div class="card mb-4">
                      <div class="card-header"><h3 class="card-title">Users</h3></div>
                  <div class="card-header">
                    <h3 class="card-title">
                            <a href="{{ route('users.create') }}" class="btn btn-primary"> Add User</a>
 
                     
                    </h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th style="width: 10px">#</th>
                          <th>name</th>
                          <th>email</th>
                            <th>Role</th>
                          <th style="width: 40px">Action</th>
                         
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ( $users as $user )
                      <tr class="align-middle ">
                          <td>{{$user->id}}</td>
                          <td>{{$user->name}}</td>
                          <td>{{$user->email}}</td>
                          <td>{{ $user->getRoleNames()->first() ?? 'لا يوجد' }}</td>
                          <td class="d-flex">
                            @can('users.edit')
                          <a href="{{ route('users.edit' , $user->id) }}" class="btn btn-success"> Edit</a>

                            @endcan
  

                            @can('users.destroy')
                                <form action="{{ route('users.destroy' , $user->id) }}" method="POST">
                                      @csrf
                                      @method('DELETE')
                                      <button class=" btn btn-danger">DELETE </button>
                                                
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
                {{ $users->links() }}
                  </div>
                </div>
                <!-- /.card -->
             
              </div>
@endsection