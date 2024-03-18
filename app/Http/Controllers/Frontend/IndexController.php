<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\Product;
use App\Models\BlogPost;

use App\Models\Brand;

class IndexController extends Controller
{
    public function index(){
        $blogpost = BlogPost::latest()->get();
        $products = Product::where('status',1)->orderBy('id','DESC')->limit(5)->get();
        $featured = Product::where('featured',1)->orderBy('id','DESC')->limit(5)->get();
        $hot_deals = Product::where('hot_deals',1)->where('discount_price','!=',NULL)->orderBy('id','DESC')->limit(3)->get();
        $special = Product::where('special_offer',1)->orderBy('id','DESC')->limit(3)->get();
        $special_d = Product::where('special_deals',1)->orderBy('id','DESC')->limit(3)->get();

        $categories = Category::orderBy('category_name_en','ASC')->get();
        $sliders = Slider::where('status',1)->orderBy('id','DESC')->limit(3)->get();

        $skip_cat_0 = Category::skip(0)->first();
        $skip_prod_0 = Product::where('status',1)->where('category_id',$skip_cat_0->id)->orderBy('id','DESC')->get();


        $skip_cat_1 = Category::skip(1)->first();
        $skip_prod_1 = Product::where('status',1)->where('category_id',$skip_cat_1->id)->orderBy('id','DESC')->get();


        $skip_brand_0 = Brand::skip(0)->first();
        $skip_brand_prod_0 = Product::where('status',1)->where('brand_id',$skip_brand_0->id)->orderBy('id','DESC')->get();

       // return $skip_cat->id;
        //die();


        return view('frontend.index',compact('categories','sliders','products','featured','hot_deals','special','special_d','skip_cat_0','skip_prod_0','skip_cat_1','skip_prod_1','skip_brand_0','skip_brand_prod_0','blogpost'));
    }

    public function UserLogout(){
        Auth::logout();
        return redirect()->route('login');
    }

    public function UserProfile(){
       $id = Auth::user()->id;
        $data = User::find($id);

        return view('frontend.profile.user_profile',compact('data'));
    }

    public function UserStore(Request $req){

        $data = User::find(Auth::user()->id);
        $data->name = $req->name;
        $data->email = $req->email;
        $data->phone = $req->phone;
        
        if($req->file('profile_photo_path')){
            $file = $req->file('profile_photo_path');
            unlink(public_path('upload/user_images/'.$data->profile_photo_path));

            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'),$filename);
            $data['profile_photo_path'] = $filename;
        }
        $data->save();
        return redirect()->route('user.profile');
     }

     public function UserChangePassword(){
        $id = Auth::user()->id;
        $data = User::find($id);
         return view('frontend.profile.change_password',compact('data'));
     }

     public function PasswordUpdate(Request $req){
        $validateData = $req->validate([
            'oldpassword'=>'required',
            'password'=>'required|confirmed',

        ]);
        $hashedPass = Auth::user()->password;
        if(Hash::check($req->oldpassword,$hashedPass)){
            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($req->password);
            $user->save();
            Auth::logout();

            return redirect()->route('user.logout');
        }
        else{
            return redirect()->back();
        }
    
    }

    public function ProductDetails($id,$slug){
        
        $product = Product::findOrFail($id);

        $color_en = $product->product_color_en;
        $product_color_en = explode(',', $color_en);

        $color_hin = $product->product_color_hin;
        $product_color_hin = explode(',', $color_hin);

        $size_en = $product->product_size_en;
        $product_size_en = explode(',', $size_en);

       

        $size_hin = $product->product_size_hin;
        $product_size_hin = explode(',', $size_hin);
        $catid = $product->category_id;

        $related = Product::where('category_id',$catid)->where('id','!=',$id)->orderBy('id','DESC')->get();
        $multi = MultiImg::where('product_id',$id)->get();
        return view('frontend.product.product_details',compact('product','multi','product_color_en','product_color_hin','product_size_en','product_size_hin','related'));


    }

    public function TagWiseProduct($tag){
        $categories = Category::orderBy('category_name_en','ASC')->get();

        $products = Product::where('status',1)->where('product_tags_en',$tag)->where('product_tags_hin',$tag)->orderBy('id','DESC')->paginate(3);
        return view('frontend.tags.tags_view',compact('products','categories'));
    }

    public function SubCatData($subcat_id,$slug){
        $categories = Category::orderBy('category_name_en','ASC')->get();

        $products = Product::where('status',1)->where('subcategory_id',$subcat_id)->orderBy('id','DESC')->paginate(3);
        return view('frontend.product.subcat_view',compact('products','categories'));
    }

    public function SubSubCatData($ssubcat_id,$slug){
        $categories = Category::orderBy('category_name_en','ASC')->get();

        $products = Product::where('status',1)->where('subsubcategory_id',$ssubcat_id)->orderBy('id','DESC')->paginate(3);
        return view('frontend.product.subsubcat_view',compact('products','categories'));
    }

    public function ProductViewAjax($id){
        $product = Product::with('category','brand')->findOrFail($id);

        $color = $product->product_color_en;
        $product_color = explode(',', $color);

        $size = $product->product_size_en;
        $product_size = explode(',', $size);

       return response()->json(array(
        'product'=>$product,
        'color'=>$product_color,
        'size'=>$product_size,
       ));


        
    }
}
