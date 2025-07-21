@extends('layouts.app')

@section('content')

<div class="col-12">
  <!--begin::Quick Example-->
  <div class="card card-primary card-outline mb-4">
    <!--begin::Header-->
    <div class="card-header">
      <div class="card-title">Create User</div>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
      <strong>حدثت بعض الأخطاء:</strong>
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST">
      @csrf
      <div class="card-body">
        <div class="mb-3">
          <label class="form-label">Email address</label>
          <input type="email" class="form-control" name="email" />

        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">name</label>
          <input type="password" name="name" class="form-control" />
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" name="password" class="form-control" />
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">password_confirmation</label>
          <input type="password" name="password_confirmation" class="form-control" />
        </div>

        <div class="form-group">
          <label for="role">الدور</label>
          <select name="role" class="form-control" required>
            @foreach($roles as $role)
            <option value="{{ $role->name }}">{{ $role->name }}</option>
            @endforeach
          </select>
        </div>


      </div>
      <!--end::Body-->
      <!--begin::Footer-->
      <div class="card-footer">
        <button class="btn btn-primary">Submit</button>
      </div>
      <!--end::Footer-->
    </form>
    <!--end::Form-->
  </div>

</div>

@endsection