<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin; // If you’re using admin guard
use Illuminate\Support\Facades\Session;

class RoleController extends Controller
{
    function __construct()
    {
        // $this->middleware(function ($request,$next){
        //     $this->user = Auth::guard('admin')->user();
        //     return $next($request);
        // });
        $this->middleware('auth:admin');
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index']]);
        $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $roles = Role::with('permissions')->where('guard_name', 'admin')->get();
        return view('backend.rolepermission.role.index', compact('roles'));
    }

    public function create()
    {
        $all_permission = Permission::where('guard_name', 'admin')->get();
        $permissions_group = Admin::getGroupPermission(); // or your custom logic
        return view('backend.rolepermission.role.create', compact('permissions_group', 'all_permission'));
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|unique:roles,name',
            'permission_name' => 'nullable|array',
            'permission_name.*' => 'string|exists:permissions,name',
        ]);

        $role = Role::create([
            'name' => $request->name,
            'guard_name' => 'admin'
        ]);

        $permissions = $request->input('permission_name');

        if (!empty($permissions)) {
            $role->syncPermissions($permissions);
        }

        Session::flash('success', 'Role successfully created!');
        return redirect()->route('role.index');
    }

    public function edit($id)
    {
        $role = Role::where('guard_name', 'admin')->findOrFail($id);
        $all_permission = Permission::where('guard_name', 'admin')->get();
        $permissions_group = Admin::getGroupPermission(); // custom grouped permissions logic
        return view('backend.rolepermission.role.edit', compact('role', 'all_permission', 'permissions_group'));
    }

    public function update(Request $request, $id)
    {
        $role = Role::where('guard_name', 'admin')->findOrFail($id);

        $request->validate([
            'name' => 'required|string|unique:roles,name,' . $role->id,
            'permission_name' => 'nullable|array',
            'permission_name.*' => 'string|exists:permissions,name',
        ]);

        $role->name = $request->name;
        $role->save();

        $permissions = $request->input('permission_name');

        if (!empty($permissions)) {
            $role->syncPermissions($permissions);
        } else {
            $role->syncPermissions([]); // remove all if empty
        }

        Session::flash('success', 'Role successfully updated!');
        return redirect()->route('role.index');
    }

    public function destroy($id)
    {
        if (!Auth::guard('admin')->user()->can('role-delete')) {
           abort(403, 'Unauthorized action.');
        }

        $role = Role::where('guard_name', 'admin')->findOrFail($id);
        $role->delete();

        Session::flash('success', 'Role successfully deleted!');
        return redirect()->back();
    }
}
