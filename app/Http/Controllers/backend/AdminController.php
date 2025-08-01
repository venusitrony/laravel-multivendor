<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    function __construct()
    {
        // $this->middleware(function ($request,$next){
        //     $this->user = Auth::guard('admin')->user();
        //     return $next($request);
        // });
        $this->middleware('auth:admin');
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        
        $admins = Admin::with('roles')->get();
        return view('backend/rolepermission/admin.index', compact('admins'));
    }

    static public function create()
    {
        $roles=Role::all();
        return view('backend/rolepermission/admin.create',compact('roles'));
    }


    public function store(Request $request){

        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email|unique:admins,email',
        //     'password' => 'required|min:6|confirmed', // confirmed মানে 'password_confirmation' চাই
        //     'role_name' => 'nullable|string|exists:roles,name' // optional but must match a role name
        // ]);

        $admin = new Admin;
        $admin->name=$request->name;
        $admin->username=$request->name;
        $admin->email=$request->email;
        $admin->password=Hash::make($request->password);
        $admin->save();
                   
        if($request->role_name){
           $admin->assignRole($request->role_name);
        }
                 
        session()->flash('success','Admin Successpully Created');
        return redirect('admin/admins');
    }

    public function edit($id)
    {
        $roles = Role::all();
        $admin =Admin::find($id);
        return view('backend/rolepermission/admin.edit', compact( 'roles', 'admin'));
    }

public function update(Request $request, $id)
{
    $admin = Admin::findOrFail($id);


    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:admins,email,' . $admin->id,
        'password' => 'nullable|string|min:6|confirmed', // <-- 'confirmed' means it will check password_confirmation field
        'role_name' => 'nullable|array',
        'role_name.*' => 'exists:roles,name',
    ]);

    $admin->name = $request->name;
    $admin->email = $request->email;

    if ($request->password) {
        $admin->password = Hash::make($request->password);
    }

    $admin->save();

    if ($request->has('role_name')) {
        $admin->syncRoles($request->input('role_name'));
    } else {
        $admin->syncRoles([]); // remove all roles if none selected
    }

    // $admin->roles()->detach();
    //  if ($request->role_name){
    //     $admin->assignRole($request->role_name);
    // }
 
    return redirect()->route('admin.index')->with('status', 'Admin updated successfully');
}



    public static function destroy(Request $request,$id)
    {
       $admin =  Admin::find($id);
    

       if (!is_null($admin)) {
        $admin->delete();
       }
        return back()->with('status','Admin Successpully Deleted');
    }
}
