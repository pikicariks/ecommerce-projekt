<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ShopController extends Controller
{
    public function ShopPage(){
        $products = Product::query();
       

    if (!empty($_GET['category'])) {
        $slug = explode(',',$_GET['category']);
        $catids = Category::select('id')->whereIn('category_slug_en',$slug)->pluck('id')->toArray();

        $products->whereIn('category_id',$catids);
    }

    if (!empty($_GET['brand'])) {
        $slug = explode(',',$_GET['brand']);
        $brandids = Brand::select('id')->whereIn('brand_slug_en',$slug)->pluck('id')->toArray();

        $products->whereIn('brand_id',$brandids);
    }

    // Add the price filter back
    if (!empty($_GET['PRICE'])) {
        
        $price = explode(',', $_GET['PRICE']);
        
       
         $minPrice = $price[0];
         $maxPrice = $price[1];
    
         $products->whereBetween('selling_price', [$minPrice, $maxPrice]);
        
    }

    
    $products = $products->where('status',1)->orderBy('id','DESC')->paginate(3);

    $brands = Brand::orderBy('brand_name_en','ASC')->get();
    $categories = Category::orderBy('category_name_en','ASC')->get();

    return view('frontend.shop.shop_page',compact('products','categories','brands'));

    }

    public function ShopFilter(Request $req){
       
       
        $data = $req->all();

        $caturl = "";
        if (!empty($data['category'])) {
            foreach($data['category'] as $cat){

                if(empty($caturl)){
                    $caturl.='&category='.$cat;
                }
                else {
                    $caturl.=','.$cat;
                }

            }
        }

        $brandurl = "";
        if (!empty($data['brand'])) {
            foreach($data['brand'] as $br){

                if(empty($brandurl)){
                    $brandurl.='&brand='.$br;
                }
                else {
                    $brandurl.=','.$br;
                }

            }
        }

        return redirect()->route('shop.page',$caturl.$brandurl);
    }

   
}
