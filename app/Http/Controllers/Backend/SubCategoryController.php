<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\SubSubCategory;

class SubCategoryController extends Controller
{
    public function SubCategoryView(){
        $category = Category::orderBy('category_name_en','ASC')->get();
        $subcategories = SubCategory::latest()->get();

        return view('backend.category.subcategory_view',compact('subcategories','category'));

    }

    public function SubStore(Request $req){

        $req->validate([
            'category_id'=>'required',
            'subcategory_name_en'=>'required',
            'subcategory_name_hin'=>'required',
        ],[
            'category_id.required'=>'Please select option',
            'subcategory_name_en.required'=>'Input sub category Name in English',
            'subcategory_name_hin.required'=>'Input sub category Name in Hindi',
        ]);

       

        SubCategory::insert([
            'category_id'=>$req->category_id,
            'subcategory_name_en' => $req->subcategory_name_en,
            'subcategory_name_hin' => $req->subcategory_name_hin,
            'subcategory_slug_en' => strtolower(str_replace(' ','-',$req->subcategory_name_en)),
            'subcategory_slug_hin' => str_replace(' ','-',$req->subcategory_name_hin),
            
        ]);

        return redirect()->back();
    }

    public function SubEdit($id){
        $categories = Category::orderBy('category_name_en','ASC')->get();
        $subcategory = SubCategory::findOrFail($id);

        return view('backend.category.subcategory_edit',compact('subcategory','categories'));
    }

    public function SubUpdate(Request $req){
        $subcategory_id = $req->id;
        

        
    
            SubCategory::findOrFail($subcategory_id)->update([
                'category_id'=>$req->category_id,
                'subcategory_name_en' => $req->subcategory_name_en,
                'subcategory_name_hin' => $req->subcategory_name_hin,
                'subcategory_slug_en' => strtolower(str_replace(' ','-',$req->subcategory_name_en)),
                'subcategory_slug_hin' => str_replace(' ','-',$req->subcategory_name_hin),
                
            ]);
    
            return redirect()->route('all.subcategory');
        
        

    }

    public function SubDelete($id){

        
        
        

        SubCategory::findOrFail($id)->delete();

        return redirect()->back();
    }

    //subsub category

    public function SubSubCategoryView(){
        $category = Category::orderBy('category_name_en','ASC')->get();
        $subsubcategories = SubSubCategory::latest()->get();

        return view('backend.category.subsubcategory_view',compact('subsubcategories','category'));

    }

    public function GetSubCategory($category_id){
        $subcat = SubCategory::where('category_id',$category_id)->orderBy('subcategory_name_en','ASC')->get();
        return json_encode($subcat);
    }

    public function SubSubStore(Request $req){

        $req->validate([
            'category_id'=>'required',
            'subcategory_id'=>'required',
            'subsubcategory_name_en'=>'required',
            'subsubcategory_name_hin'=>'required',
        ],[
            'category_id.required'=>'Please select option',
            'subcategory_id.required'=>'Please select option',
            'subsubcategory_name_en.required'=>'Input sub category Name in English',
            'subsubcategory_name_hin.required'=>'Input sub category Name in Hindi',
        ]);

       

        SubSubCategory::insert([
            'category_id'=>$req->category_id,
            'subcategory_id'=>$req->subcategory_id,
            'subsubcategory_name_en' => $req->subsubcategory_name_en,
            'subsubcategory_name_hin' => $req->subsubcategory_name_hin,
            'subsubcategory_slug_en' => strtolower(str_replace(' ','-',$req->subsubcategory_name_en)),
            'subsubcategory_slug_hin' => str_replace(' ','-',$req->subsubcategory_name_hin),
            
        ]);

        return redirect()->back();
    }

    public function SubSubEdit($id){
        $categories = Category::orderBy('category_name_en','ASC')->get();
        $subcategories = SubCategory::orderBy('subcategory_name_en','ASC')->get();

        $subsubcategory = SubSubCategory::findOrFail($id);

        return view('backend.category.subsubcategory_edit',compact('subsubcategory','categories','subcategories'));
    }

    public function SubSubUpdate(Request $req){
        $subsubcategory_id = $req->id;
        

        
    
            SubSubCategory::findOrFail($subsubcategory_id)->update([
                'category_id'=>$req->category_id,
                'subcategory_id'=>$req->subcategory_id,
                'subsubcategory_name_en' => $req->subsubcategory_name_en,
                'subsubcategory_name_hin' => $req->subsubcategory_name_hin,
                'subsubcategory_slug_en' => strtolower(str_replace(' ','-',$req->subsubcategory_name_en)),
                'subsubcategory_slug_hin' => str_replace(' ','-',$req->subsubcategory_name_hin),
                
            ]);
    
            return redirect()->route('all.subsubcategory');
        
        

    }

    public function SubSubDelete($id){

        
        
        

        SubSubCategory::findOrFail($id)->delete();

        return redirect()->back();
    }
}
