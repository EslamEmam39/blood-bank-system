<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class ChangePasswordController extends Controller
{
   public function edit()
{
   $user = auth()->user();
   
    return view('auth.change-password' , compact('user'));
}

public function update(Request $request)
{

// dd(    $request->all());

    $request->validate([
        'current_password' => 'required',
        'password' => 'required|confirmed|min:8',
    ]);
 

    if (!Hash::check($request->current_password, auth()->user()->password)) {
        return back()->withErrors(['current_password' => 'كلمة المرور الحالية غير صحيحة']);
    }

    auth()->user()->update(['password' => bcrypt($request->password)]);
    return redirect()->route('dashboard')->with('success', 'تم تغيير كلمة المرور بنجاح');
}
}
