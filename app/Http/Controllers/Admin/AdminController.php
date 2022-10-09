<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AdminRequest;
use App\Models\Role;

use App\Models\Admin;
use App\Repository\Interfaces\AdminInterface;
use App\Repository\Interfaces\HubInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    protected $hubRepo;
    protected $adminRepo;
    public function __construct(HubInterface $hub, AdminInterface $admin)
    {
        $this->middleware('permission:admin-list|admin-create|admin-edit|admin-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:admin-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:admin-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:admin-delete', ['only' => ['destroy']]);
        $this->hubRepo = $hub;
        $this->adminRepo = $admin;
    }
    public function index()
    {
        $admins = $this->adminRepo->allLatestUser();
        if (\request()->ajax()) {
            return DataTables::of($admins)
                ->addIndexColumn()

                ->addColumn('role_info', function ($admin) {
                    return view('admin.access_control.user.role', compact('admin'));
                })
                ->addColumn('status', function ($admin) {
                    switch ($admin->isActive){
                        case 1:
                            return '<div class="badge badge-success">Active</div>';
                        case 0:
                            return '<div class="badge badge-danger">Inactive</div>';
                    }
                })
                ->addColumn('action', function ($admin) {
                    return view('admin.access_control.user.action-button', compact('admin'));
                })
                ->rawColumns(['status', 'role_info', 'action'])
                ->tojson();
        }
        return view('admin.access_control.user.index');
    }


    public function create()
    {
        $data = [
            'hubs'=>$this->hubRepo->getHubList(),
            'roles' => Role::where('name', '!=', 'Super Admin')->where('name', '!=', 'Developer')->pluck('name', 'id'),
        ];

        return view('admin.access_control.user.create', $data);
    }

    public function store(AdminRequest $request)
    {
        try {
            DB::beginTransaction();
            $data=$request->only(['name', 'hub_id', 'email', 'mobile']);
            $data['password'] = bcrypt($request->password);
            $user = $this->adminRepo->createAdmin($data);
            $user->assignRole($request->get('roles'));
            DB::commit();
            return response()->successRedirect('New user created!','admin.admin.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
            return response()->errorRedirect('Opps Something wrong!','admin.admin.index');
        }
    }

    public function show(Admin $admin)
    {
        $data = [
            'model' => $admin,
        ];
        return view('admin.users.show', $data);
    }


    public function edit(Admin $admin)
    {
        $data = [
            'admin' => $admin,
            'hubs'=>$this->hubRepo->getHubList(),
            'roles' => Role::where('name', '!=', 'Super Admin')->pluck('name', 'id'),
            'selected_roles' => Role::whereIn('name', $admin->getRoleNames())->pluck('id')
        ];
        return view('admin.access_control.user.edit', $data);
    }


    public function update(AdminRequest $request, Admin $admin)
    {
        try {
            DB::beginTransaction();
            $data = $request->except(['password', 'roles']);
            $data['password'] =bcrypt($request->password);
            $this->adminRepo->updateAdmin($data, $admin);
            $admin->syncRoles($request->get('roles'));
            DB::commit();
           return response()->successRedirect('Info Updated!','admin.admin.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
            return response()->errorRedirect('Opps Something wrong!','admin.admin.index');
        }
    }

    public function destroy(Admin $admin)
    {
        $this->adminRepo->deleteAdmin($admin);
        return response()->successRedirect('Info Deleted!','admin.admin.index');
    }

    public function login($adminId){
        $data['admin'] = \auth('admin')->loginUsingId($adminId);
        session(['loggedIn-from-admin' => true]);
        return redirect()->route('admin.dashboard');
    }

    public function passwordReset($adminId){
        $admin = $this->adminRepo->getAnInstance($adminId);
        $this->adminRepo->updateAdmin(['password'=>bcrypt('12345678')], $admin);
        return response()->successRedirect('Password Reset','admin.admin.index');
    }
}
