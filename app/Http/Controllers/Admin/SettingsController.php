<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminSettingsRequest;
use App\Models\Admin;
use App\Repository\Interfaces\AdminInterface;
use App\Repository\Interfaces\FileInterface;
use App\Repository\Repos\FileRepo;
use App\services\UploadFileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class SettingsController extends Controller
{
    protected $adminRepo;
    protected $fileRepo;
    public function __construct(AdminInterface $admin, FileInterface $file)
    {
        $this->adminRepo = $admin;
        $this->fileRepo = $file;
    }

    public function settings(){
        $data['admin'] = $this->adminRepo->getAnInstance(auth('admin')->user()->id);
        return view('admin.settings.index', $data);
    }

    public function profileSettings(AdminSettingsRequest $request, UploadFileService $service){
        return $request->all();
        try{
            DB::beginTransaction();
            //$this->adminRepo->updateAdmin($request->only(['name', 'email', 'mobile']), auth('admin')->user());
            if($request->has(file('profile_pic'))){
                return 'ok';
                //$file = $this->fileRepo->getSingleFile(['file_id'=>auth('admin')->user()->id, 'file_type'=>Admin::class]);
//                if(isset($file)){
//                    $service->updateFile($file, 'profile_pic');
//                }else{
//                    $service->addFile('profile_pic', auth('admin')->user()->id, Admin::class);
//                }
            }else{
                return 'not';
            }
            DB::commit();
            return response()->successRedirect('Your Account Updated successfully', '');
        }catch (\Exception $exception){
           DB::rollBack();
           Log::info($exception->getMessage());
            return response()->errorRedirect('Something Wrong', '');
        }
    }

    public function passwordReset(AdminSettingsRequest $request){
        if (! Hash::check($request->old_password, auth('admin')->user()->password)) {
            return response()->errorRedirect('sorry password does not match', '');
        }else{
            if(Hash::check($request->new_password, auth('admin')->user()->password)){
                return response()->errorRedirect('Opp! You enter your old password', '');
            }else{
                $this->adminRepo->updateAdmin(['password'=>bcrypt($request->new_password)], auth('admin')->user());
                return response()->successRedirect('Your password reset successfully', '');
            }
        }
    }
}
