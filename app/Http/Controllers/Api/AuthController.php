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


            $user =User::where('email',$request->email)->first();

            //if email is already stored in database but not registered
            if($user->is_email_verified == '0')
            {
                $otp = rand(100000, 999999);
                $user->otp = $otp;
                $user->save();

                $data = [
                    "title" => "Email verification otp",
                    "otp" => $otp
                ];

                Mail::to($request->email)->send(new ForgetPasswordOtpMail($data));
                return response()->json([
                    "status" => "success",
                    "message" => "Otp send to given email",
                    "is_email_verified" => $user->is_email_verified,
                    "is_profile_completed" => $user->is_profile_completed
                ], 422);
            }
            else
            //if email is already registered but profile is not completed
            if ($user->is_email_verified == 1 && $user->is_profile_completed == 0) {
                return response()->json([
                    "status" => "success",
                    "message" => "Please complete your profile",
                    "is_email_verified" => $user->is_email_verified,
                    "is_profile_completed" => $user->is_profile_completed
                ], 422);
            }


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
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => "error",
                "message" => $validator->errors()->first()
            ], 422);
        }

        $userInfo = User::where('email', $request->email)->first();
        if ($userInfo) {
            //if email is already stored in database but not registered
            if ($userInfo->is_email_verified == 0) {
                $otp = rand(100000, 999999);
                $userInfo->otp = $otp;
                $userInfo->save();

                $data = [
                    "title" => "Email verification otp",
                    "otp" => $otp
                ];

                Mail::to($request->email)->send(new ForgetPasswordOtpMail($data));
                return response()->json([
                    "status" => "success",
                    "message" => "Otp send to given email",
                    "is_email_verified" => $userInfo->is_email_verified,
                    "is_profile_completed" => $userInfo->is_profile_completed
                ], 422);
            } else
                //if email is already registered but profile is not completed
                if ($userInfo->is_email_verified == 1 && $userInfo->is_profile_completed == 0) {
                    return response()->json([
                        "status" => "success",
                        "message" => "Please complete your profile",
                        "is_email_verified" => $userInfo->is_email_verified,
                        "is_profile_completed" => $userInfo->is_profile_completed
                    ], 422);
                }
        }

        $validator = Validator::make($request->all(), [
            'user_type' => 'required|in:brand,creator',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => "error",
                "message" => $validator->errors()->first()
            ], 422);
        }

        $user_type = $request->user_type;
        $user = new User;

        if ($user_type == "brand") {
            $validator = Validator::make($request->all(), [
                'brand_name' => 'required|string|min:3',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    "status" => "error",
                    "message" => $validator->errors()->first()
                ], 422);
            }

            $user->brand_name = $request->brand_name;
            $user->email = $request->email;
            $user->user_type = $request->user_type;
            $user->password = Hash::make($request->password);
        } else
        if ($user_type == "creator") {
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string|min:3',
                'last_name' => 'required|string|min:3',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    "status" => "error",
                    "message" => $validator->errors()->first()
                ], 422);
            }

            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->user_type = $request->user_type;
            $user->password = Hash::make($request->password);
        }

        $otp = rand(100000, 999999);
        $user->otp = $otp;
        $user->save();
        $user = $user->fresh();

        $data = [
            "title" => "Email verification otp",
            "otp" => $otp
        ];

        Mail::to($request->email)->send(new ForgetPasswordOtpMail($data));
        return response()->json([
            "status" => "success",
            "message" => "Otp send to given email",
            "is_email_verified" => $user->is_email_verified,
            "is_profile_completed" => $user->is_profile_completed
        ], 422);
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
            $user->is_email_verified = '1';
            $user->save();
            return response()->json(["status" => "success", "message" => "otp match successfully", "is_profile_completed" => $user->is_profile_completed]);
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
    public function completeProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'bio' => 'required',
            'instagram_username' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'vertical_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => "error",
                "message" => $validator->errors()->first()
            ], 422);
        }

        $user = User::where('email', $request->email)->first();
        if (isset($user)) {

            // dd("working 3");

            // $user->brand_name = $request->brand_name;
            $user->bio = $request->bio;
            $user->instagram_username = $request->instagram_username;
            $user->dob = $request->dob;
            $user->gender = $request->gender;
            $user->vertical_id = $request->vertical_id;
            if ($request->hasFile('main_image')) {
                $file = $request->file('main_image');
                $main_image = rand(100, 10000) . '.' . $file->getClientOriginalExtension();
                $destinationPath = 'admin-assets/uploads/profileimages/';
                $file->move($destinationPath, $main_image);
                $user->profile_image = $main_image;
            }
            if ($request->hasFile('second_image')) {
                $file = $request->file('second_image');
                $second_image = rand(100, 10000) . '.' . $file->getClientOriginalExtension();
                $destinationPath = 'admin-assets/uploads/profileimages/';
                $file->move($destinationPath, $second_image);
                $user->profile_img_second = $second_image;
            }
            if ($request->hasFile('third_image')) {
                $file = $request->file('third_image');
                $third_image = rand(100, 10000) . '.' . $file->getClientOriginalExtension();
                $destinationPath = 'admin-assets/uploads/profileimages/';
                $file->move($destinationPath, $third_image);
                $user->profile_img_third = $third_image;
            }

            $user->is_profile_completed = '1';
            $user->save();
            return response()->json([
                "status" => "success",
                "message" => "Profile completed successfully"
            ], 422);
        } else {
            return redirect()->route('user.list')->with('error', 'User not found');
        }
    }
}
