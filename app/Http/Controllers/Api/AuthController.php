<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => "error",
                "message" => $validator->errors()->first()
            ], 422);
        }
        // $credentials = $request->only('email', 'password');
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('login')->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'Brand Login Successfully!',
                // 'user' => $user,
                'token' => $token,
            ],200);
        }
        return response()->json([
            "status" =>"fail",
            "message" => "user unable to login"
        ]);
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'brand_name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => "error",
                "message" => $validator->errors()->first()
            ], 422);
        }

        $user = new User;
        $user->brand_name=$request->brand_name;
        $user->email=$request->email;
        $user->user_type= 'brand';
        $user->password=Hash::make($request->password);
        $user->save();

        return response()->json([
            "status" =>"success",
            "message" => "brand registered successfully"
        ]);
    }
    public function logout()
    {
      $user= Auth::user();
      if($user)
      {
        $user->tokens()->delete();
        return response()->json([
            "status" =>"success",
            "message" => "user logout successfully"
        ]);
      }
      else
      {
        return response()->json([
            "status" =>"failed",
            "message" => "unable to logout"
        ]);
      }
    }
}
