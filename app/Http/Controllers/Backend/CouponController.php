<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Models\MultiImg;
use Illuminate\Support\Carbon;
class CouponController extends Controller
{
    public function CouponView(){
        $coupons = Coupon::orderBy('id','DESC')->get();
        return view('backend.coupon.coupon_view',compact('coupons'));
    }

    public function CouponStore(Request $req){

        $req->validate([
            'coupon_name'=>'required',
            'coupon_discount'=>'required',
            'coupon_validity'=>'required',
        ]);

       

        Coupon::insert([
            'coupon_name' => strtoupper($req->coupon_name),
            'coupon_discount' => $req->coupon_discount,
            'coupon_validity' => $req->coupon_validity,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->back();
    }

    public function CouponEdit($id){
        $coupon = Coupon::findOrFail($id);

        return view('backend.coupon.coupon_edit',compact('coupon'));
    }

    public function CouponUpdate(Request $req){
        $coupon_id = $req->id;
        

        
    
            Coupon::findOrFail($coupon_id)->update([
                'coupon_name' => strtoupper($req->coupon_name),
                'coupon_discount' => $req->coupon_discount,
                'coupon_validity' => $req->coupon_validity,
                'created_at'=>Carbon::now(),
            ]);
    
            return redirect()->route('manage-coupon');
        
        

    }

    public function CouponDelete($id){
        
        Coupon::findOrFail($id)->delete();

        return redirect()->back();
    }
}
