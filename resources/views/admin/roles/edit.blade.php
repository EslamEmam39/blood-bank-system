@extends('layouts.app')

@section('content')

<div class="col-12">
    <!--begin::Quick Example-->
    <div class="card card-primary card-outline mb-4">
        <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">update Role</div>
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
        <form action="{{ route('role.update' , $role->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Role name</label>
                    <input type="text" class="form-control" name="name" value="{{ $role->name }}" />

                </div>

                 <div class="form-group">
                    <label>الصلاحيات</label>
                    <div class="row">
                        @foreach($permissions as $permission)
                        <div class="col-md-3">
                            <label>
                                <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                            
                                {{ $permission->name }}
                            </label>
                        </div>
                        @endforeach
                    </div>
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