<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function CartStoreProduct(Request $req, $id){

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
}
