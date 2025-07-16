@extends('layouts.app')


@section('content')
     <div class="col-12">
                <div class="card mb-4">
                  <div class="card-header"><h3 class="card-title">Donations Request</h3></div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    @if (session('success'))
                         <div class="alert alert-success">{{ session('success') }}</div>
                        
                    @endif
 
                    <table class="table table-bordered">
                      <thead>
                        <tr>
       
                          <th>patient_name</th>
                          <th>patient_age</th>
                          <th>blood_type_id</th>
                          <th>bags_num</th>
                          <th>hospital_name</th>
                          <th>hospital_address</th>
                          <th>city_id</th>
                          <th>phone</th>
                          <th >notes</th>
                         </tr>
                      </thead>
                      <tbody>
       
                @foreach ($donations as $val )
                     <tr class="align-middle">
                
                          <td>{{$val->patient_name}}</td>
                          <td>{{$val->patient_age}}</td>
                          <td>{{$val->bloodType->name}}</td>
                          <td>{{$val->bags_num}}</td>
                          <td>{{$val->hospital_name}}</td>
                          <td>{{$val->hospital_address}}</td>
                          <td>{{$val->city->name ?? null}}</td>
                          <td>{{$val->phone}}</td>
                          <td><p class="text-wrap">{{$val->notes}}</p> </td>  
                        </tr>
                        @endforeach
                       
                       
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer clearfix">
                  
                   </div>
                </div>
                <!-- /.card -->
     
              </div>


@endsection