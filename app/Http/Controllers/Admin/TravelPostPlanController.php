<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;


use App\Models\HangoutModel;
use App\Models\PostModel;
use App\Models\Vertical;
use App\Models\PlanModel;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class TravelPostPlanController extends Controller
{
    public function viewHangout()
    {
        $hangouts = HangoutModel::get();
        return view('admin.travel_post_plan.hangout', compact('hangouts'));
    }
    public function addHangout(Request $request)
    {
        // dd($request->get());
        $request->validate([
            "image" => "required|image",
            "title" => "required|string|max:255",
            "duration" => "required"
        ]);
        $hangout = new HangoutModel();
        $hangout->title = $request->title;
        $hangout->duration = $request->duration;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $img = rand(100, 10000) . '.' . $file->getClientOriginalExtension();
            $destinationPath = 'admin-assets/uploads/travel_post_plan/hangout';
            $file->move($destinationPath, $img);
            $hangout->image = $img;
        }
        $hangout->save();

        return back()->with("success", "Hangout added successfully");
    }

    public function deleteHangout($id)
    {
        $data = HangoutModel::find($id);
        $ImagePath = public_path('admin-assets/uploads/travel_post_plan/hangout/') . $data->image;
        File::delete($ImagePath);
        $data->delete();
        return back()->with('success', 'Hangout deleted successfully');
    }

    public function editHangout(Request $request)
    {

        $request->validate([
            // "image" => "required|image|mimes:jpeg,png,jpg,gif",
            "title" => "required|string|max:255",
            "duration" => "required"
        ]);

        $hangout = HangoutModel::find($request->hangout_id);
        $hangout->title = $request->title;
        $hangout->duration = $request->duration;

        if ($request->hasFile('image')) {

            //delete previous image
            $ImagePath = public_path('admin-assets/uploads/travel_post_plan/hangout/') . $hangout->image;
            File::delete($ImagePath);
            $hangout->delete();

            //upload new image
            $file = $request->file('image');
            $img = rand(100, 10000) . '.' . $file->getClientOriginalExtension();
            $destinationPath = 'admin-assets/uploads/travel_post_plan/hangout';
            $file->move($destinationPath, $img);
            $hangout->image = $img;
        }
        $hangout->save();

        return back()->with("success", "Hangout updated successfully");
    }

    public function viewPost()
    {
        $posts = PostModel::get();
        return view('admin.travel_post_plan.post', compact('posts'));
    }

    public function addPost(Request $request)
    {
        $request->validate([
            "image" => "required|image",
            "title" => "required|string|max:255",
            "description" => "required|string|max:255",
            "instagram_post_link" => "required"
        ]);
        $post = new PostModel();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->instagram_post_link = $request->instagram_post_link;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $img = rand(100, 10000) . '.' . $file->getClientOriginalExtension();
            $destinationPath = 'admin-assets/uploads/travel_post_plan/post';
            $file->move($destinationPath, $img);
            $post->image = $img;
        }
        $post->save();

        return back()->with("success", "Post added successfully");
    }

    public function editPost(Request $request)
    {
        $request->validate([
            // "image" => "required|image",
            "title" => "required|string|max:255",
            "description" => "required|string|max:255",
            "instagram_post_link" => "required"
        ]);

        $post = PostModel::find($request->post_id);
        $post->title = $request->title;
        $post->description = $request->description;
        $post->instagram_post_link = $request->instagram_post_link;

        if ($request->hasFile('image')) {

            //delete previous image
            $ImagePath = public_path('admin-assets/uploads/travel_post_plan/post/') . $post->image;
            File::delete($ImagePath);
            $post->delete();

            //upload new image
            $file = $request->file('image');
            $img = rand(100, 10000) . '.' . $file->getClientOriginalExtension();
            $destinationPath = 'admin-assets/uploads/travel_post_plan/post';
            $file->move($destinationPath, $img);
            $post->image = $img;
        }
        $post->save();

        return back()->with("success", "Post updated successfully");
    }

    public function deletePost($id)
    {
        $data = PostModel::find($id);
        $ImagePath = public_path('admin-assets/uploads/travel_post_plan/post/') . $data->image;
        File::delete($ImagePath);
        $data->delete();
        return back()->with('success', 'Post deleted successfully');
    }

    public function viewPlan()
    {
        $plans = PlanModel::orderBy('id','desc')->get();
        $verticals=Vertical::get();
        return view('admin.travel_post_plan.plan', compact('plans','verticals'));
    }
    public function addPlan(Request $request)
    {
        //  dd($request->get());
         $request->validate([
            "image" => "required|image",
            "name" => "required|string|max:255",
            "arriving" => "required",
            "departing" => "required",
            "about_trip" => "required",
            "link" => "required",
            "destinations" => "required",
            "verticals" => "required"
        ]);
        $plan = new PlanModel();
        $plan->name = $request->name;
        $plan->arriving = $request->arriving;
        $plan->departing = $request->departing;
        $plan->about_trip = $request->about_trip;
        $plan->link = $request->link;
        $plan->destinations = implode(',', $request->destinations);
        $plan->verticals = implode(',', $request->verticals);
        $plan->is_private = $request->is_private == "on" ? '1' : '0';

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $img = rand(100, 10000) . '.' . $file->getClientOriginalExtension();
            $destinationPath = 'admin-assets/uploads/travel_post_plan/plan';
            $file->move($destinationPath, $img);
            $plan->image = $img;
        }
        $plan->save();

        return back()->with("success", "Plan added successfully");
    }

    public function deletePlan($id)
    {
        $data = PlanModel::find($id);
        $ImagePath = public_path('admin-assets/uploads/travel_post_plan/plan/') . $data->image;
        File::delete($ImagePath);
        $data->delete();
        return back()->with('success', 'Plan deleted successfully');
    }

    public function editPlan(Request $request)
    {
        $request->validate([
            "name" => "required|string|max:255",
            "arriving" => "required",
            "departing" => "required",
            "about_trip" => "required",
            "link" => "required",
            "destinations" => "required",
            "verticals" => "required"
        ]);
        $plan =PlanModel::where('id',$request->plan_id)->first();
        $plan->name = $request->name;
        $plan->arriving = $request->arriving;
        $plan->departing = $request->departing;
        $plan->about_trip = $request->about_trip;
        $plan->link = $request->link;
        $plan->destinations = implode(',', $request->destinations);
        $plan->verticals = implode(',', $request->verticals);
        $plan->is_private = $request->is_private == "on" ? '1' : '0';

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $img = rand(100, 10000) . '.' . $file->getClientOriginalExtension();
            $destinationPath = 'admin-assets/uploads/travel_post_plan/plan';
            $file->move($destinationPath, $img);
            $plan->image = $img;
        }
        $plan->save();

        return back()->with("success", "Plan updated successfully");
    }
}
