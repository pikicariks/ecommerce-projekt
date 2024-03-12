<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

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
        return response()->json(['success' => 'Product Removed from Cart']);

    }

    public function Increment($id){

        $row = Cart::get($id);
        Cart::update($id,$row->qty + 1);

        return response()->json(['success' => 'Product Updated']);

    }

    public function Decrement($id){

        $row = Cart::get($id);
        Cart::update($id,$row->qty - 1);

        return response()->json(['success' => 'Product Updated']);

    }
}
