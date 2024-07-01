<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;


use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use App\Models\Vertical;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function userList(Request $request)
    {
        $allUsers = User::where('user_type', '!=', 'admin')->orderBy('id', 'desc')->get();
        return view('admin.users.index', compact('allUsers'));
    }
    public function userCreate(Request $request)
    {
        return view('admin.users.create');
    }
    public function userStore(Request $request)
    {
        $request->validate([
            'name'        => 'required|unique:users,name',
            'email'       => 'required|email|unique:users,email',
            'password'    => 'required|min:8|confirmed', //|confirmed',
            'user_type'    => 'required',
            // 'image'       => 'image|mimes:jpeg,png,jpg,gif,webp',
        ]);
        // ----image----
        // if ($img = $request->image) {
        //     $compressedImage = Image::make($img)->encode('webp', 64);
        //     $compressedImage->orientate();
        //     $compressedImage->resize(1200, null, function ($constraint) {
        //         $constraint->aspectRatio();
        //         $constraint->upsize();
        //     });

        //     $compressedImage->brightness(-1);
        //     $compressedImage->contrast(2);
        //     $compressedImage->sharpen(2);
        //     $compressedImage->encode('webp', 40);
        //     $unique = uniqid();
        //     $compressedImage->save(public_path('admin-assets/uploads/profileimages/' . $unique . '.webp'));
        //     $filename = $compressedImage->basename;
        //     $data['profile_image'] = $filename;
        // }
        // ----
        $data['brand_name'] = $request->name;
        $data['email'] = $request->email;
        $data['user_type'] = $request->user_type;
        $data['password'] = Hash::make($request->password);
        // -----
        User::create($data);
        return redirect()->route('user.list')->with('success', 'User Create Successfully');
    }
    public function userEdit(Request $request, $id)
    {
        $TrendsData = User::find($id);
        return view('admin.users.edit', compact('TrendsData'));
    }

    public function userUpdate(Request $request, $id)
    {
        $request->validate([
            'name'         => 'required|unique:users,name,' . $id,
            'email'        => 'required|unique:users,email,' . $id,
            'status'       => 'required',
            'user_type'    => 'required',
            // 'password'     => 'required|min:8',
            // 'image'        => 'image|mimes:jpeg,png,jpg,gif,webp',
        ]);
        // --image---
        $dataImage = User::where('id', $id)->first();
        $path = public_path('admin-assets/uploads/profileimages/') . $dataImage->profile_image;

        // if ($img = $request->image) {
        //     if (File::exists($path)) {
        //         File::delete($path);
        //     }
        //     $compressedImage = Image::make($img)->encode('webp', 64);
        //     $compressedImage->orientate();
        //     $compressedImage->resize(1200, null, function ($constraint) {
        //         $constraint->aspectRatio();
        //         $constraint->upsize();
        //     });
        //     $compressedImage->brightness(-1);
        //     $compressedImage->contrast(2);
        //     $compressedImage->sharpen(2);
        //     $compressedImage->encode('webp', 40);
        //     $unique = uniqid();
        //     $compressedImage->save(public_path('admin-assets/uploads/profileimages/' . $unique . '.webp'));
        //     $filename = $compressedImage->basename;
        //     $data['profile_image'] = $filename;
        // }

        $data['brand_name'] =  $request->name;
        $data['email'] = $request->email;
        $data['status'] = $request->status;
        $data['user_type'] = $request->user_type;
        // $data['password'] = Hash::make($request->password);

        User::where('id', $id)->update($data);
        return redirect()->route('user.list')->with('success', 'User Details Updated Successfully');
    }

    public function userDelete($id)
    {
        $data = User::find($id);
        $ImagePath = public_path('admin-assets/uploads/profileimages/') . $data->profile_image;
        File::delete($ImagePath);
        $data->delete();
        return redirect()->route('user.list')->with('success', 'User Delete Successfully');
    }

    public function userProfileUpdateView($id)
    {
        $verticals = Vertical::get();
        $user = Admin::where('id', $id)->first();
        return view('admin.users.update_profile', compact('user', 'verticals'));
    }
    public function userProfileUpdate(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        if ($user) {
            $user->brand_name = $request->brand_name;
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
            $user->save();
            return redirect()->route('user.list')->with('success', 'User profile updated successfully');
        } else {
            return redirect()->route('user.list')->with('error', 'User profile not found');
        }
    }

    public function updateAdminProfile(Request $request)
    {
        $request->validate([
            'image'        => 'image|mimes:jpeg,png,jpg,gif,webp'
        ]);

        $admin_id = Auth::guard('admin')->user()->id;
        $user = Admin::where('id', $admin_id)->first();

        if ($request->hasFile('image')) {
            //deleting previous image
            $ImagePath = public_path('admin-assets/uploads/profileimages/') . $user->profile_image;
            File::delete($ImagePath);
            $user->delete();

            $file = $request->file('image');
            $admin_profile_image = rand(100, 10000) . '.' . $file->getClientOriginalExtension();
            $destinationPath = 'admin-assets/uploads/profileimages/';
            $file->move($destinationPath, $admin_profile_image);
            $user->profile_image = $admin_profile_image;
        }

        $user->save();
        return back()->with('success', 'Profile image updated successfully');
    }
}
