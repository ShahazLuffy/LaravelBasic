<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Multipic;
use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\support\Carbon;
use Image;

class BrandController extends Controller
{
    public function __construct(){
            $this->middleware('auth');
    }
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
            "brand_image" => 'required|image'

        ],
        [
            "brand_name.required" => "please fill the filed",
            "brand_image.required" =>"please insert image",
            "brand_image.image" =>"add an image file please",
        ]

        );

        $data = array();
        $data['brand_name'] = $request->brand_name;
        $data['user_id'] = Auth::user()->id;
        $data['created_at'] = Carbon::now();

        // $brand_image = $request->file('brand_image');
        // $name_gen =hexdec(uniqid()); //to generate unique hex id for our image name
        // $img_ext = strtolower($brand_image->getClientOriginalExtension());
        // $img_name = $name_gen.'.'.$img_ext;
        // $up_location = 'image/brand/';
        // $last_img = $up_location.$img_name;
        // $brand_image->move($up_location, $img_name);
        // $data['brand_image'] = $last_img;

        //another way is to use Image Intervention package
        $brand_image = $request->file('brand_image');
        $name_gen =hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
        Image::make($brand_image)->resize(300,300)->save('image/brand/'.$name_gen);
        $last_img = 'image/brand/'.$name_gen;
        $data['brand_image'] = $last_img;

        DB::table('brands')->insert($data);
        return redirect()->back()->with('success', 'Brands Successfully Added!');
    }
       public function editBrand($id){
        $edit_brand = DB::table('brands')->where('id',$id)->first();
        return view('admin.brand.edit', compact('edit_brand'));
    }

 public function updateBrand(Request $request, $id){
           $validatedData = $request->validate([
            "brand_name" => 'required|unique:brands|max:22',
            "brand_image" => 'required|image'

        ],
        [
            "brand_name.required" => "please fill the filed",
            "brand_image.required" =>"please insert image",
            "brand_image.image" =>"add an image file please",
        ]

        );

        $oldImage = $request->old_image; //in old_image az oon input hidden miad
        // if($brand_image){

        // }else{

        // }

        $data = array();
        $data['brand_name'] = $request->brand_name;
        $data['user_id'] = Auth::user()->id;
        $data['created_at'] = Carbon::now();

        $brand_image = $request->file('brand_image');
        $name_gen =hexdec(uniqid()); //to generate unique hex id for our image name
        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$img_ext;
        $up_location = 'image/brand/';
        $last_img = $up_location.$img_name;
        $brand_image->move($up_location, $img_name);
        $data['brand_image'] = $last_img;

        unlink($oldImage);
        DB::table('brands')->where('id', $id)->update($data);
        return redirect()->route('all.Brand')->with('updated', 'Brand Successfully updated!');
    }


       public function deleteBrand($id){
        $image = DB::table('brands')->where('id', $id)->first();
        //$image = Brand::find($id);
        $old_image = $image->brand_image;
        unlink($old_image); //to delete actual image from directory~

        DB::table('brands')->where('id', $id)->delete();
         return redirect()->route('all.Brand')->with('deleted', 'Brand Deleted Successfully!');
    }




    public function multiPic(){

        $multipic = Multipic::all();
        return view('admin.multipic.index', compact('multipic'));
    }

      public function sotreImg(Request $request){

        $validatedData = $request->validate([
            "image" => 'required|unique:multipics|max:22',
        ],
        [
            "image.required" => "please fill the filed",
        ]
        );
        //for multi pic we need to use foreach loop
        $image = $request->file('image');
        foreach($image as $multiImg){
            $name_gen =hexdec(uniqid()).'.'.$multiImg->getClientOriginalExtension();
            Image::make($multiImg)->resize(300,300)->save('image/multi/'.$name_gen);
            $last_img = 'image/multi/'.$name_gen;

            Multipic::insert([
                'image' => $last_img,
                'created_at' => Carbon::now(),
            ]);
        }//end of foreach
        //remember to add []index to name of the image filed attribute
        return redirect()->back()->with('success', 'Multipic Successfully Added!');
    }

      public function logout(){

            Auth::logout();
            return redirect()->route('login')->with('success', 'Successfully Logged out!');
    }

}
