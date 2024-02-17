<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Intervention\Image\ImageManagerStatic as Image;


class BrandController extends Controller
{
    public function BrandView(){
        $brands = Brand::latest()->get();

        return view('backend.brand.brand_view',compact('brands'));
    }

    public function BrandStore(Request $req){

        $req->validate([
            'brand_name_en'=>'required',
            'brand_name_hin'=>'required',
            'brand_image'=>'required',
        ],[
            'brand_name_en.required'=>'Input Brand Name in English',
            'brand_name_hin.required'=>'Input Brand Name in Hindi',
        ]);

        $image = $req->file('brand_image');
        $namegenerate = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

        $save = 'upload/brand/'.$namegenerate;

        Brand::insert([
            'brand_name_en' => $req->brand_name_en,
            'brand_name_hin' => $req->brand_name_hin,
            'brand_slug_en' => strtolower(str_replace(' ','-',$req->brand_name_en)),
            'brand_slug_hin' => str_replace(' ','-',$req->brand_name_hin),
            'brand_image' => $save,
        ]);

        return redirect()->back();
    }

    public function BrandEdit($id){
        $brand = Brand::findOrFail($id);

        return view('backend.brand.brand_edit',compact('brand'));
    }

    public function BrandUpdate(Request $req){
        $brand_id = $req->id;
        $old_img = $req->oldimage;

        if($req->file('brand_image')){
            unlink($old_img);
            $image = $req->file('brand_image');
            $namegenerate = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    
            $save = 'upload/brand/'.$namegenerate;
    
            Brand::findOrFail($brand_id)->update([
                'brand_name_en' => $req->brand_name_en,
                'brand_name_hin' => $req->brand_name_hin,
                'brand_slug_en' => strtolower(str_replace(' ','-',$req->brand_name_en)),
                'brand_slug_hin' => str_replace(' ','-',$req->brand_name_hin),
                'brand_image' => $save,
            ]);
    
            return redirect()->route('all.brand');
        }
        else{
            Brand::findOrFail($brand_id)->update([
                'brand_name_en' => $req->brand_name_en,
                'brand_name_hin' => $req->brand_name_hin,
                'brand_slug_en' => strtolower(str_replace(' ','-',$req->brand_name_en)),
                'brand_slug_hin' => str_replace(' ','-',$req->brand_name_hin),
                
            ]);
    
            return redirect()->route('all.brand');
        }

    }

    public function BrandDelete($id){

        $brand = Brand::findOrFail($id);
        $img = $brand->brand_image;
        unlink($img);

        Brand::findOrFail($id)->delete();

        return redirect()->back();
    }
}
