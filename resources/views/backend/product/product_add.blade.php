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
			  <h4 class="box-title">Add product</h4>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form method="post" enctype="multipart/form-data" action="{{route('product-store')}}">

					@csrf
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
						<option value="{{$brand->id}}">{{$brand->brand_name_en}}</option>
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
						<option value="{{$cat->id}}">{{$cat->category_name_en}}</option>
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
									<input type="text" name="product_name_en" class="form-control" required data-validation-required-message="This field is required"> </div>
									@error('product_name_en')
            <span class="text-danger">{{$message}}</span>
        @enderror
								</div>

                            </div> 

                            <div class="col-md-4">

							<div class="form-group">
								<h5>Product name hin<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="product_name_hin" class="form-control" required data-validation-required-message="This field is required"> </div>
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
									<input type="text" name="product_code" class="form-control" required data-validation-required-message="This field is required"> </div>
									@error('product_code')
            <span class="text-danger">{{$message}}</span>
        @enderror
								</div>
                            </div> 

                            <div class="col-md-4">
							<div class="form-group">
								<h5>Product qty<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="product_qty" class="form-control" required data-validation-required-message="This field is required"> </div>
									@error('product_qty')
            <span class="text-danger">{{$message}}</span>
        @enderror
								</div>

                            </div> 

                            <div class="col-md-4">

							<div class="form-group">
								<h5>Product tags en<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="product_tags_en" class="form-control" required data-validation-required-message="This field is required" value="Lorem,Ipsum,Amet" data-role="tagsinput"> </div>
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
									<input type="text" name="product_tags_hin" class="form-control" required data-validation-required-message="This field is required" value="Lorem,Ipsum,Amet" data-role="tagsinput"> </div>
									@error('product_tags_hin')
            <span class="text-danger">{{$message}}</span>
        @enderror
								</div>
                            </div> 

                            <div class="col-md-4">
							<div class="form-group">
								<h5>Product size en<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="product_size_en" class="form-control" required data-validation-required-message="This field is required" value="small,medium,large" data-role="tagsinput"> </div>
									@error('product_size_en')
            <span class="text-danger">{{$message}}</span>
        @enderror
								</div>

                            </div> 

                            <div class="col-md-4">

							<div class="form-group">
								<h5>Product size hin<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="product_size_hin" class="form-control" required data-validation-required-message="This field is required" value="nesto,Ipsum,Amet" data-role="tagsinput"> </div>
									@error('product_size_hin')
            <span class="text-danger">{{$message}}</span>
        @enderror
								</div>

                            </div> 
                        </div>




						<div class="row"> 
                            <div class="col-md-4">
							<div class="form-group">
								<h5>Product color en<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="product_color_en" class="form-control" required data-validation-required-message="This field is required" value="Lorem,Ipsum,Amet" data-role="tagsinput"> </div>
									@error('product_color_en')
            <span class="text-danger">{{$message}}</span>
        @enderror
								</div>
                            </div> 

                            <div class="col-md-4">
							<div class="form-group">
								<h5>Product color hin<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="product_color_hin" class="form-control" required data-validation-required-message="This field is required" value="small,medium,large" data-role="tagsinput"> </div>
									@error('product_color_hin')
            <span class="text-danger">{{$message}}</span>
        @enderror
								</div>

                            </div> 

                            <div class="col-md-4">

							<div class="form-group">
								<h5>Selling price<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="selling_price" class="form-control" required data-validation-required-message="This field is required" > </div>
									@error('selling_price')
            <span class="text-danger">{{$message}}</span>
        @enderror
								</div>

                            </div> 
                        </div>


						<div class="row"> 
                            <div class="col-md-4">
							<div class="form-group">
								<h5>Discount price<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="discount_price" class="form-control" required data-validation-required-message="This field is required" > </div>
									@error('discount_price')
            <span class="text-danger">{{$message}}</span>
        @enderror
								</div>
                            </div> 

                            <div class="col-md-4">
							<div class="form-group">
								<h5>Main thumbnail<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="file" name="product_thumbnail" class="form-control" required data-validation-required-message="This field is required" onchange="mainThumbUrl(this)"> </div>
									@error('product_thumbnail')
            <span class="text-danger">{{$message}}</span>
        @enderror
		<img src="" id="mainThumb" alt="">
								</div>

                            </div> 

                            <div class="col-md-4">

							<div class="form-group">
								<h5>Multiple image<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="file" name="multi_img[]" class="form-control" required data-validation-required-message="This field is required" multiple id="multiImg"> </div>
									@error('multi_img')
            <span class="text-danger">{{$message}}</span>
        @enderror
		<div class="row" id="preview">

		</div>
								</div>

                            </div> 
                        </div>
							
							
						<div class="row"> 
                            <div class="col-md-6">
							<div class="form-group">
								<h5>Short desc en<span class="text-danger">*</span></h5>
								<div class="controls">
								<textarea name="short_desc_en" id="textarea" class="form-control" required placeholder="Textarea text"></textarea>
									
								</div>
                            </div> 
							</div>
                            <div class="col-md-6">
							<div class="form-group">
								<h5>Short desc hin<span class="text-danger">*</span></h5>
								<div class="controls">
								<textarea name="short_desc_hin" id="textarea" class="form-control" required placeholder="Textarea text"></textarea>
									
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
								Long desc en
						</textarea>									
								</div>
                            </div> 
							</div>
                            <div class="col-md-6">
							<div class="form-group">
								<h5>Long desc hin<span class="text-danger">*</span></h5>
								<div class="controls">
								<textarea id="editor2" name="long_desc_hin" rows="10" cols="80">
								Long desc hin
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
											<input type="checkbox" id="checkbox_2" name="hot_deals"  value="1">
											<label for="checkbox_2">Hot deals</label>
										</fieldset>
										<fieldset>
											<input type="checkbox" id="checkbox_3" name="featured" value="1">
											<label for="checkbox_3">Featured</label>
										</fieldset>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<div class="controls">
										<fieldset>
											<input type="checkbox" id="checkbox_4" name="special_offer"  value="1">
											<label for="checkbox_5">Special offer</label>
										</fieldset>
										<fieldset>
											<input type="checkbox" id="checkbox_5" name="special_deals" value="1">
											<label for="checkbox_5">Special deals</label>
										</fieldset>
									</div>
								</div>
							</div>
						</div>
						
						<div class="text-xs-right">
							<button type="submit" btn btn-rounded btn-primary mb-5">Add</button>
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