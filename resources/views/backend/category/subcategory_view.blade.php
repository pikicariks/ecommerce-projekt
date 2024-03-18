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
				  <h3 class="box-title">SubCategory list <span class="badge badge-pill badge-danger"> {{$subcategories->count()}}</span></h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Category</th>
								<th>SubCategory Name En</th>
								<th>SubCategory Name Hin</th>
								<th>Action</th>
								
							</tr>
						</thead>
						<tbody>
                            @foreach($subcategories as $item)
							<tr>
								<td>{{$item['category']['category_name_en']}}</td>
								<td>{{$item->subcategory_name_en}}</td>
								<td>{{$item->subcategory_name_hin}}</td>
								<td width="30%;">
                                    <a href="{{route('subcategory.edit',$item->id)}}" class="btn btn-info" title = "Edit data"><i class="fa fa-pencil"></i></a>
                                    <a href="{{route('subcategory.delete',$item->id)}}" class="btn btn-danger" id="delete" title = "Delete data"><i class="fa fa-trash"></i></a>
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
				  <h3 class="box-title">Add SubCategory</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					 
                    <form method="post" action="{{route('subcategory.store')}}" >
             @csrf
           				
                  

   
             <div class="form-group">
                <h5>Category Select <span class="text-danger">*</span></h5>
                <div class="controls">
                    <select name="category_id"  required class="form-control">
                        <option value="" selected="" disabled="">Select Category</option>
						@foreach($category as $cat)
						<option value="{{$cat->id}}">{{$cat->category_name_en}}</option>
						@endforeach
                    </select>
					@error('category_id')
            <span class="text-danger">{{$message}}</span>
        @enderror
                </div>
            </div>

<div class="form-group">
        <h5>SubCategory name English<span class="text-danger">*</span></h5>
         <div class="controls">
        <input type="text" name="subcategory_name_en"  class="form-control" required data-validation-required-message="This field is required"> </div>
        @error('subcategory_name_en')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>


    <div class="form-group">
        <h5>SubCategory name Hindi<span class="text-danger">*</span></h5>
         <div class="controls">
        <input type="text" name="subcategory_name_hin"  class="form-control" required data-validation-required-message="This field is required"> </div>
        @error('subcategory_name_hin')
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