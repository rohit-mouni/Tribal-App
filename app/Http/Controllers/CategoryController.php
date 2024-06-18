<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categoryList(Request $request)
    {
        $allUsers = Category::orderBy('id','desc')->get();
        return view('admin.category.index', compact('allUsers'));
    }
    public function categoryCreate(Request $request)
    {
        return view('admin.category.create');
    }
    public function categoryStore(Request $request)
    {
        $request->validate([
            'category_name'     => 'required|unique:categories,category_name',
        ]);

        $data['category_name'] =  $request->category_name;
        // -----
        Category::create($data);
        return redirect()->route('category.list')->with('success', 'Category Create Successfully');
    }
    public function categoryEdit(Request $request, $id)
    {
        $Category = Category::find($id);
        return view('admin.category.edit', compact('Category'));
    }

    public function categoryUpdate(Request $request, $id)
    {
        $request->validate([
            'category_name'   => 'required|unique:categories,category_name,'.$id,
            'status'          => 'required',
        ]);
        // ----
        $data['category_name'] = $request->category_name;
        $data['status'] =    $request->status;

        Category::where('id', $id)->update($data);
        return redirect()->route('category.list')->with('success', 'Category Update Successfully');
    }

    public function categoryDelete($id)
    {
        $data = Category::find($id);
        $data->delete();
        return redirect()->route('category.list')->with('success', 'Category Delete Successfully');
    }
}
