<?php

namespace App\Http\Controllers\Merchant;

use App\Models\Role;

use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class   MerchantController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:admin-list|admin-create|admin-edit|admin-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:admin-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:admin-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:admin-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $data = [
            'users' => Merchant::latest()->get(),
        ];
        return view('admin.access_control.user.index', $data);
    }


    public function create()
    {
        $data = [
            'model' => new Merchant(),
            'roles' => Role::where('name', '!=', 'Super Admin')->pluck('name', 'id'),
        ];

        return view('admin.access_control.user.create', $data);
    }

    public function store(Request $request)
    {


        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required|string|min:8|confirmed',
            'mobile' =>  "required|digits:11|regex:/(01)[0-9]{9}/",
        ]);

        try {
            DB::beginTransaction();
            $user = new Merchant();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->isActive = 1;
            $user->save();
            $user->syncRoles($request->get('roles'));


            DB::commit();

            Toastr::success('User Created Successfully!.', '', ["progressbar" => true]);
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
            Toastr::info('Something went wrong!.', '', ["progressbar" => true]);
            return back();
        }
    }

    public function show(Merchant $admin)
    {
        $data = [
            'model' => $admin,
        ];
        return view('admin.users.show', $data);
    }


    public function edit(Merchant $admin)
    {
        $data = [
            'admin' => $admin,
            'roles' => Role::where('name', '!=', 'Super Admin')->pluck('name', 'id'),
            'selected_roles' => Role::whereIn('name', $admin->getRoleNames())->pluck('id')
        ];
        return view('admin.access_control.user.edit', $data);
    }


    public function update(Request $request, Merchant $admin)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            /* 'password' => 'required|string|min:8|confirmed',*/
        ]);

        try {
            DB::beginTransaction();

            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->isActive = $request->isActive;

            if ($request->get('password')) {
                $admin->password = bcrypt($request->get('password'));
            }
            $admin->save();
            $admin->syncRoles($request->get('roles'));
            DB::commit();
            Toastr::success('User Updated Successfully!.', '', ["progressbar" => true]);
            return redirect()->route('admin.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
            $output = [
                'success' => 0,
                'msg' => __("messages.something_went_wrong")
            ];
            Toastr::info('Something went wrong!.', '', ["progressbar" => true]);
            return back();
        }
    }

    public function destroy($id)
    {
        $user = Merchant::findOrFail($id);
        $user->delete();
        Toastr::success('User Deleted Successfully!.', '', ["progressbar" => true]);
        return redirect()->back();
    }
}
