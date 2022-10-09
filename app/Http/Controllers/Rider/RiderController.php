<?php

namespace App\Http\Controllers\Rider;

use App\Models\Role;

use App\Models\Admin\Rider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class RiderController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:rider-list|rider-create|rider-edit|rider-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:rider-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:rider-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:rider-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $data = [
            'riders' => Rider::latest()->get(),
        ];
        return view('rider.access_control.user.index', $data);
    }


    public function create()
    {
        $data = [
            'model' => new Rider(),
            'roles' => Role::where('name', '!=', 'Super rider')->pluck('name', 'id'),
        ];

        return view('rider.access_control.user.create', $data);
    }

    public function store(Request $request)
    {


        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:riders',
            'password' => 'required|string|min:8|confirmed',
            'mobile' => 'required|max:11|min:9'
        ]);

        try {
            DB::beginTransaction();
            $user = new Rider();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->mobile = $request->mobile;
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

    public function show(Rider $rider)
    {
        $data = [
            'model' => $rider,
        ];
        return view('rider.users.show', $data);
    }


    public function edit(Rider $rider)
    {
        $data = [
            'rider' => $rider,
            'roles' => Role::where('name', '!=', 'Super rider')->pluck('name', 'id'),
            'selected_roles' => Role::whereIn('name', $rider->getRoleNames())->pluck('id')
        ];
        return view('rider.access_control.user.edit', $data);
    }


    public function update(Request $request, Rider $rider)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:riders,email,' . $rider->id,
            /* 'password' => 'required|string|min:8|confirmed',*/
        ]);

        try {
            DB::beginTransaction();

            $rider->name = $request->name;
            $rider->email = $request->email;
            $rider->isActive = $request->isActive;
            $rider->mobile = $request->mobile;

            if ($request->get('password')) {
                $rider->password = bcrypt($request->get('password'));
            }
            $rider->save();
            $rider->syncRoles($request->get('roles'));

          


            DB::commit();
            Toastr::success('User Updated Successfully!.', '', ["progressbar" => true]);
            return redirect()->route('rider.index');
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
        $user = Rider::findOrFail($id);
        $user->delete();
        Toastr::success('User Deleted Successfully!.', '', ["progressbar" => true]);
        return redirect()->back();
    }
}
