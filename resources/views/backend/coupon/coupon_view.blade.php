@extends('admin.admin_master')
@section('admin')

<div class="container-full">
		<!-- Content Header (Page header) -->
		

		<!-- Main content -->
		<section class="content">
		  <div class="row">
			  
			

			

			 

			<div class="col-8">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Coupon list <span class="badge badge-pill badge-danger"> {{$coupons->count()}}</span></h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Coupon name</th>
								<th>Coupon discount</th>
								<th>Coupon validity</th>
								<th>Status</th>
                                <th>Action</th>
								
							</tr>
						</thead>
						<tbody>
                            @foreach($coupons as $item)
							<tr>
								<td>{{$item->coupon_name}}</td>
								<td>{{$item->coupon_discount}}</td>
								<td>
                                    {{Carbon\Carbon::parse($item->coupon_validity)->format('D,d F Y')}}
                                </td>
                                <td>
                                @if($item->coupon_validity >= Carbon\Carbon::now()->format('Y-m-d'))
									<span class="badge badge-pill badge-success">Valid</span>
								@else
								<span class="badge badge-pill badge-danger">Invalid</span>
								@endif
                                </td>
								<td width="30%">
                                    <a href="{{route('coupon.edit',$item->id)}}" class="btn btn-info" title = "Edit data"><i class="fa fa-pencil"></i></a>
                                    <a href="{{route('coupon.delete',$item->id)}}" class="btn btn-danger" id="delete" title = "Delete data"><i class="fa fa-trash"></i></a>
                                </td>
								
							</tr>
                            @endforeach
							
						</tbody>
						
					  </table>
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
				  <h3 class="box-title">Add Coupon</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					 
                    <form method="post" action="{{route('coupon.store')}}" >
             @csrf
           				
                  

   
     <div class="form-group">
        <h5>Coupon name </h5><span class="text-danger">*</span></h5>
         <div class="controls">
        <input type="text" name="coupon_name"  class="form-control" required data-validation-required-message="This field is required"> </div>
        @error('coupon_name')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>

<div class="form-group">
        <h5>Coupon discount(%)<span class="text-danger">*</span></h5>
         <div class="controls">
        <input type="text" name="coupon_discount"  class="form-control" required data-validation-required-message="This field is required"> </div>
        @error('coupon_discount')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>


    <div class="form-group">
        <h5>Validity<span class="text-danger">*</span></h5>
         <div class="controls">
        <input type="date" name="coupon_validity"  class="form-control" required data-validation-required-message="This field is required" min="{{Carbon\Carbon::now()->format('Y-m-d')}}"> </div>
        @error('coupon_validity')
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