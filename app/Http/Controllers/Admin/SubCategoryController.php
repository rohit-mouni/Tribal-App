<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function subCategoryList(Request $request)
    {
        $SubCategories = SubCategory::orderBy('id','desc')->get();
        return view('admin.sub-category.index', compact('SubCategories'));
    }
    public function subCategoryCreate(Request $request)
    {
        $allCategory = Category::where('status', 'active')->get();
        return view('admin.sub-category.create', compact('allCategory'));
    }

    public function subCategoryStore(Request $request)
    {
        $request->validate([
            'sub_category_name'    => 'required|unique:sub_categories,sub_category_name',
            'category_id'           => 'required',
        ]);

        $data['sub_category_name'] = $request->sub_category_name;
        $data['category_id'] =     $request->category_id;

        SubCategory::create($data);
        return redirect()->route('sub.category.list')->with('success', 'Sub Category Create Successfully');
    }
    public function subCategoryEdit(Request $request, $id)
    {
        $subCategory = SubCategory::find($id);
        $allCategory = Category::get();
        return view('admin.sub-category.edit', compact('subCategory', 'allCategory'));
    }

    public function subCategoryUpdate(Request $request, $id)
    {
        $request->validate([
            'sub_category_name'    => 'required|unique:sub_categories,sub_category_name,'.$id,
            'category_id'         => 'required',
            'status'              => 'required',
        ]);
        // ----
        $data['sub_category_name'] = $request->sub_category_name;
        $data['category_id'] =      $request->category_id;
        $data['status'] =      $request->status;

        SubCategory::where('id', $id)->update($data);
        return redirect()->route('sub.category.list')->with('success', 'Sub Category Update Successfully');
    }

    public function subCategoryDelete($id)
    {
        $data = SubCategory::find($id);
        $data->delete();
        return redirect()->route('sub.category.list')->with('success', 'Sub Category Delete Successfully');
    }
}
