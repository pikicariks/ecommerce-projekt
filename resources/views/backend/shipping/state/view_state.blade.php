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
				  <h3 class="box-title">State list</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
                                <th>Division</th> 
                                <th>District</th>
								<th>State name</th>
								
                                <th>Action</th>
								
							</tr>
						</thead>
						<tbody>
                            @foreach($state as $item)
							<tr>
								<td>{{$item['division']['division_name']}}</td>
                                <td>{{$item['district']['district_name']}}</td>
                                <td>{{$item->state_name}}</td>
								
								<td width="30%">
                                    <a href="{{route('state.edit',$item->id)}}" class="btn btn-info" title = "Edit data"><i class="fa fa-pencil"></i></a>
                                    <a href="{{route('state.delete',$item->id)}}" class="btn btn-danger" id="delete" title = "Delete data"><i class="fa fa-trash"></i></a>
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
				  <h3 class="box-title">Add State</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					 
                    <form method="post" action="{{route('state.store')}}" >
             @csrf
           				
                  

             <div class="form-group">
                <h5>Division Select <span class="text-danger">*</span></h5>
                <div class="controls">
                    <select name="division_id"  required class="form-control">
                        <option value="" selected="" disabled="">Select Division</option>
						@foreach($division as $div)
						<option value="{{$div->id}}">{{$div->division_name}}</option>
						@endforeach
                    </select>
					@error('division_id')
            <span class="text-danger">{{$message}}</span>
        @enderror
                </div>
            </div>

            <div class="form-group">
                <h5>District Select <span class="text-danger">*</span></h5>
                <div class="controls">
                    <select name="district_id"  required class="form-control">
                        <option value="" selected="" disabled="">Select District</option>
						@foreach($district as $dis)
						<option value="{{$dis->id}}">{{$dis->district_name}}</option>
						@endforeach
                    </select>
					@error('district_id')
            <span class="text-danger">{{$message}}</span>
        @enderror
                </div>
            </div>

     <div class="form-group">
        <h5>State name </h5><span class="text-danger">*</span></h5>
         <div class="controls">
        <input type="text" name="state_name"  class="form-control" required data-validation-required-message="This field is required"> </div>
        @error('state_name')
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