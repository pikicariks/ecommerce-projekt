<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ShipDistrict;
use App\Models\ShipState;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function GetDistrict($division_id){
        $district = ShipDistrict::where('division_id',$division_id)->orderBy('district_name','ASC')->get();
        
        return json_encode($district);
    }

    public function GetState($district_id){
        $state = ShipState::where('district_id',$district_id)->orderBy('state_name','ASC')->get();
        
        return json_encode($state);
    }

    public function CheckoutStore(Request $req){

        $data = array();

        $data['shipping_name'] = $req->shipping_name;
        $data['shipping_email'] = $req->shipping_email;
        $data['shipping_phone'] = $req->shipping_phone;
        $data['post_code'] = $req->post_code;
        $data['division_id'] = $req->division_id;
        $data['district_id'] = $req->district_id;
        $data['state_id'] = $req->state_id;
        $data['notes'] = $req->notes;

        if ($req->payment_method == 'Stripe') {
            return view('frontend.payment.stripe',compact('data'));
        }
        elseif ($req->payment_method == 'Card') {
            return 'card';

        }
        else {
            return 'cash';
        }
    }
    
    
}
