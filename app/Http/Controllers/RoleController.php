<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Repository\Interfaces\RoleInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Brian2694\Toastr\Facades\Toastr;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    protected $role;

    public function __construct(RoleInterface $role)
    {
        $this->role = $role;
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        if (\request()->ajax()) {
            $roles = $this->role->allRoleList([], '*', []);
            return DataTables::of($roles)
                ->addIndexColumn()
                ->addColumn('role_name', function ($role) {
                    return ucfirst($role->name);
                })
                ->addColumn('guard_name', function ($role) {
                    return ucfirst($role->guard_name);
                })
                ->addColumn('action', function ($role) {
                    return view('admin.access_control.role.action-button', compact('role'));
                })
                ->rawColumns(['status', 'permission_name', 'guard_name', 'action', 'group_name'])
                ->tojson();
        }
        return view('admin.access_control.role.index');
    }

    public function create()
    {

        // if (is_null($this->user) || !$this->user->can('role.create')) {
        //     abort(403, 'Sorry !! You are Unauthorized to create any role !');
        // }

        $data = [
            'model' => new Role,
            'all_permissions' => Permission::get(),
            'permission_groups' => Admin::getpermissionGroups(),
        ];
//dd($data);

        return view('admin.access_control.role.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'required',
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permissions'));

        Toastr::success('Role Information Created Successfully!.', '', ["progressbar" => true]);
        return redirect()->route('admin.role.index');
    }

    public function show($id)
    {
        //
    }

    public function edit(Role $role)
    {
        $data = [
            'model' => $role,
            'all_permissions' => Permission::get(),
            'permission_groups' => Admin::getpermissionGroups(),

        ];
        return view('admin.access_control.role.edit', $data);
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
        ]);

        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permissions'));

        Toastr::success('Role Information crated Successfully!.', '', ["progressBar" => true]);
        return redirect()->route('admin.role.index');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        Toastr::success('Role Deleted Successfully!.', '', ["progressBar" => true]);
        return redirect()->back();

    }
}
