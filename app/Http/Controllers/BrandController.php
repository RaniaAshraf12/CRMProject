<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use  Carbon\Carbon;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function AllBrand(){
       $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index' , compact('brands'));
    }
    public function StoreBrand(Request $request){
        $validateData=$request->validate([
            'brand_name' => 'required|unique:brands|min:4',
            'brand_image' => 'required|mimes:jpg,jpeg ,png',
        ],
        [
            'brand_name.required' => 'please input Brand Name',
            'brand_name.min' => 'Brand longer than 4 characteres'
        ]);
          $brand_image = $request->file('brand_image');
          $name_gen = hexdec(uniqid());
          $img_ext =strtolower($brand_image->getClientOriginalExtension());
          $img_name=$name_gen.'.'.$img_ext;
          $up_location = 'images/brand/';
          $last_name = $up_location .$img_name ;
          $brand_image-> move($up_location ,$img_name);
          Brand::insert([
                
                 'brand_name'  => $request->brand_name,
                 'braand_image' =>  $last_name,
                 'created_at'  => Carbon::now()
          ]);

          return redirect()->back()->with('success', 'Brand Inserted Successfully');

    }

    //Edit Function
    public function edit($id){
        $brands = brand::find($id);
        return view('admin.brand.edit',compact('brands'));
    }
    //update 
    public function update(Request $request, $id){


        $validateData=$request->validate([
            'brand_name' => 'required|unique:brands|min:4',
        ],
        [
            'brand_name.required' => 'please input Brand Name',
            'brand_name.min' => 'Brand longer than 4 characteres'
        ]);
          $old_image =$request->old_image;
          
          $brand_image = $request->file('brand_image');
          if($brand_image){
            $name_gen = hexdec(uniqid());
          $img_ext =strtolower($brand_image->getClientOriginalExtension());
          $img_name=$name_gen.'.'.$img_ext;
          $up_location = 'images/brand/';
          $last_name = $up_location .$img_name ;
          $brand_image-> move($up_location ,$img_name);
          unlink($old_image);
          Brand::find($id)->update([
                
                 'brand_name'  => $request->brand_name,
                 'braand_image' =>  $last_name,
                 'created_at'  => Carbon::now()
          ]);

          return redirect()->back()->with('success', 'Brand Updated Successfully');

          }else{

            Brand::find($id)->update([
                
                'brand_name'  => $request->brand_name,
                'created_at'  => Carbon::now()
         ]);

         return redirect()->back()->with('success', 'Brand Name Updated Successfully');

          }
         

    }
}
