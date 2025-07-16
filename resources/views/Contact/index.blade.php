@extends('layouts.app')
@section('content')
     <div class="col-12">
               
                <!-- /.card -->
        <div class="card mb-4 shadow-sm">
                        <form action="{{ route('contact.index') }}" method="GET" class="row g-2 mb-3">
            <div class="col-md-4">
                <input
                    type="text"
                    name="name"
                    class="form-control"
                    placeholder="بحث بالاسم"
                    value="{{ request('name') }}"
                >
            </div>

            <div class="col-md-auto">
                <button type="submit" class="btn btn-warning">
                    <i class="fas fa-search"></i> بحث
                </button>
            </div>
            </form>
    <div class="card-header bg-dark text-white">
        <h3 class="card-title mb-0">رسائل"اتصل بنا"</h3>
    </div>
 
    <div class="card-body p-0">
 

         <table class="table table-hover table-striped align-middle text-center">
            <thead class="table-light">
                <tr>
                    <th style="width: 50px;">رقم</th>
                    <th> عنوان الرسالة</th>
                    <th>نص الرسالة</th>
                    <th style="width: 150px;">العميل</th>
                    <th>اجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($messages  as $val)
                    <tr>
                        <td>{{ $val->id }}</td>
                        <td class="fw-bold">{{ $val->title }}</td>
                        <td class="text-start">
                            <p class="mb-0 text-wrap" style="max-width: 400px;">{{ $val->message }}</p>
                        </td>
                        <td>
                            <span class="badge bg-info text-dark">{{ $val->client->name }}</span>
                        </td>
                        <td>
                            <form action="{{ route('contact.destroy' ,$val->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $messages->links() }}
    </div>
</div>

                <!-- /.card -->
              </div>

@endsection