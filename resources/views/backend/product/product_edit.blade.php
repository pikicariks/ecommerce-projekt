@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>



	  <div class="container-full">
		<!-- Content Header (Page header) -->
		  

		<!-- Main content -->
		<section class="content">

		 <!-- Basic Forms -->
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Edit product</h4>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form method="post"  action="{{route('product-update')}}">

					@csrf
					<input type="hidden" name="id" value="{{$product->id}}">
					  <div class="row">
						<div class="col-12">						
							

                        <div class="row"> 
                            <div class="col-md-4">
                            <div class="form-group">
                <h5>Brand Select <span class="text-danger">*</span></h5>
                <div class="controls">
                    <select name="brand_id"  required class="form-control">
                        <option value="" disabled="">Selected Category</option>
						@foreach($brands as $brand)
						<option value="{{$brand->id}}" {{$brand->id == $product->brand_id ? 'selected':''}}>{{$brand->brand_name_en}}</option>
						@endforeach
                    </select>
					@error('brand_id')
            <span class="text-danger">{{$message}}</span>
        @enderror
                </div>
            </div>
                            </div> 

                            <div class="col-md-4">
                            <div class="form-group">
                <h5>Category Select <span class="text-danger">*</span></h5>
                <div class="controls">
                    <select name="category_id"  required class="form-control">
                        <option value="" disabled="">Selected Category</option>
						@foreach($categories as $cat)
						<option value="{{$cat->id}}" {{$cat->id == $product->category_id ? 'selected':''}}>{{$cat->category_name_en}}</option>
						@endforeach
                    </select>
					@error('category_id')
            <span class="text-danger">{{$message}}</span>
        @enderror
                </div>
            </div>

                            </div> 

                            <div class="col-md-4">

                            <div class="form-group">
                <h5>SubCategory Select <span class="text-danger">*</span></h5>
                <div class="controls">
                    <select name="subcategory_id"  required class="form-control">
                        <option value="" disabled="">Selected SubCategory</option>
						@foreach($subcategories as $subcat)
						<option value="{{$subcat->id}}" {{$subcat->id == $product->subcategory_id ? 'selected':''}}>{{$subcat->subcategory_name_en}}</option>
						@endforeach
                    </select>
					@error('subcategory_id')
            <span class="text-danger">{{$message}}</span>
        @enderror
                </div>
            </div>

                            </div> 
                        </div>



						<div class="row"> 
                            <div class="col-md-4">
                            <div class="form-group">
                <h5>SubSubCategory Select <span class="text-danger">*</span></h5>
                <div class="controls">
                    <select name="subsubcategory_id"  required class="form-control">
                        <option value="" disabled="">Selected SubSubCategory</option>
						@foreach($subsubcategories as $ssubcat)
						<option value="{{$ssubcat->id}}" {{$ssubcat->id == $product->subsubcategory_id ? 'selected':''}}>{{$ssubcat->subsubcategory_name_en}}</option>
						@endforeach
                    </select>
					@error('subsubcategory_id')
            <span class="text-danger">{{$message}}</span>
        @enderror
                </div>
            </div>
                            </div> 

                            <div class="col-md-4">
							<div class="form-group">
								<h5>Product name en<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="product_name_en" class="form-control" required data-validation-required-message="This field is required" value="{{$product->product_name_en}}"> </div>
									@error('product_name_en')
            <span class="text-danger">{{$message}}</span>
        @enderror
								</div>

                            </div> 

                            <div class="col-md-4">

							<div class="form-group">
								<h5>Product name hin<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="product_name_hin" class="form-control" required data-validation-required-message="This field is required" value="{{$product->product_name_hin}}"> </div>
									@error('product_name_hin')
            <span class="text-danger">{{$message}}</span>
        @enderror
								</div>

                            </div> 
                        </div>	
						
						

						<div class="row"> 
                            <div class="col-md-4">
							<div class="form-group">
								<h5>Product code<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="product_code" class="form-control" required data-validation-required-message="This field is required" value="{{$product->product_code}}"> </div>
									@error('product_code')
            <span class="text-danger">{{$message}}</span>
        @enderror
								</div>
                            </div> 

                            <div class="col-md-4">
							<div class="form-group">
								<h5>Product qty<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="product_qty" class="form-control" required data-validation-required-message="This field is required" value="{{$product->product_qty}}"> </div>
									@error('product_qty')
            <span class="text-danger">{{$message}}</span>
        @enderror
								</div>

                            </div> 

                            <div class="col-md-4">

							<div class="form-group">
								<h5>Product tags en<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="product_tags_en" class="form-control" required data-validation-required-message="This field is required"  data-role="tagsinput" value="{{$product->product_tags_en}}"> </div>
									@error('product_tags_en')
            <span class="text-danger">{{$message}}</span>
        @enderror
								</div>

                            </div> 
                        </div>
							
							

						<div class="row"> 
                            <div class="col-md-4">
							<div class="form-group">
								<h5>Product tags hin<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="product_tags_hin" class="form-control" required data-validation-required-message="This field is required"  data-role="tagsinput" value="{{$product->product_tags_hin}}"> </div>
									@error('product_tags_hin')
            <span class="text-danger">{{$message}}</span>
        @enderror
								</div>
                            </div> 

                            <div class="col-md-4">
							<div class="form-group">
								<h5>Product size en<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="product_size_en" class="form-control" required data-validation-required-message="This field is required"  data-role="tagsinput" value="{{$product->product_size_en}}"> </div>
									@error('product_size_en')
            <span class="text-danger">{{$message}}</span>
        @enderror
								</div>

                            </div> 

                            <div class="col-md-4">

							<div class="form-group">
								<h5>Product size hin<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="product_size_hin" class="form-control" required data-validation-required-message="This field is required" data-role="tagsinput" value="{{$product->product_size_hin}}"> </div>
									@error('product_size_hin')
            <span class="text-danger">{{$message}}</span>
        @enderror
								</div>

                            </div> 
                        </div>




						<div class="row"> 
                            <div class="col-md-6">
							<div class="form-group">
								<h5>Product color en<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="product_color_en" class="form-control" required data-validation-required-message="This field is required" value="{{$product->product_color_en}}" data-role="tagsinput"> </div>
									@error('product_color_en')
            <span class="text-danger">{{$message}}</span>
        @enderror
								</div>
                            </div> 

                            <div class="col-md-6">
							<div class="form-group">
								<h5>Product color hin<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="product_color_hin" class="form-control" required data-validation-required-message="This field is required" value="{{$product->product_color_hin}}" data-role="tagsinput"> </div>
									@error('product_color_hin')
            <span class="text-danger">{{$message}}</span>
        @enderror
								</div>

                            </div> 

                           
                        </div>


						<div class="row"> 

                        <div class="col-md-6">
							
                            <div class="form-group">
								<h5>Selling price<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="selling_price" class="form-control" required data-validation-required-message="This field is required" value="{{$product->selling_price}}"> </div>
									@error('selling_price')
            <span class="text-danger">{{$message}}</span>
        @enderror
								</div>
                            </div> 
                            <div class="col-md-6">
							<div class="form-group">
								<h5>Discount price<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="discount_price" class="form-control" required data-validation-required-message="This field is required" value="{{$product->discount_price}}"> </div>
									@error('discount_price')
            <span class="text-danger">{{$message}}</span>
        @enderror
								</div>
                            </div> 

                           

                          
                        </div>
							
							
						<div class="row"> 
                            <div class="col-md-6">
							<div class="form-group">
								<h5>Short desc en<span class="text-danger">*</span></h5>
								<div class="controls">
								<textarea name="short_desc_en" id="textarea" class="form-control" required placeholder="Textarea text" >
                                    {{!! $product->short_desc_en !!}}
                                </textarea>
									
								</div>
                            </div> 
							</div>
                            <div class="col-md-6">
							<div class="form-group">
								<h5>Short desc hin<span class="text-danger">*</span></h5>
								<div class="controls">
								<textarea name="short_desc_hin" id="textarea" class="form-control" required placeholder="Textarea text" >
                                {{!! $product->short_desc_hin !!}}
                                </textarea>
									
								</div>
                            </div> 

                            </div> 

                           
							</div>
							
							

							<div class="row"> 
                            <div class="col-md-6">
							<div class="form-group">
								<h5>Long desc en<span class="text-danger">*</span></h5>
								<div class="controls">
								<textarea id="editor1" name="long_desc_en" rows="10" cols="80">
								{{!! $product->long_desc_en !!}}
						</textarea>									
								</div>
                            </div> 
							</div>
                            <div class="col-md-6">
							<div class="form-group">
								<h5>Long desc hin<span class="text-danger">*</span></h5>
								<div class="controls">
								<textarea id="editor2" name="long_desc_hin" rows="10" cols="80" >
								{{!! $product->long_desc_hin !!}}
						</textarea>									
								</div>
                            </div> 

                            </div> 

                           
							</div>
						
					  </div>


					  <hr>


						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<div class="controls">
										<fieldset>
											<input type="checkbox" id="checkbox_2" name="hot_deals"  value="1" {{$product->hot_deals == 1 ? 'checked':''}}>
											<label for="checkbox_2">Hot deals</label>
										</fieldset>
										<fieldset>
											<input type="checkbox" id="checkbox_3" name="featured" value="1" {{$product->featured == 1 ? 'checked':''}}>
											<label for="checkbox_3">Featured</label>
										</fieldset>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<div class="controls">
										<fieldset>
											<input type="checkbox" id="checkbox_4" name="special_offer"  value="1" {{$product->special_offer == 1 ? 'checked':''}}>
											<label for="checkbox_5">Special offer</label>
										</fieldset>
										<fieldset>
											<input type="checkbox" id="checkbox_5" name="special_deals" value="1" {{$product->special_deals == 1 ? 'checked':''}}>
											<label for="checkbox_5">Special deals</label>
										</fieldset>
									</div>
								</div>
							</div>
						</div>
						
						<div class="text-xs-right">
							<button type="submit" class="btn btn-rounded btn-primary mb-5">Update product</button>
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


		<section class="content">
 	<div class="row">

<div class="col-md-12">
				<div class="box bt-3 border-info">
				  <div class="box-header">
		 <h4 class="box-title">Product Multiple Image <strong>Update</strong></h4>
				  </div>


		<form method="post" action="{{ route('update-product-image') }}" enctype="multipart/form-data">
		@csrf
			<div class="row row-sm">
				@foreach($multiImgs as $img)
				<div class="col-md-3">

<div class="card">
  <img src="{{ asset($img->photo_name) }}" class="card-img-top" style="height: 130px; width: 280px;">
  <div class="card-body">
    <h5 class="card-title">
<a href="{{ route('product.multiimg.delete',$img->id) }}" class="btn btn-sm btn-danger" id="delete" title="Delete Data"><i class="fa fa-trash"></i> </a>
     </h5>
    <p class="card-text"> 
    	<div class="form-group">
    		<label class="form-control-label">Change Image <span class="tx-danger">*</span></label>
    		<input class="form-control" type="file" name="multi_img[ {{ $img->id }} ]">
    	</div> 
    </p>

  </div>
</div> 		

				</div><!--  end col md 3		 -->	
				@endforeach

			</div>			

			<div class="text-xs-right">
<input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Image">
		 </div>
<br><br>



		</form>		   





				</div>
			  </div>



 	</div> <!-- // end row  -->

 </section>


 <section class="content">
 	<div class="row">

<div class="col-md-12">
				<div class="box bt-3 border-info">
				  <div class="box-header">
		 <h4 class="box-title">Product Thambnail Image <strong>Update</strong></h4>
				  </div>


		<form method="post" action="{{ route('update-product-thambnail') }}" enctype="multipart/form-data">
        @csrf

     <input type="hidden" name="id" value="{{ $product->id }}">
    <input type="hidden" name="old_img" value="{{ $product->product_thumbnail }}">

			<div class="row row-sm">

				<div class="col-md-3">

<div class="card">
  <img src="{{ asset($product->product_thumbnail) }}" class="card-img-top" style="height: 130px; width: 280px;">
  <div class="card-body">

    <p class="card-text"> 
    	<div class="form-group">
    		<label class="form-control-label">Change Image <span class="tx-danger">*</span></label>
    <input type="file" name="product_thumbnail" class="form-control" onChange="mainThumbUrl(this)"  >
     <img src="" id="mainThumb">
    	</div> 
    </p>

  </div>
</div> 		

				</div><!--  end col md 3		 -->	


			</div>			

			<div class="text-xs-right">
<input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Image">
		 </div>
<br><br>



		</form>		   


	  </div>



				</div>
			  </div>



 	</div> <!-- // end row  -->

 </section>
		<!-- /.content -->
	  </div>
    


	  <script type="text/javascript">
         $(document).ready(function() {
        $('select[name="category_id"]').on('change', function(){
            var category_id = $(this).val();
            if(category_id) {
                $.ajax({
                    url: "{{  url('/category/subcategory/ajax') }}/"+category_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
						$('select[name="subsubcategory_id"]').html('');
                       var d =$('select[name="subcategory_id"]').empty();
                          $.each(data, function(key, value){
                              $('select[name="subcategory_id"]').append('<option value="'+ value.id +'">' + value.subcategory_name_en + '</option>');
                          });
                    },
                });
            } else {
                alert('danger');
            }
        });




		$('select[name="subcategory_id"]').on('change', function(){
            var subcategory_id = $(this).val();
            if(subcategory_id) {
                $.ajax({
                    url: "{{  url('/category/sub-subcategory/ajax') }}/"+subcategory_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                       var d =$('select[name="subsubcategory_id"]').empty();
                          $.each(data, function(key, value){
                              $('select[name="subsubcategory_id"]').append('<option value="'+ value.id +'">' + value.subsubcategory_name_en + '</option>');
                          });
                    },
                });
            } else {
                alert('danger');
            }
        });
    });
      </script>

	  <script>
		function mainThumbUrl(e){
			if (e.files && e.files[0]) {
				var reader = new FileReader();
				reader.onload = (e) =>{
					$('#mainThumb').attr('src',e.target.result).width(80).height(80);

				}
				reader.readAsDataURL(e.files[0]);
			}

		}
	  </script>

<script>
		 $(document).ready(function(){
   $('#multiImg').on('change', function(){ //on file input change
      if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
      {
          var data = $(this)[0].files; //this file data
           
          $.each(data, function(index, file){ //loop though each file
              if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                  var fRead = new FileReader(); //new filereader
                  fRead.onload = (function(file){ //trigger function on successful read
                  return function(e) {
                      var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(80)
                  .height(80); //create image element 
                      $('#preview').append(img); //append image to output element
                  };
                  })(file);
                  fRead.readAsDataURL(file); //URL representing the file's data.
              }
          });
           
      }else{
          alert("Your browser doesn't support File API!"); //if File API is absent
      }
   });
  });
	  </script>
@endsection