<?php

namespace App\Http\Controllers\Rider;

use App\Http\Controllers\Controller;
use App\Http\Requests\Rider\RiderSettingsRequest;
use App\Repository\Interfaces\RiderInterface;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    protected $riderRepo;
    public function __construct(RiderInterface $rider)
    {
        $this->riderRepo = $rider;
    }

    public function index()
    {
        $data = [
            'rider' => $this->riderRepo->riderDetailsById(['assign_areas', 'assign_areas.sub_area'], auth('rider')->user()->id),
        ];
        return view('rider.settings.index', $data);
    }

    public function passwordReset(RiderSettingsRequest $request){
        if (! Hash::check($request->old_password, auth('rider')->user()->password)) {
            return response()->errorRedirect('sorry password does not match', '');
        }else{
            if(Hash::check($request->new_password, auth('rider')->user()->password)){
                return response()->errorRedirect('Opp! You enter your old password', '');
            }else{
                $this->riderRepo->updateRider(['password'=>bcrypt($request->new_password)], auth('rider')->user());
                return response()->successRedirect('Your password reset successfully', '');
            }
        }
    }
}
