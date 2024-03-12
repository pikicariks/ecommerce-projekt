<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function WishlistView(){
        return view('frontend.wishlist.wish_view');
    }

    public function GetProdWish(){
        
        $wishlist = Wishlist::with('product')->where('user_id',Auth::id())->latest()->get();
        
        return response()->json($wishlist);
    }

    

    public function WishRemoveProd($id){
        
        Wishlist::where('user_id',Auth::id())->where('id',$id)->delete();
        return response()->json(['success' => 'Item removed from wish list']);
    }
}
