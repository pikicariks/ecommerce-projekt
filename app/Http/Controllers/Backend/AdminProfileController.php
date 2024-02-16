<?php

namespace App\Http\Controllers\Backend;

use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminProfileController extends Controller
{
    
    public function AdminProfile(){
        $addata = Admin::find(1);

        return view('admin.admin_profile_view',compact('addata'));
    }

    public function AdminProfileEdit(){
        $editdata = Admin::find(1);

        return view('admin.admin_profile_edit',compact('editdata'));
    }

    public function AdminProfileStore(Request $req){
        $data = Admin::find(1);
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
        $hashedPass = Admin::find(1)->password;
        if(Hash::check($req->oldpassword,$hashedPass)){
            $admin = Admin::find(1);
            $admin->password = Hash::make($req->password);
            $admin->save();
            Auth::logout();

            return redirect()->route('admin.logout');
        }
        else{
            return redirect()->back();
        }
    
    }
}
