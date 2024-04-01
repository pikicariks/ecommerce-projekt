<?php

namespace App\Http\Controllers\Backend;

use App\Models\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminProfileController extends Controller
{
    
    public function AdminProfile(){
        $id = Auth::user()->id;
        $addata = Admin::find($id);

        return view('admin.admin_profile_view',compact('addata'));
    }

    public function AdminProfileEdit(){
        $id = Auth::user()->id;
        $editdata = Admin::find($id);

        return view('admin.admin_profile_edit',compact('editdata'));
    }

    public function AdminProfileStore(Request $req){
        $id = Auth::user()->id;
        $data = Admin::find($id);
        $data->name = $req->name;
        $data->email = $req->email;
        
        if($req->file('profile_photo_path')){
            $file = $req->file('profile_photo_path');
            unlink(public_path('upload/admin_images/'.$data->profile_photo_path));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'),$filename);
            $data['profile_photo_path'] = $filename;
        }
        $data->save();
        return redirect()->route('admin.profile');
    }

    public function AdminChangePass(){

        return view('admin.admin_change_password');
    }

    public function UpdatePass(Request $req){
        $validateData = $req->validate([
            'oldpassword'=>'required',
            'password'=>'required|confirmed',

        ]);
        $hashedPass = Auth::user()->password;
        if(Hash::check($req->oldpassword,$hashedPass)){
            $admin = Admin::find(Auth::id());
            $admin->password = Hash::make($req->password);
            $admin->save();
            Auth::logout();

            return redirect()->route('admin.logout');
        }
        else{
            return redirect()->back();
        }
    
    }

    public function AllUsers(){
       $user = User::latest()->get();

       return view('backend.user.all_user',compact('user'));
    
    }
}
