<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class AdminUserController extends Controller
{
    public function AllAdminRole(){

    	$adminuser = Admin::where('type',2)->latest()->get();
    	return view('backend.role.admin_role_all',compact('adminuser'));

    } 

    public function AddAdminRole(){

    	return view('backend.role.admin_role_create');

    } 

    public function StoreAdminRole(Request $req){


    	$image = $req->file('profile_photo_path');
    	$name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    	Image::make($image)->resize(225,225)->save('upload/admin_images/'.$name_gen);
    	$save_url = 'upload/admin_images/'.$name_gen;

	Admin::insert([
		'name' => $req->name,
		'email' => $req->email,
		'password' => Hash::make($req->password),
		'phone' => $req->phone,
		'brand' => $req->brand,
		'category' => $req->category,
		'product' => $req->product,
		'slider' => $req->slider,
		'coupons' => $req->coupons,

		'shipping' => $req->shipping,
		'blog' => $req->blog,
		'setting' => $req->setting,
		'returnorder' => $req->returnorder,
		'review' => $req->review,

		'orders' => $req->orders,
		'stock' => $req->stock,
		'reports' => $req->reports,
		'alluser' => $req->alluser,
		'adminuserrole' => $req->adminuserrole,
		'type' => 2,
		'profile_photo_path' => $save_url,
		'created_at' => Carbon::now(),


    	]);

	    $notification = array(
			'message' => 'Admin User Created Successfully',
			'alert-type' => 'success'
		);

		return redirect()->route('all.admin.user')->with($notification);

    }

	public function EditAdminRole($id){

    	$adminuser = Admin::findOrFail($id);
    	return view('backend.role.admin_role_edit',compact('adminuser'));

    } 

	public function UpdateAdminRole(Request $req){

    	$admin_id = $req->id;
    	$old_img = $req->old_image;

    	if ($req->file('profile_photo_path')) {

    	unlink($old_img);
    	$image = $req->file('profile_photo_path');
    	$name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    	Image::make($image)->resize(225,225)->save('upload/admin_images/'.$name_gen);
    	$save_url = 'upload/admin_images/'.$name_gen;

	Admin::findOrFail($admin_id)->update([
		'name' => $req->name,
		'email' => $req->email,

		'phone' => $req->phone,
		'brand' => $req->brand,
		'category' => $req->category,
		'product' => $req->product,
		'slider' => $req->slider,
		'coupons' => $req->coupons,

		'shipping' => $req->shipping,
		'blog' => $req->blog,
		'setting' => $req->setting,
		'returnorder' => $req->returnorder,
		'review' => $req->review,

		'orders' => $req->orders,
		'stock' => $req->stock,
		'reports' => $req->reports,
		'alluser' => $req->alluser,
		'adminuserrole' => $req->adminuserrole,
		'type' => 2,
		'profile_photo_path' => $save_url,
		'created_at' => Carbon::now(),

    	]);

	    $notification = array(
			'message' => 'Admin User Updated Successfully',
			'alert-type' => 'info'
		);

		return redirect()->route('all.admin.user')->with($notification);

    	}else{

    	Admin::findOrFail($admin_id)->update([
		'name' => $req->name,
		'email' => $req->email,

		'phone' => $req->phone,
		'brand' => $req->brand,
		'category' => $req->category,
		'product' => $req->product,
		'slider' => $req->slider,
		'coupons' => $req->coupons,

		'shipping' => $req->shipping,
		'blog' => $req->blog,
		'setting' => $req->setting,
		'returnorder' => $req->returnorder,
		'review' => $req->review,

		'orders' => $req->orders,
		'stock' => $req->stock,
		'reports' => $req->reports,
		'alluser' => $req->alluser,
		'adminuserrole' => $req->adminuserrole,
		'type' => 2,

		'created_at' => Carbon::now(),

    	]);

	    $notification = array(
			'message' => 'Admin User Updated Successfully',
			'alert-type' => 'info'
		);

		return redirect()->route('all.admin.user')->with($notification);

    	} // end else 

    }

	public function DeleteAdminRole($id){

		$adminimg = Admin::findOrFail($id);
		$img = $adminimg->profile_photo_path;
		unlink($img);

		Admin::findOrFail($id)->delete();

		 $notification = array(
		   'message' => 'Admin User Deleted Successfully',
		   'alert-type' => 'info'
	   );

	   return redirect()->back()->with($notification);

	}
}
