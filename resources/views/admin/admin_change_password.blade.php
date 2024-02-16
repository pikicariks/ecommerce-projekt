@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<div class="container-full">

<section class="content">

<!-- Basic Forms -->
 <div class="box">
   <div class="box-header with-border">
     <h4 class="box-title">Admin change password</h4>
   </div>
   <!-- /.box-header -->
   <div class="box-body">
     <div class="row">
       <div class="col">
           <form method="post" action="{{route('update.change.password')}}">
             @csrf
           <div class="row">
               <div class="col-12">						
                  
<div class="row">
    <div class="col-md-6">
     <div class="form-group">
        <h5>Current password<span class="text-danger">*</span></h5>
         <div class="controls">
        <input type="password" name="oldpassword" id="current_password" class="form-control" required data-validation-required-message="This field is required"> </div>
</div>

<div class="form-group">
        <h5>New password<span class="text-danger">*</span></h5>
         <div class="controls">
        <input type="password" name="password" id="password" class="form-control" required data-validation-required-message="This field is required"> </div>
</div>


<div class="form-group">
        <h5>Confirm password<span class="text-danger">*</span></h5>
         <div class="controls">
        <input type="password" name="passconf" id="password_confirmation" class="form-control" required data-validation-required-message="This field is required"> </div>
</div>
    </div>

   
</div>



                  

                 
               <div class="text-xs-right">
                <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update">
               </div>
           </form>

       </div>
       <!-- /.col -->
     </div>
     <!-- /.row -->
   </div>
   <!-- /.box-body -->
 </div>
 <!-- /.box -->

</section>
</div>



@endsection