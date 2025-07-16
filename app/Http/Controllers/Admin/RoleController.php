<?php

namespace App\Http\Controllers\Admin;

 use Spatie\Permission\Models\Role;
 use App\Http\Controllers\Controller;
 use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{

  public function index(){

    $roles = Role::all();

    return view('roles.index' , compact('roles'));
  } //end 


  public function create(){

      $permissions = Permission::all();
    return view('roles.create', compact('permissions'));
  }


  public function store(Request $request){

//  dd(     $request->all()  );


      $request->validate([
        'name' => 'required|string|unique:roles,name',
         'permissions' => 'nullable|array',
        'permissions.*' => 'exists:permissions,name',

      ]);

      


   $role =  Role::create($request->all());

 
    if ($request->has('permissions')) {
        $role->syncPermissions($request->permissions);
    }



      return redirect()->route('roles.index')->with('success' , 'تم اضاقة الرتبه بنجاح');


  }


  public function  edit($id){

    $role = Role::findOrFail($id);
        $permissions = Permission::all();

    return view('roles.edit' , compact('role' ,'permissions'));
  }



  public function update(Request $request , $id){

    $role  = Role::findOrFail($id);

     $validated =   $request->validate([
          'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
         'permissions' => 'nullable|array',
        'permissions.*' => 'exists:permissions,name',
      
      ]);

        $role->update($validated);

        if($request->has('permissions')){
                $role->syncPermissions($request->permissions ?? []);
        }


        return redirect()->route('roles.index')->with('success' , 'تم التحديث بنجاح');

  }

public function destroy($id)
{
    Role::findOrFail($id)->delete();
    return redirect()->back()->with('success', 'تم الحذف بنجاح');
}
 
}
