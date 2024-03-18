<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Seo;
use App\Models\SiteSett;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SiteSetting extends Controller
{
    public function SetSite(){
        $setting = SiteSett::find(1);

        return view('backend.setting.setting_update',compact('setting'));
    }

    public function UpdateSiteSetting(Request $req,$id){

        $setting_id = $id;
        

        if($req->file('logo')){
          
            $image = $req->file('logo');
            $namegenerate = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(139,36)->save('upload/logo/'.$namegenerate);

            $save = 'upload/logo/'.$namegenerate;
    
            SiteSett::findOrFail($setting_id)->update([
                'logo' => $save,
                'phone_1' => $req->phone_1,
                'phone_2' => $req->phone_2,
                'email' => $req->email,
                'company_name' => $req->company_name,
                'company_address' => $req->company_address,
                'facebook' => $req->facebook,
                'twitter' => $req->twitter,
                'linkedin' => $req->linkedin,
                'youtube' => $req->youtube,
                
                
            ]);
    
            return redirect()->back();
        }
        else{
            SiteSett::findOrFail($setting_id)->update([
                
                'phone_1' => $req->phone_1,
                'phone_2' => $req->phone_2,
                'email' => $req->email,
                'company_name' => $req->company_name,
                'company_address' => $req->company_address,
                'facebook' => $req->facebook,
                'twitter' => $req->twitter,
                'linkedin' => $req->linkedin,
                'youtube' => $req->youtube,
                
            ]);
    
            return redirect()->back();
        }

    }

    public function SeoSetting(){
        $seo = Seo::find(1);

        return view('backend.setting.seo_update',compact('seo'));
    }

    public function UpdateSEO(Request $req,$id){
        $seo_id = $id;

        Seo::findOrFail($seo_id)->update([
            
            'meta_title' => $req->meta_title,
            'meta_author' => $req->meta_author,
            'meta_keyword' => $req->meta_keyword,
            'meta_description' => $req->meta_description,
            'google_analytics' => $req->google_analytics,
            
            
            
        ]);

        return redirect()->back();
    }
}
