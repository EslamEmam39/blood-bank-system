@extends('layouts.app')

@section('content')

<div class="col-12">
    <!--begin::Quick Example-->
    <div class="card card-primary card-outline mb-4">
        <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">Create Role</div>
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
        <form action="{{ route('role.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Role name</label>
                    <input type="text" class="form-control" name="name" />

                </div>
                <div class="form-group">
                      
                    <label>الصلاحيات</label><br>
                       <input id="select-all" type="checkbox">
                   <label for="select-all">تحديد الكل</label>
 
                    <div class="row">
                        @foreach($permissions as $permission)
                        <div class="col-md-3">
                            <label>
                       <input type="checkbox" name="permissions[]" class="permission-checkbox" value="{{ $permission->name }}">

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

            @push('scripts')
                <script>
         
    $(document).ready(function () {
    
           $("#select-all").click(function () {
            $(".permission-checkbox").prop("checked", $(this).prop("checked"));
        });
    });
                        
                </script>
            @endpush
            <!--end::Footer-->
        </form>
        <!--end::Form-->
    </div>

</div>

@endsection