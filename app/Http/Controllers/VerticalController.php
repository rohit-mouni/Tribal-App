<?php

namespace App\Http\Controllers;

use App\Models\Vertical;
use Illuminate\Http\Request;

class VerticalController extends Controller
{
    public function verticalList(Request $request)
    {
        $allUsers = Vertical::orderBy('id','desc')->get();
        return view('admin.vertical.index', compact('allUsers'));
    }
    public function verticalCreate(Request $request)
    {
        return view('admin.vertical.create');
    }

    public function verticalStore(Request $request)
    {
        $request->validate([
            'vertical_name'     => 'required|unique:verticals,vertical_name',
        ]);

        $data['vertical_name'] =  $request->vertical_name;

        Vertical::create($data);
        return redirect()->route('vertical.list')->with('success', 'Vertical Create Successfully');
    }
    public function verticalEdit(Request $request, $id)
    {
        $Category = Vertical::find($id);
        return view('admin.vertical.edit', compact('Category'));
    }

    public function verticalUpdate(Request $request, $id)
    {
        $request->validate([
            'vertical_name'   => 'required|unique:verticals,vertical_name,'.$id,
            'status'          => 'required',
        ]);
        // ----
        $data['vertical_name'] = $request->vertical_name;
        $data['status'] =    $request->status;

        Vertical::where('id', $id)->update($data);
        return redirect()->route('vertical.list')->with('success', 'Vertical Update Successfully');
    }

    public function verticalDelete($id)
    {
        $data = Vertical::find($id);
        $data->delete();
        return redirect()->route('vertical.list')->with('success', 'Vertical Delete Successfully');
    }

    public function surender()
    {
        
    }
}
