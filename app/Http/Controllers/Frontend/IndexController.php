<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    public function index(){
        return view('frontend.index');
    }

    public function UserLogout(){
        Auth::logout();
        return redirect()->route('login');
    }

    public function UserProfile(){
       $id = Auth::user()->id;
        $data = User::find($id);

        return view('frontend.profile.user_profile',compact('data'));
    }

    public function UserStore(Request $req){

        $data = User::find(Auth::user()->id);
        $data->name = $req->name;
        $data->email = $req->email;
        $data->phone = $req->phone;
        
        if($req->file('profile_photo_path')){
            $file = $req->file('profile_photo_path');
            unlink(public_path('upload/user_images/'.$data->profile_photo_path));

            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'),$filename);
            $data['profile_photo_path'] = $filename;
        }
        $data->save();
        return redirect()->route('user.profile');
     }

     public function UserChangePassword(){
        $id = Auth::user()->id;
        $data = User::find($id);
         return view('frontend.profile.change_password',compact('data'));
     }

     public function PasswordUpdate(Request $req){
        $validateData = $req->validate([
            'oldpassword'=>'required',
            'password'=>'required|confirmed',

        ]);
        $hashedPass = Auth::user()->password;
        if(Hash::check($req->oldpassword,$hashedPass)){
            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($req->password);
            $user->save();
            Auth::logout();

            return redirect()->route('user.logout');
        }
        else{
            return redirect()->back();
        }
    
    }
}
