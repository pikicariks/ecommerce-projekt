<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function ReviewStore(Request $req){

        $product_id = $req->id;

        $req->validate([
            'summary'=>'required',
            'comment'=>'required',
        ]);

         Review::insert([
            'product_id'=>$product_id,
            'user_id'=>Auth::id(),
            'summary'=>$req->summary,
            'rating' => $req->quality,
            'comment'=>$req->comment,
            'created_at'=>Carbon::now(),
         ]);

         return redirect()->back();
    }

    public function PendingReview(){
        $reviews = Review::where('status',0)->orderBy('id','DESC')->get();
    	return view('backend.review.pending_reviews',compact('reviews'));

    }

    public function ReviewApprove($id){

         Review::where('id',$id)->update(['status'=>1]);
    	return redirect()->back();

    }

    public function PublishReviews(){

        $reviews = Review::where('status',1)->orderBy('id','DESC')->get();
        return view('backend.review.published_reviews',compact('reviews'));


   }

   public function DeleteReview($id){

    Review::findOrFail($id)->delete();

    $notification = array(
        'message' => 'Review Delete Successfully',
        'alert-type' => 'success'
    );

    return redirect()->back()->with($notification);

}

}
