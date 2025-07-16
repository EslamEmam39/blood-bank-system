 @extends('layouts.app')

 @section('content')
 
      <div class=" col-12">
                <div class="card mb-4">
                  <div class="card-header"><h3 class="card-title">Clients</h3></div>
                  <!-- /.card-header -->
                  <div class="card-body">
                        <form method="GET" action="{{ route('clients.index') }}">
                        <input type="text" name="name" placeholder="بحث بالاسم" value="{{ request('name') }}">
                        <input type="text" name="email" placeholder="بحث بالأميل" value="{{ request('email') }}">
                        <select name="is_active">
                        <option value="">-- الحالة --</option>
                        <option value="1" {{ request('is_active') == '1' ? 'selected' : '' }}>مفعل</option>
                        <option value="0" {{ request('is_active') == '0' ? 'selected' : '' }}>غير مفعل</option>
                        </select>
                        <button type="submit">بحث</button>

                        @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        </form>

                    <table class="table table-bordered">
                      <thead>
                        <tr>
                            <th>name</th>
                            <th>email</th>
                            <th>phone</th>
                            <th>Date of birth</th>
                            <th>Blood type</th>
                            <th>Last donation</th>
                            <th>city</th>
                            <th>Registration Date</th>
                            <th>Status</th>
                            <th>Options</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr class="align-middle">
                       @foreach($clients as $client)
        <tr>
            <td>{{ $client->name }}</td>
            <td>{{ $client->email }}</td>
            <td>{{ $client->phone }}</td>
            <td>{{ $client->d_o_b }}</td>
            <td>{{ optional($client->bloodType)->name ?? $client->blood_type_id }}</td>
            <td>{{ $client->Last_date_of_donation }}</td>
            <td>{{ optional($client->city)->name ?? $client->city_id }}</td>
             <td>{{ $client->created_at->format('Y-m-d') }}</td>
            <td>{{ $client->is_active ? 'is_active' : 'Deactivate' }}</td>
            <td>
                <a href="{{ route('clients.toggle', $client->id) }}" class="btn btn-warning btn-sm">
                    {{ $client->is_active ? 'Deactivate' : 'is_active' }}
                </a>
                <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('هل أنت متأكد؟')" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
                        </tr>
               
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer clearfix">
              
              {{ $clients->links() }}
                  </div>
                </div>
                <!-- /.card -->
           
                <!-- /.card -->
              </div>
 
 @endsection