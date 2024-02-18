<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function CategoryView(){
        $categories = Category::latest()->get();

        return view('backend.category.category_view',compact('categories'));

    }

    public function CategoryStore(Request $req){

        $req->validate([
            'category_name_en'=>'required',
            'category_name_hin'=>'required',
            'category_icon'=>'required',
        ],[
            'category_name_en.required'=>'Input category Name in English',
            'category_name_hin.required'=>'Input category Name in Hindi',
        ]);

       

        Category::insert([
            'category_name_en' => $req->category_name_en,
            'category_name_hin' => $req->category_name_hin,
            'category_slug_en' => strtolower(str_replace(' ','-',$req->category_name_en)),
            'category_slug_hin' => str_replace(' ','-',$req->category_name_hin),
            'category_icon' => $req->category_icon,
        ]);

        return redirect()->back();
    }

    public function CategoryEdit($id){
        $category = Category::findOrFail($id);

        return view('backend.category.category_edit',compact('category'));
    }

    public function CategoryUpdate(Request $req){
        $category_id = $req->id;
        

        
    
            Category::findOrFail($category_id)->update([
                'brand_name_en' => $req->category_name_en,
                'brand_name_hin' => $req->category_name_hin,
                'brand_slug_en' => strtolower(str_replace(' ','-',$req->category_name_en)),
                'brand_slug_hin' => str_replace(' ','-',$req->category_name_hin),
                'brand_image' => $req->category_icon,
            ]);
    
            return redirect()->route('all.category');
        
        

    }

    public function CategoryDelete($id){

        $category = Category::findOrFail($id);
        
        

        Category::findOrFail($id)->delete();

        return redirect()->back();
    }
}
