<?php

namespace App\Http\Controllers\Merchant\Auth;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Merchant;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Brian2694\Toastr\Facades\Toastr;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data = [
            'areas' => Area::all()
        ];
        return view('merchant.auth.register', $data);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    { 
        
          
        $request->validate([
            'company_name' => 'required|string|max:255',
            'area_id' => 'required',
            'name' => 'required|string|max:255',
            'mobile' =>  "required|unique:merchants|digits:11|regex:/(01)[0-9]{9}/",
            'email' => 'required|string|email|max:255|unique:merchants',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
    
        $user = Merchant::create([
            'company_name' => $request->company_name,
            'area_id' => $request->area_id,
            'mobile' => $request->mobile,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
       
        Toastr::success('Registration Successfully Completed !.', '', ["progressBar" => true]);
        return redirect()->back();
        // event(new Registered($user));

        // Auth::guard('merchant')->login($user);

        //return redirect(RouteServiceProvider::MERCHANTHOME);
    }
}
