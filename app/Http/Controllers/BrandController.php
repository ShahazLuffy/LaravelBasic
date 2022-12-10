<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\support\Carbon;

class BrandController extends Controller
{
    public function allBrand(){

         // $brands = DB::table('brands')->paginate(3);
        $brands = DB::table('brands')->join('users','brands.user_id','users.id')
        ->select('brands.*', 'users.name')->latest()->paginate(3);

        $trashBrands= Brand::onlyTrashed()->latest()->paginate(3);
        return view('admin.brand.index', compact('brands','trashBrands'));
    }

       public function storeBrand(Request $request){
            $validatedData = $request->validate([
            "brand_name" => 'required|unique:brands|max:22',
            //"brand_image" => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048'

        ],
        [
            "brand_name.required" => "please fill the filed",
            "brand_image.required" =>"please insert image",
           // "brand_image.mimes" =>"only jpg, jpeg and png files are supported",
        ]

        );

        $data = array();
        $data['brand_name'] = $request->brand_name;
        $data['user_id'] = Auth::user()->id;
        $data['created_at'] = Carbon::now();

        $brand_image = $request->file('brand_image');
        $name_gen =hexdec(uniqid()); //to generate unique hex id for our image name
        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$img_ext;
        $up_location = 'image/brand/';
        $last_img = $up_location.'.'.$img_name;
        $brand_image->move($up_location, $img_name);
        $data['brand_image'] = $last_img;


        DB::table('brands')->insert($data);
        return redirect()->back()->with('success', 'Brands Successfully Added!');
    }
       public function edit(){

        $brands = DB::table('brands')->paginate(3);
        return view('admin.brand.index', compact('brands'));
    }
       public function delete(){

        $brands = DB::table('brands')->paginate(3);
        return view('admin.brand.index', compact('brands'));
    }
}
