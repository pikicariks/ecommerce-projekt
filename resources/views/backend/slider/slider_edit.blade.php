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
				  <h3 class="box-title">Edit Slider</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					 
                    <form method="post" action="{{route('slider.update')}}" enctype="multipart/form-data">
             @csrf
           		<input type="hidden" name="id" value="{{$slider->id}}">	
                <input type="hidden" name="oldimage" value="{{$slider->slider_img}}">	
                  

   
     <div class="form-group">
        <h5>Title</h5><span class="text-danger">*</span></h5>
         <div class="controls">
        <input type="text" name="title"  class="form-control" required data-validation-required-message="This field is required" value="{{$slider->title}}"> </div>
        
    </div>

<div class="form-group">
        <h5>Description<span class="text-danger">*</span></h5>
         <div class="controls">
        <input type="text" name="description"  class="form-control" required data-validation-required-message="This field is required" value="{{$slider->description}}"> </div>
        
    </div>


<div class="form-group">
        <h5>Slider image<span class="text-danger">*</span></h5>
         <div class="controls">
        <input type="file" name="slider_img"  class="form-control" required data-validation-required-message="This field is required"> </div>
        @error('slider_img')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
   

    <div class="text-xs-right">
                <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update">
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