<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        $TotalUser = User::where('user_type','!=','admin')->count();
        $TotalAdmin = User::where('user_type','admin')->count();
        return view('admin.dashboard',compact('TotalUser','TotalAdmin'));
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'User Logout Successfully');
    }
    public function profile(Request $request)
    {
        $data = Auth::user();
        return view('admin.users.profile',compact('data'));
    }
}

