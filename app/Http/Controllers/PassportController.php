<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class PassportController extends Controller
{
    public $successStatus = 200;

    public function register(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
	
		if ($validator->fails()) {
            return response()->json([
            	'success' => false,
            	'error'=>$validator->errors()
            ], 401);            
        }
		
		$input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
		
		return response()->json(['success'=>$success], $this->successStatus);
    }

    public function login()
    {
    	if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $token =  $user->createToken('MyApp');
            // ->accessToken;

            $user->token = $token->accessToken;
            // return response()->json(['success' => $success,'role' => $user->role], $this->successStatus);
            return response()->json($user, $this->successStatus);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }

    public function getDetails()
    {
    	$user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }
}
