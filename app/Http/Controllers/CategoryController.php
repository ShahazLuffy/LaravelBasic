<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\support\Carbon;
use DB;
use Auth;
use SoftDelete;


class CategoryController extends Controller
{
    public function allcat(){

        // $categories = DB::table('categories')->paginate(3);
        $categories = DB::table('categories')->join('users','categories.user_id','users.id')
        ->select('categories.*', 'users.name')->latest()->paginate(3);

        $trashCats = Category::onlyTrashed()->latest()->paginate(3);
        return view('admin.category.index', compact('categories','trashCats'));
    }

    public function addcat(Request $request){
        $validatedData = $request->validate([
            "category_name" => 'required|unique:categories|max:22'
        ], [
            "category_name.required" => "please fill the filed"
        ]

    );

    $data = array();
    $data['category_name'] = $request->category_name;
    $data['user_id'] = Auth::user()->id;
    $data['created_at'] = Carbon::now();

    DB::table('categories')->insert($data);


    return redirect()->back()->with('success', 'Category Successfully Added!');
    }


    public function edit(Request $request, $id){

        $edit_item = DB::table('categories')->where('id',$id)->first();
        return view('admin.category.edit', compact('edit_item'));
    }

    public function update(Request $request, $id){
            $validatedData = $request->validate([
            "category_name" => 'required|unique:categories|max:22'
        ], [
            "category_name.required" => "please fill the filed"
        ]

    );


        $data = array();
        $data['category_name'] = $request->category_name;
        $data['user_id'] = Auth::user()->id;
        $data['updated_at'] = Carbon::now();

        DB::table('categories')->where('id', $id)->update($data);
        return redirect()->route('all.cat')->with('updated', 'Category Successfully updated!');
    }
     public function SoftDelete($id)
        //protected function runSoftDelete($id)
    {
         $delete = Category::find($id)->delete();
         return redirect()->back()->with('success', 'successfully deleted');
    }

       public function Restore($id){
        $delete = Category::withTrashed()->find($id)->restore();
        return redirect()->route('all.cat')->with('success', 'successfully restored');
    }

       public function pdelete($id){
        $delete = Category::onlyTrashed()->find($id)->forceDelete();
        return redirect()->back()->with('success', 'successfully permanently deleted');
    }




}
