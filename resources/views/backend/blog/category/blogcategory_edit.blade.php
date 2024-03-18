@extends('admin.admin_master')
@section('admin')

<div class="container-full">
		<!-- Content Header (Page header) -->
		

		<!-- Main content -->
		<section class="content">
		  <div class="row">
			  
			

            <div class="col-12">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Edit Blog Category</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					 
                    <form method="post" action="{{route('blogcategory.update',$blogcategory->id)}}" >
             @csrf
           		<input type="hidden" name="id" value="{{$blogcategory->id}}">		
                  

   
     <div class="form-group">
        <h5>Blog Category name English</h5><span class="text-danger">*</span></h5>
         <div class="controls">
        <input type="text" name="blog_category_name_en"  class="form-control" required data-validation-required-message="This field is required" value="{{$blogcategory->blog_category_name_en}}"> </div>
        @error('blog_category_name_en')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>

<div class="form-group">
        <h5>Blog Category name bosnian<span class="text-danger">*</span></h5>
         <div class="controls">
        <input type="text" name="blog_category_name_bos"  class="form-control" required data-validation-required-message="This field is required" value="{{$blogcategory->blog_category_name_bos}}"> </div>
        @error('blog_category_name_bos')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>


   



   

    <div class="text-xs-right">
                <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add New">
               </div>
           </form>

					</div>
				</div>
				<!-- /.box-body -->
			  </div>
			  <!-- /.box -->

			  
			  <!-- /.box -->          
			</div>
			<!-- /.col -->
		  </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->
	  
	  </div>

@endsection