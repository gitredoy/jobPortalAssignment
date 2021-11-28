<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\GeneralUserLoginRequest;
use App\Http\Requests\GeneralUserRegistrationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class GeneralUserController extends Controller
{
   public function registration(GeneralUserRegistrationRequest $request){
       try {
           $user = new User();
           $user->name = $request->name;
           $user->email = $request->email;
           $user->phone = $request->phone;
           $user->password = \Hash::make($request->password);
           $user->save();
           return response()->json([
               'success' => true,
               'message' => 'Registration Successfully Done',
               'account' => $user
           ], 200);
       }catch (\Exception $exception){
           return response()->json([
               'success' => false,
               'message' => $exception->getMessage(),
           ], 404);
       }
   }

    public function login(GeneralUserLoginRequest $request)
    {
        try {
            $type = filter_var($request->email_or_phone, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
            $user = User::where($type,$request->email_or_phone)->first();
            if ($user) {
                $credentials = [
                    $type => $request['email_or_phone'],
                    'password' => $request['password'],
                ];
                if(Auth::attempt($credentials) ){
                    $user = Auth::user();
                    $token =  $user->createToken('MyApp')-> accessToken;
                    $data = array(
                        'success' => true,
                        'message' =>  'Logged in Successfully',
                        'data' => ['user' => $user],
                        'token' => $token
                    );
                    return response()->json($data, 200);

                }else{
                    $data = array(
                        'success' => false,
                        'message' =>  'Password mismatch',
                    );
                    return response($data, 422);
                }
            }else {
                $data = array(
                    'success' => false,
                    'message' =>  'Credential does not match',
                );
                return response($data, 422);
            }
        }catch (\Exception $exception){
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
            ], 404);
        }


    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }




}
