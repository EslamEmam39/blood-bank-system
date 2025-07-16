@extends('layouts.app')

@section('content')
     <div class="col-12">
                <div class="card mb-4">
         
               
                  <div class="card-header"><h3 class="card-title">Donations Request</h3></div>
                  <!-- /.card-header -->
                <div class="card mb-4 shadow-sm">
                    <form action="{{ route('donations.index') }}" method="GET" class="row g-2 mb-3">
                      <div class="col-md-4">
                    <input 
                        class="form-control"
                        type="text" 
                        name="name" 
                        placeholder="name" 
                        value="{{ request('name') }}"
                        >
                      </div>
                    
                        <div class="col-md-auto">
                            <button class="btn btn-warning"> Search</button>    
                        </div>
                        
                    </form>
                    </div>
                  <div class="card-body">
                    
                    @if (session('success'))
                         <div class="alert alert-success">{{ session('success') }}</div>
                        
                    @endif
                    <table class="table table-bordered align-middle table-md">
                      <thead>
                        <tr>
                          <th style="width: 10px">#id</th>
                          <th style="width: 10px">#username</th>
                          <th style="width: 10px">donation_requests_count </th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                 @foreach ($clients as $val )
                     <tr class="align-middle">
                          <td>{{$val->id}}</td>
                          <td>{{$val->name}}</td>
                        <td>{{ $val->donationrequests->count() }}</td>

                          <td style="display:flex">
                            <form action="{{ route('donations.destroy' , $val->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button  class="btn btn-danger">Delete</button>
                            </form>
                            <a class="btn btn-success" href="{{route('donations.show' , $val->id) }}">Show</a>
                         </td>
                        </tr>
                        @endforeach
                       
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer clearfix">
                        {{ $clients->withQueryString()->links() }}        
                    </div>
                </div>
                <!-- /.card -->
     
              </div>

@endsection