<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function userLogin(Request $request)
    {
        $validation = Validator::make($request->all(),  [
           
            'email'                      => 'required|email',
            'password'                  => 'required',
           
        ]);

        if ($validation->fails()) {
            return response(prepareResult(false, $validation->errors(), trans('validation_failed')), 500,  ['Result'=>'Your data has not been saved']);
        }

       
        try {
            $user = User::where('email',$request->email)->first();

            if (!empty($user)) {
                if (Hash::check($request->password, $user->password)) {

                    $data = [];

                    
                    $data['token'] = $user->createToken('authToken')->accessToken;
                    $data['email'] = $request->email;
                    $permissionData[] =[
                        'action'=>"dashboard",
                        'name'=>"dashboard-view",
                    ];
                    $data['permissions'] =  $permissionData;
                    $userData =[
                        'role'=>"admin"
                    ];
                    $data['user'] =  $userData;
                    // $token = $user->createToken('authToken')->accessToken;
                   
                    // $token = auth()->user()->createToken('authToken')->accessToken;

                    // $info = "Hello world";
                    // return "Hello world";
                    
                return redirect("/dashboard")->with('data', $data); 

                    } else {
                        return response(prepareResult(false, [], trans('message_wrong_password')), 500,  ['Result'=>'message_wrong_password']);
            } 
             } else {
                return response(prepareResult(false, [], trans('message_user_not_found')), 500,  ['Result'=>'message_user_not_found']);    
            }
            
         } catch (\Throwable $e) {
                Log::error($e);
                return response()->json(prepareResult(false, $e->getMessage(), trans('Error while featching Records')), 500,  ['Result'=>'Your data has not been saved']);
            }
   }
}
