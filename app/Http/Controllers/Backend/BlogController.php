<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog\BlogPostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\BlogPost;
use Intervention\Image\Facades\Image;

class BlogController extends Controller
{
    public function BlogCategory(){
        $blogcategory = BlogPostCategory::latest()->get();
        return view('backend.blog.category.category_view',compact('blogcategory'));
    }

    public function BlogCategoryStore(Request $req){

        $req->validate([
            'blog_category_name_en'=>'required',
            'blog_category_name_bos'=>'required',
            
        ],[
            'blog_category_name_en.required'=>'Input category Name in English',
            'blog_category_name_bos.required'=>'Input category Name in Hindi',
        ]);

       

        BlogPostCategory::insert([
            'blog_category_name_en' => $req->blog_category_name_en,
            'blog_category_name_bos' => $req->blog_category_name_bos,
            'blog_category_slug_en' => strtolower(str_replace(' ','-',$req->blog_category_name_en)),
            'blog_category_slug_bos' => str_replace(' ','-',$req->blog_category_name_bos),
            'created_at' => Carbon::now()
        ]);

        return redirect()->back();
    }

    public function BlogCategoryEdit($id){
        $blogcategory = BlogPostCategory::findOrFail($id);

        return view('backend.blog.category.blogcategory_edit',compact('blogcategory'));
    }

    public function BlogCategoryUpdate(Request $req,$id){
        $blogcategory_id = $req->id;
        

        
    
        BlogPostCategory::findOrFail($blogcategory_id)->update([
            'blog_category_name_en' => $req->blog_category_name_en,
            'blog_category_name_bos' => $req->blog_category_name_bos,
            'blog_category_slug_en' => strtolower(str_replace(' ','-',$req->blog_category_name_en)),
            'blog_category_slug_bos' => str_replace(' ','-',$req->blog_category_name_bos),
            'created_at' => Carbon::now()
            ]);
    
            return redirect()->route('blog.category');
        
        

    }

    public function BlogCategoryDelete($id){

        
        
        

        BlogPostCategory::findOrFail($id)->delete();

        return redirect()->back();
    }

    public function ListBlogPost(){
  	  $blogpost = BlogPost::with('category')->latest()->get();
  	  return view('backend.blog.post.post_list',compact('blogpost'));
  }

  public function AddBlogPost(){

    $blogcategory = BlogPostCategory::latest()->get();
  	$blogpost = BlogPost::latest()->get();
      return view('backend.blog.post.post_view',compact('blogpost','blogcategory'));

  }  
    public function PostStore(Request $req){

        $req->validate([
    		'post_title_en' => 'required',
    		'post_title_bos' => 'required',
    		'post_image' => 'required',
    	],[
    		'post_title_en.required' => 'Input Post Title English Name',
    		'post_title_bos.required' => 'Input Post Title Bosnian Name',
    	]);

    	$image = $req->file('post_image');
    	$name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    	Image::make($image)->resize(780,433)->save('upload/post/'.$name_gen);
    	$save_url = 'upload/post/'.$name_gen;

	BlogPost::insert([
		'category_id' => $req->category_id,
		'post_title_en' => $req->post_title_en,
		'post_title_bos' => $req->post_title_bos,
		'post_slug_en' => strtolower(str_replace(' ', '-',$req->post_title_en)),
		'post_slug_bos' => str_replace(' ', '-',$req->post_slug_bos),
		'post_image' => $save_url,
		'post_details_en' => $req->post_details_en,
		'post_details_bos' => $req->post_details_bos,
        'created_at' => Carbon::now(),

    	]);

	   

		return redirect()->route('list.post');

       
        
    }
    public function PostDelete($id){

        
        
        

        BlogPost::findOrFail($id)->delete();

        return redirect()->back();
    }

}
