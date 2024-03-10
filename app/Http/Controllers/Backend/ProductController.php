<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\Brand;
use App\Models\MultiImg;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function AddProduct(){

        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();    

        return view('backend.product.product_add',compact('categories','brands'));
    }

    public function StoreProduct(Request $req){

        $image = $req->file('product_thumbnail');
        $namegenerate = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(917,1000)->save('upload/product/thumbnail/'.$namegenerate);
        $save = 'upload/product/thumbnail/'.$namegenerate;
        $product_id = Product::insertGetId([
            'brand_id' => $req->brand_id,
            'category_id' => $req->category_id,
            'subcategory_id' => $req->subcategory_id,
            'subsubcategory_id' => $req->subsubcategory_id,
            'product_name_en' => $req->product_name_en,
            'product_name_hin' => $req->product_name_hin,
            'product_slug_en' => strtolower(str_replace(' ','-',$req->product_name_en)),
            'product_slug_hin' =>strtolower(str_replace(' ','-',$req->product_name_hin)),
            'product_code' => $req->product_code,
            'product_qty' => $req->product_qty,
            'product_tags_en' => $req->product_tags_en,
            'product_tags_hin' => $req->product_tags_hin,
            'product_size_en' => $req->product_size_en,
            'product_size_hin' => $req->product_size_hin,
            'product_color_en' => $req->product_color_en,
            'product_color_hin' => $req->product_color_hin,
            'selling_price' => $req->selling_price,
            'discount_price' => $req->discount_price,
            'short_desc_en' => $req->short_desc_en,
            'short_desc_hin' => $req->short_desc_hin,
            'long_desc_en' => $req->long_desc_en,
            'long_desc_hin' => $req->long_desc_hin,
            'hot_deals' => $req->hot_deals,
            'featured' => $req->featured,
            'special_offer' => $req->special_offer,
            'special_deals' => $req->special_deals,
            'product_thumbnail' => $save,
            'status' => 1,
            'created_at' => Carbon::now(),
            

        ]);

        $images = $req->file('multi_img');
        foreach ($images as $img) {
        $name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
        Image::make($img)->resize(917,1000)->save('upload/product/multi-image/'.$name);
        $upload = 'upload/product/multi-image/'.$name;
        MultiImg::insert([
            'product_id'=> $product_id,
            'photo_name'=>$upload,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('manage-product');
        }
        
    }

    public function ManageProduct(){
        $products = Product::latest()->get();
        return view('backend.product.product_view',compact('products'));
    }

    public function ProductEdit($id){
        $multiImgs = MultiImg::where('product_id',$id)->get();
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        $subcategories = SubCategory::latest()->get();
        $subsubcategories = SubSubCategory::latest()->get();

        $product = Product::findOrFail($id);

        return view('backend.product.product_edit',compact('categories','brands','subcategories','subsubcategories','product','multiImgs'));
    }

    public function DataUpdate(Request $req){

        $prod_id = $req->id;

        Product::findOrFail($prod_id)->update([
            'brand_id' => $req->brand_id,
            'category_id' => $req->category_id,
            'subcategory_id' => $req->subcategory_id,
            'subsubcategory_id' => $req->subsubcategory_id,
            'product_name_en' => $req->product_name_en,
            'product_name_hin' => $req->product_name_hin,
            'product_slug_en' => strtolower(str_replace(' ','-',$req->product_name_en)),
            'product_slug_hin' =>strtolower(str_replace(' ','-',$req->product_name_hin)),
            'product_code' => $req->product_code,
            'product_qty' => $req->product_qty,
            'product_tags_en' => $req->product_tags_en,
            'product_tags_hin' => $req->product_tags_hin,
            'product_size_en' => $req->product_size_en,
            'product_size_hin' => $req->product_size_hin,
            'product_color_en' => $req->product_color_en,
            'product_color_hin' => $req->product_color_hin,
            'selling_price' => $req->selling_price,
            'discount_price' => $req->discount_price,
            'short_desc_en' => $req->short_desc_en,
            'short_desc_hin' => $req->short_desc_hin,
            'long_desc_en' => $req->long_desc_en,
            'long_desc_hin' => $req->long_desc_hin,
            'hot_deals' => $req->hot_deals,
            'featured' => $req->featured,
            'special_offer' => $req->special_offer,
            'special_deals' => $req->special_deals,
            
            'status' => 1,
            'created_at' => Carbon::now(),
            

        ]);
        return redirect()->route('manage-product');
    }

    public function MultiImageUpdate(Request $request){
		$imgs = $request->multi_img;

		foreach ($imgs as $id => $img) {
	    $imgDel = MultiImg::findOrFail($id);
	    unlink($imgDel->photo_name);

    	$make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
    	Image::make($img)->resize(917,1000)->save('upload/product/multi-image/'.$make_name);
    	$uploadPath = 'upload/product/multi-image/'.$make_name;

    	MultiImg::where('id',$id)->update([
    		'photo_name' => $uploadPath,
    		'updated_at' => Carbon::now(),

    	]);

	 } 

       

		return redirect()->back();

	} 

    public function ThambnailImageUpdate(Request $request){
        $pro_id = $request->id;
        $oldImage = $request->old_img;
        unlink($oldImage);
   
       $image = $request->file('product_thumbnail');
           $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
           Image::make($image)->resize(917,1000)->save('upload/product/thumbnail/'.$name_gen);
           $save_url = 'upload/product/thumbnail/'.$name_gen;
   
           Product::findOrFail($pro_id)->update([
               'product_thumbnail' => $save_url,
               'updated_at' => Carbon::now(),
   
           ]);
   
            
   
           return redirect()->back();
   
        } 

        public function MultiImageDelete($id){
            $oldimg = MultiImg::findOrFail($id);
            unlink($oldimg->photo_name);
            MultiImg::findOrFail($id)->delete();
   
            
   
           return redirect()->back();
   
        }

        public function ProductInactive($id){
            Product::findOrFail($id)->update(['status' => 0]);
            
   
           return redirect()->back();
        }
   
   
     public function ProductActive($id){
         Product::findOrFail($id)->update(['status' => 1]);
            
   
           return redirect()->back();
   
        }

        public function ProductDelete($id){
            $product = Product::findOrFail($id);
            // unlink($product->product_thumbnail);
            Product::findOrFail($id)->delete();
   
            $images = MultiImg::where('product_id',$id)->get();
            foreach ($images as $img) {
                // unlink($img->photo_name);
                MultiImg::where('product_id',$id)->delete();
            }
   
            
   
           return redirect()->route('manage-product');
   
        }
}
