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
				  <h3 class="box-title">Edit Coupon</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					 
                    <form method="post" action="{{route('coupon.update',$coupon->id)}}">
             @csrf
           		<input type="hidden" name="id" value="{{$coupon->id}}">	
                  

   
     <div class="form-group">
        <h5>coupon name </h5><span class="text-danger">*</span></h5>
         <div class="controls">
        <input type="text" name="coupon_name"  class="form-control" required data-validation-required-message="This field is required" value="{{$coupon->coupon_name}}"> </div>
        @error('coupon_name')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>

<div class="form-group">
        <h5>Coupon discount<span class="text-danger">*</span></h5>
         <div class="controls">
        <input type="text" name="coupon_discount"  class="form-control" required data-validation-required-message="This field is required" value="{{$coupon->coupon_discount}}"> </div>
        @error('coupon_discount')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>

    <div class="form-group">
        <h5>Coupon validity<span class="text-danger">*</span></h5>
         <div class="controls">
        <input type="date" name="coupon_validity"  class="form-control" required data-validation-required-message="This field is required" value="{{$coupon->coupon_validity}}"> </div>
        @error('coupon_validity')
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