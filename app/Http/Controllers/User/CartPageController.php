<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use PHPUnit\Framework\Constraint\Count;
use App\Models\Coupon;
use Illuminate\Support\Facades\Session;

class CartPageController extends Controller
{
    public function MyCart(){
        return view('frontend.wishlist.cart_view');
    }

    public function GetCartProducts(){

        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts'=> $carts,
            'cartQty'=> $cartQty,
            'cartTotal'=> round($cartTotal),
        )); 
        
    }

    public function RemoveCartProduct($id){
        Cart::remove($id);

        if (Session::has('coupon')) {

            Session::forget('coupon');
           
        }
        return response()->json(['success' => 'Product Removed from Cart']);

    }

    public function Increment($id){

        $row = Cart::get($id);
        Cart::update($id,$row->qty + 1);
        if (Session::has('coupon')) {
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name',$coupon_name)->first();

            Session::put('coupon',[
                'coupon_name'=>$coupon->coupon_name,
                'coupon_discount'=>$coupon->coupon_discount,
                'discount_amount'=>round(Cart::total() * $coupon->coupon_discount / 100),
                'total_amount'=>round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100),
            ]);
        }

        return response()->json(['success' => 'Product Updated']);

    }

    public function Decrement($id){

        $row = Cart::get($id);
        Cart::update($id,$row->qty - 1);

        if (Session::has('coupon')) {
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name',$coupon_name)->first();
            
            Session::put('coupon',[
                'coupon_name'=>$coupon->coupon_name,
                'coupon_discount'=>$coupon->coupon_discount,
                'discount_amount'=>round(Cart::total() * $coupon->coupon_discount / 100),
                'total_amount'=>round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100),
            ]);
        }

        return response()->json(['success' => 'Product Updated']);

    }
}
