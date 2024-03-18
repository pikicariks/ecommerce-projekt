@extends('admin.admin_master')
@section('admin')

<div class="container-full">
		<!-- Content Header (Page header) -->
		

		<!-- Main content -->
		<section class="content">
		  <div class="row">
			  
			

			

			 



            <div class="col-4">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Search by date</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					 
                    <form method="post" action="{{route('search-by-date')}}" >
             @csrf
           				
                  

   
     <div class="form-group">
        <h5>Select date</h5><span class="text-danger">*</span></h5>
         <div class="controls">
        <input type="date" name="date"  class="form-control" > </div>
        @error('brand_name_en')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>


   

    <div class="text-xs-right">
                <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Search">
               </div>
           </form>

					</div>
				</div>
				<!-- /.box-body -->
			  </div>
			  <!-- /.box -->

			  
			  <!-- /.box -->          
			</div>


            <div class="col-4">

<div class="box">
   <div class="box-header with-border">
     <h3 class="box-title">Search by month</h3>
   </div>
   <!-- /.box-header -->
   <div class="box-body">
       <div class="table-responsive">
        
       <form method="post" action="{{route('search-by-month')}}" >
@csrf
              
     


<div class="form-group">
<h5>Select month</h5><span class="text-danger">*</span></h5>
<div class="controls">
<select name="month" id="" class="form-control">
    <option label="Choose One"></option>
    <option value="January" >January</option>
    <option value="February" >February</option>
    <option value="March" >March</option>
    <option value="April" >April</option>
    <option value="May" >May</option>
    <option value="June" >June</option>
    <option value="July" >July</option>
    <option value="August" >August</option>
    <option value="September" >September</option>
    <option value="October" >October</option>
    <option value="November" >November</option>
    <option value="December" >December</option>



</select>
@error('month')
<span class="text-danger">{{$message}}</span>
@enderror
</div>

</div>


<div class="form-group">
<h5>Select Year</h5><span class="text-danger">*</span></h5>
<div class="controls">
<select name="year_name" id="" class="form-control">
    <option label="Choose One"></option>
    <option value="2020" >2020</option>
    <option value="2021" >2021</option>
    <option value="2022" >2022</option>
    <option value="2023" >2023</option>
    <option value="2024" >2024</option>
    <option value="2025" >2025</option>
    <option value="2026" >2026</option>
   



</select>
@error('year_name')
<span class="text-danger">{{$message}}</span>
@enderror
</div>

</div>



<div class="text-xs-right">
   <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Search">
  </div>
</form>

       </div>
   </div>
   <!-- /.box-body -->
 </div>
 <!-- /.box -->

 
 <!-- /.box -->          
</div>



<div class="col-4">

<div class="box">
   <div class="box-header with-border">
     <h3 class="box-title">Select year</h3>
   </div>
   <!-- /.box-header -->
   <div class="box-body">
       <div class="table-responsive">
        
       <form method="post" action="{{route('search-by-year')}}" enctype="multipart/form-data">
@csrf
              
     


<div class="form-group">
<h5>Select Year</h5><span class="text-danger">*</span></h5>
<div class="controls">
<select name="year" id="" class="form-control">
    <option label="Choose One"></option>
    <option value="2020" >2020</option>
    <option value="2021" >2021</option>
    <option value="2022" >2022</option>
    <option value="2023" >2023</option>
    <option value="2024" >2024</option>
    <option value="2025" >2025</option>
    <option value="2026" >2026</option>
   



</select>
@error('year')
<span class="text-danger">{{$message}}</span>
@enderror
</div>

</div>



<div class="text-xs-right">
   <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Search">
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