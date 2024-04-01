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
				  <h3 class="box-title">Product stock <span class="badge badge-pill badge-danger"> {{$products->count()}}</span></h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Image</th>
								<th>Product En</th>
								<th>Product price</th>
                                <th>Quantity</th>
								<th>Discount</th>
								<th>Status</th>
								
								
							</tr>
						</thead>
						<tbody>
                            @foreach($products as $prod)
							<tr>
								<td><img src="{{asset($prod->product_thumbnail)}}" style="width:60px;height:50px;" alt=""></td>
								<td>{{$prod->product_name_en}}</td>
								<td>{{$prod->selling_price}}</td>
                                <td>{{$prod->product_qty}}</td>
								<td>
								@if($prod->discount_price == NULL)
		 	<span class="badge badge-pill badge-danger">No Discount</span>

		 	@else
		 	@php
		 	$amount = $prod->selling_price - $prod->discount_price;
		 	$discount = ($amount/$prod->selling_price) * 100;
		 	@endphp
           <span class="badge badge-pill badge-danger">{{ round($discount)  }} %</span>

		 	@endif
								</td>
								<td>@if($prod->status == 1)
									<span class="badge badge-pill badge-success">Active</span>
								@else
								<span class="badge badge-pill badge-danger">InActive</span>
								@endif
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


      

@endsection