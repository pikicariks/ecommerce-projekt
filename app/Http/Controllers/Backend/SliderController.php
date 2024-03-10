<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use App\Models\Slider;


class SliderController extends Controller
{
    public function SliderView(){

        $sliders = Slider::latest()->get();

        return view('backend.slider.slider_view',compact('sliders'));

    }

    public function SliderStore(Request $req){
        $req->validate([
            'slider_img'=>'required',
           
        ]);

        $image = $req->file('slider_img');
        $namegenerate = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(817,370)->save('upload/slider/'.$namegenerate);

        $save = 'upload/slider/'.$namegenerate;

        Slider::insert([
            'slider_img' => $save,
            'title' => $req->title,
            'description' => $req->description,
            
        ]);

        return redirect()->back();
    }

    public function SliderEdit($id){
        $slider = Slider::findOrFail($id);

        return view('backend.slider.slider_edit',compact('slider'));

    }

    public function SliderUpdate(Request $req){
        $slider_id = $req->id;
        $old_img = $req->oldimage;

        if($req->file('slider_img')){
            unlink($old_img);
            $image = $req->file('slider_img');
            $namegenerate = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(817,370)->save('upload/slider/'.$namegenerate);

            $save = 'upload/slider/'.$namegenerate;
    
            Slider::findOrFail($slider_id)->update([
                'slider_img' => $save,
                'title' => $req->title,
                'description' => $req->description,
                
            ]);
    
            return redirect()->route('manage-slider');
        }
        else{
            Slider::findOrFail($slider_id)->update([
               
                'title' => $req->title,
                'description' => $req->description,
                
            ]);
    
            return redirect()->route('manage-slider');
        }

    }

    public function SliderDelete($id){

        $slider = Slider::findOrFail($id);
        $img = $slider->slider_img;
        unlink($img);

        Slider::findOrFail($id)->delete();

        return redirect()->back();
    }

    public function SliderInactive($id){
        Slider::findOrFail($id)->update(['status' => 0]);
        

       return redirect()->back();
    }


 public function SliderActive($id){
    Slider::findOrFail($id)->update(['status' => 1]);
        

       return redirect()->back();

    }
}
