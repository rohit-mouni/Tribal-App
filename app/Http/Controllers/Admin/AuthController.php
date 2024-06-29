<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;


use App\Mail\ForgetPasswordMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
// use Mail;

class AuthController extends Controller
{
    public function loginView(Request $request)
    {
        return view('admin.auth.login');
    }
    public function loginCrediential(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8',
        ]);

        if (Auth::attempt($validatedData)) {
            return redirect()->route('dashboard')->with('success', 'User Login Successfully');
        } else {
            return redirect()->back()->with('error', 'Invalid credentials. Please try again.');
        }
    }

    public function forgotPassword(Request $request)
    {
        return view('admin.auth.forgot-password');
    }

    public function resetForgotPassword(Request $request)
    {


        $validatedData = $request->validate([
            'email' => 'required|email',
        ]);

        $token_already_present = DB::table('password_reset_tokens')
        ->where([
          'email' => $request->email
        ])
        ->first();
        // dd($token_already_present);

        if($token_already_present)
        {
            return redirect()->route('admin.forgotpassword')->with('info', 'Password reset link already sent! Please check your email');
        }

        $admin = User::where('email',$request->email)->where('user_type','admin')->first();
        if(isset($admin) && $admin != "")
        {
            $token = Str::random(64);
              DB::table('password_reset_tokens')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
              ]);

            //   dd("working till here");
            Mail::send('admin.auth.change-password', compact('token'), function($message) use($request){
                $message->to($request->email);
                $message->subject('Reset Password');
            });
            return redirect()->route('admin.forgotpassword')->with('success', 'Password reset link sent!');
    }
}

    public function changePassword($token)
    {
        return view('admin.auth.reset-password',compact('token'));
    }

    public function storePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_reset_tokens')
                            ->where([
                              'email' => $request->email,
                              'token' => $request->token
                            ])
                            ->first();


        if(!$updatePassword){
            return back()->withInput()->with('error', 'Your token has been expired!');
        }

        $user = User::where('email', $request->email)
                    ->update(['password' => Hash::make($request->password)]);

        DB::table('password_reset_tokens')->where(['email'=> $request->email])->delete();

        return redirect('admin/login')->with('success', 'Your password has been changed!');
    }

    public function changeAdminDetail(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);
        $admin_id = Auth::user()->id;
        $admin = User::where('id', $admin_id)->first();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->save();

        return redirect()->route('profile')->with('success', 'Admin details change successfully');
    }

    public function changeAdminPassword(Request $request)
    {

        $validatedData = $request->validate([
            'current_password' => 'required',
            // 'password' => 'required|confirmed|min:8',
            'password' => 'required',
        ]);

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return redirect()->route('profile')->with('error', 'Password not match');
        }

        $admin = User::where('id', Auth::user()->id)->first();
        $admin->password = Hash::make($request->password);
        $admin->save();
        return redirect()->route('profile')->with('success', 'Password change successfully');

    }


}
