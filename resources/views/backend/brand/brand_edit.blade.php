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
				  <h3 class="box-title">Edit Brand</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					 
                    <form method="post" action="{{route('brand.update',$brand->id)}}" enctype="multipart/form-data">
             @csrf
           		<input type="hidden" name="id" value="{{$brand->id}}">	
                <input type="hidden" name="oldimage" value="{{$brand->brand_image}}">	
                  

   
     <div class="form-group">
        <h5>Brand name English</h5><span class="text-danger">*</span></h5>
         <div class="controls">
        <input type="text" name="brand_name_en"  class="form-control" required data-validation-required-message="This field is required" value="{{$brand->brand_name_en}}"> </div>
        @error('brand_name_en')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>

<div class="form-group">
        <h5>Brand name Hindi<span class="text-danger">*</span></h5>
         <div class="controls">
        <input type="text" name="brand_name_hin"  class="form-control" required data-validation-required-message="This field is required" value="{{$brand->brand_name_hin}}"> </div>
        @error('brand_name_hin')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>


<div class="form-group">
        <h5>Brand image<span class="text-danger">*</span></h5>
         <div class="controls">
        <input type="file" name="brand_image"  class="form-control" required data-validation-required-message="This field is required"> </div>
        @error('brand_image')
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