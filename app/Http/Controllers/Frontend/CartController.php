<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ShipDivision;
use App\Models\Wishlist;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function CartStoreProduct(Request $req, $id){
        if (Session::has('coupon')) {

            Session::forget('coupon');
           
        }
        $product = Product::findOrFail($id);

        if ($product->discount_price == NULL) {
            Cart::add([
                'id'=> $id,
                'name'=>$req->product_name,
                'qty'=>$req->quantity,
                'price'=>$product->selling_price,
                'weight'=> 1,
                'options'=>[
                    'image'=>$product->product_thumbnail,
                    'size'=>$req->size,
                    'color'=>$req->color,
                ],

            ]);

            return response()->json(['success'=>'Successfuly added in your cart']);
        }
        else {
             Cart::add([
                'id'=> $id,
                'name'=>$req->product_name,
                'qty'=>$req->quantity,
                'price'=>$product->discount_price,
                'weight'=> 1,
                'options'=>[
                    'image'=>$product->product_thumbnail,
                    'size'=>$req->size,
                    'color'=>$req->color,
                ],
                
            ]);
            return response()->json(['success'=>'Successfuly added in your cart']);

        }
    }
    
    public function MiniCartAdd(){
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts'=> $carts,
            'cartQty'=> $cartQty,
            'cartTotal'=> round($cartTotal),
        ));
    }

    public function MiniCartRemove($id){
        

        Cart::remove($id);
        return response()->json(['success' => 'Product Removed from Cart']);
    }

    public function AddToWish(Request $req, $id){
        
           if (Auth::check()) {
                $exists = Wishlist::where('user_id',Auth::id())->where('product_id',$id)->first();
                
                if (!$exists) {
                    Wishlist::insert([
                        'user_id' => Auth::id(),
                        'product_id' => $id,
                        'created_at' => Carbon::now(),
                    ]);

                    return response()->json(['success' => 'Added to wishlist']);


                }
             else {
                return response()->json(['error' => 'Item already in wishlist']);

             }  


            } 
           else {
                    return response()->json(['error' => 'Login required']);

           }
        
    }
    
    public function CouponApply(Request $req){
        
        $coupon = Coupon::where('coupon_name',$req->coupon_name)->where('coupon_validity','>=',Carbon::now()->format('Y-m-d'))->first();

        if ($coupon) {
            
            Session::put('coupon',[
                'coupon_name'=>$coupon->coupon_name,
                'coupon_discount'=>$coupon->coupon_discount,
                'discount_amount'=>round(Cart::total() * $coupon->coupon_discount / 100),
                'total_amount'=>round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100),
            ]);

            return response()->json(array(
                'success'=>'coupon applied successfuly'
            ));
        }
        else {
            
            return response()->json(['error' => 'Coupon does not exist']);

        }
     
    }

    public function CouponCalculate(){
        

        if (Session::has('coupon')) {
            return response()->json(array(

                'subtotal'=>Cart::total(),
                'coupon_name'=>session()->get('coupon')['coupon_name'],
                'coupon_discount'=>session()->get('coupon')['coupon_discount'],
                'discount_amount'=>session()->get('coupon')['discount_amount'],
                'total_amount'=>session()->get('coupon')['total_amount']
            ));
           
        }
        else {
            
            return response()->json(array(
                'total'=>Cart::total()
            ));

        }
     
    }

    public function RemoveCoupon(){
        

       Session::forget('coupon');
       return response()->json(['success'=>'Coupon removed']);
     
    }

    public function Checkout(){
        
        if (Auth::check()) {
            if (Cart::total()>0) {

                $carts = Cart::content();
                $cartQty = Cart::count();
                $cartTotal = Cart::total();

                $divisions = ShipDivision::orderBy('division_name','ASC')->get();
                return view('frontend.checkout.checkout_view',compact('carts','cartQty','cartTotal','divisions'));
            }
            else {
                
                return redirect()->route('login');
            }
        }
        else {
            return redirect()->to('/');
        }
      
     }
}
