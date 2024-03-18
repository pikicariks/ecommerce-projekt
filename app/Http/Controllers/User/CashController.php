<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\OrderMail;
use Gloudemans\Shoppingcart\Facades\Cart;

use Illuminate\Support\Facades\Session;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Mail\Mailable;

class CashController extends Controller
{
    public function CashOrder(Request $req){
        if(Session::has('coupon')){
			$total_amount = Session::get('coupon')['total_amount'];
		}
		else {
			$total_amount = round(Cart::total());
		}



	

//dd($charge);

	$order_id = Order::insertGetId([
		'user_id'=>Auth::id(),
		'division_id'=>$req->division_id,
		'district_id'=>$req->district_id,
		'state_id'=>$req->state_id,
		'name'=>$req->name,
		'email'=>$req->email,
		'phone'=>$req->phone,
		'post_code'=>$req->post_code,
		'notes'=>$req->notes,

		'payment_type'=>'Cash on delivery',
		'payment_method'=>'Cash on delivery',
		'currency'=>'USD',
		'amount'=>$total_amount,
		'invoice_no'=>'MM'.mt_rand(10000000,99999999),
		'order_date'=>Carbon::now()->format('d F Y'),
		'order_month'=>Carbon::now()->format('F'),
		'order_year'=>Carbon::now()->format('Y'),
		'status'=>'Pending',
		'created_at'=>Carbon::now(),
		
	]);

	$invoice = Order::findOrFail($order_id);
	$data = [
		'invoice_no' => $invoice->invoice_no,
		'amount'=>$total_amount,
		'name'=>$invoice->name,
		'email'=>$invoice->email,
        'payment_type'=>'Cash on delivery'
	];
	Mail::to($req->email)->send(new OrderMail($data));
	$carts = Cart::content();

	foreach($carts as $cart){
		OrderItem::insert([
			'order_id' => $order_id,
			'product_id' => $cart->id,
			'color' => $cart->options->color,
			'size' => $cart->options->size,
			'qty' => $cart->qty,
			'price'=>$cart->price,
			'created_at'=>Carbon::now()
		]);
	}

	if (Session::has('coupon')) {
		Session::forget();
	}

	Cart::destroy();

	return redirect()->route('dashboard');
    }
}
