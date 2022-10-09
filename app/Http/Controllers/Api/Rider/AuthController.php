<?php

namespace App\Http\Controllers\Api\Rider;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Admin\Rider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        //       return $request->all();
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|mobile|max:255|unique:riders',
            'password' => 'required|confirmed|min:8',
        ]);
        if ($validator->fails()) {
            return send_error('Validation Error', $validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        DB::beginTransaction();

        try {

            $request['password'] = Hash::make($request['password']);
            $rider = Rider::create([
                'name' => $request['name'],
                'mobile' => $request['mobile'],
                'password' => $request['password'],
            ]);
            $accessToken = $rider->createToken('authToken')->accessToken;
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false, 'errors' => $e->getMessage()], 500);
        }

        $data = [
            'access_token' => $accessToken,
            'userData' => $rider,
        ];
        return send_response('Registration success.', $data, Response::HTTP_CREATED);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            // return send_error('Validation Error',$validator->errors(), 422);
            return response()->json(['success' => false, 'errors' => $validator->errors(),], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if (Auth::guard('rider')->attempt(['mobile' => $request->mobile, 'password' => $request->password])) {
            $rider = Rider::where('mobile', $request->mobile)->first();
          
           
            $accessToken = $rider->createToken('authToken')->accessToken;

            $data = [
                'access_token' => $accessToken,
                'userData' => $rider
            ];
            return send_response('Login successfully.', $data, Response::HTTP_CREATED);
        }

        return response()->json(['success' => false, 'errors' => 'mobile or password incorrect',], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'success' => true,
            'message' => 'Logout successfully'
        ]);
    }
}
