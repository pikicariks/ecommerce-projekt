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
				  <h3 class="box-title">Total user <span class="badge badge-pill badge-danger"> {{$user->count()}}</span></h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Image</th>
								<th>Name</th>
								<th>Email</th>
								<th>Phone</th>
								<th>Status</th>
								<th>Action</th>
								
							</tr>
						</thead>
						<tbody>
                            @foreach($user as $item)
							<tr>
							<td><img src="{{(!empty($item->profile_photo_path)) ? url('upload/user_images/'.$item->profile_photo_path) :url('upload/no_image.jpg')}}" style ="width:70px;height:40px;" alt=""></td>

								<td>{{$item->name}}</td>
								<td>{{$item->email}}</td>
								<td>{{$item->phone}}</td>
								<td>
								@if($item->UserOnline())
								<span class="badge badge-pill badge-success">Active now</span>

								@else
								<span class="badge badge-pill badge-danger">{{Carbon\Carbon::parse($item->last_seen)->diffForHumans()}}</span>

								@endif
								
								</td>
								<td>
                                    <a href="" class="btn btn-info" title = "Edit data"><i class="fa fa-pencil"></i></a>
                                    <a href="" class="btn btn-danger" id="delete" title = "Delete data"><i class="fa fa-trash"></i></a>
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

           
			<!-- /.col -->
		  </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->
	  
	  </div>

@endsection