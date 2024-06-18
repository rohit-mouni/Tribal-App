<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
            return redirect()->route('dashboard')->with('success','User Login Successfully');
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
            'email' => 'required|email|exists:users,email',
        ]);

        dd($request->all());
    }

    public function changePassword(Request $request)
    {
        return view('admin.auth.reset-password');
    }

    public function storePassword(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|confirmed',
        ]);
        $data['password'] = Hash::make($request->password);
        User::where('email', $request->email)->update($data);

        return redirect()->route('login')->with('success', 'Password Change Successfully');
    }

}
