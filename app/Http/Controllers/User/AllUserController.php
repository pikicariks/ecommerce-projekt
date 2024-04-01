<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;

class AllUserController extends Controller
{
    public function GetOrders(){
        $orders = Order::where('user_id',Auth::id())->orderBy('id','DESC')->get();

        return view('frontend.user.order.order_view',compact('orders'));
    }

    public function OrderDetails($id){
        $order = Order::with('division','district','state','user')->where('id',$id)->where('user_id',Auth::id())->first();
        $order_item = OrderItem::with('product')->where('order_id',$id)->orderBy('id','DESC')->get();
        return view('frontend.user.order.order_details',compact('order','order_item'));


}

    public function InvoiceDownload($id){
    $order = Order::with('division','district','state','user')->where('id',$id)->where('user_id',Auth::id())->first();
    $order_item = OrderItem::with('product')->where('order_id',$id)->orderBy('id','DESC')->get();
    
    $pdf = Pdf::loadView('frontend.user.order.order_invoice',compact('order','order_item'))->setPaper('a4')->setOptions([
        'tempDir' => public_path(),
        'chroot'=>public_path()
    ]);
    return $pdf->download('invoice.pdf');
    //return view('frontend.user.order.order_invoice',compact('order','order_item'));


    }

    public function ReturnOrder(Request $req,$order_id){

        Order::findOrFail($order_id)->update([
            'return_date' => Carbon::now()->format('d F Y'),
            'return_reason' => $req->return_reason,
            'return_order'=>1,
        ]);


      $notification = array(
            'message' => 'Return Request Send Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('my.orders')->with($notification);

    }

    public function ReturnOrderList(){

        $orders = Order::where('user_id',Auth::id())->where('return_order','!=',0)->orderBy('id','DESC')->get();
        return view('frontend.user.order.return_order_view',compact('orders'));

    }

    public function CancelOrders(){

        $orders = Order::where('user_id',Auth::id())->where('status','cancel')->orderBy('id','DESC')->get();
        return view('frontend.user.order.cancel_order_view',compact('orders'));

    }

    public function OrderTracking(Request $req){

        $invoice = $req->code;

        $track = Order::where('invoice_no',$invoice)->first();

        if ($track) {
            
            return view('frontend.tracking.track_order',compact('track'));
        }
        

        return redirect()->back();

    }
}
