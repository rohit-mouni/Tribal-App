<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Mail\ForgetPasswordOtpMail;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => "error",
                "message" => $validator->errors()->first()
            ], 422);
        }
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('login')->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'Login Successfully!',
                'token' => $token,
            ], 200);
        }
        return response()->json([
            "status" => "fail",
            "message" => "wrong credentials"
        ]);
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'brand_name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => "error",
                "message" => $validator->errors()->first()
            ], 422);
        }

        $user = new User;
        $user->brand_name = $request->brand_name;
        $user->email = $request->email;
        $user->user_type = 'brand';
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            "status" => "success",
            "message" => "brand registered successfully"
        ]);
    }
    public function logout()
    {
        $user = Auth::user();
        if ($user) {
            $user->tokens()->delete();
            return response()->json([
                "status" => "success",
                "message" => "user logout successfully"
            ]);
        }
        return response()->json([
            "status" => "failed",
            "message" => "please login first"
        ]);
    }
    public function forgetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => "error",
                "message" => $validator->errors()->first()
            ], 422);
        }

        $user = User::where('email', $request->email)->first();
        if ($user) {
            $otp = rand(100000, 999999);
            $user->otp = $otp;
            $user->save();

            $data = [
                "title" => "Forget Password Otp",
                "otp" => $otp
            ];

            Mail::to($request->email)->send(new ForgetPasswordOtpMail($data));

            return response()->json([
                "status" => "success",
                "message" => "Otp send successfully on your mail"
            ]);
        }
        return response()->json([
            "status" => "error",
            "message" => "user not found"
        ]);
    }
    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'otp' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => "error",
                "message" => $validator->errors()->first()
            ], 422);
        }

        $user = User::where(['email' => $request->email])->first();
        if (!$user) {
            return response()->json(["status" => "error", "message" => "user not found"]);
        }

        if ($user->otp == $request->otp) {
            $user->otp = null;
            $user->save();
            return response()->json(["status" => "success", "message" => "otp match successfully"]);
        }

        return response()->json(["status" => "error", "message" => "otp does not match"]);

    }
    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => "error",
                "message" => $validator->errors()->first()
            ], 422);
        }


        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();

            return response()->json([
                "status" => "success",
                "message" => "password reset successfully"
            ]);
        }
        return response()->json([
            "status" => "error",
            "message" => "user not found"
        ]);
    }
}
