<!DOCTYPE html>
<html lang="en">
<head>
<!-- Meta -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="description" content="">
<meta name="csrf-token" content="{{csrf_token()}}">
<meta name="author" content="">
<meta name="keywords" content="MediaCenter, Template, eCommerce">
<meta name="robots" content="all">
<title>@yield('title')</title>

<!-- Bootstrap Core CSS -->
<link rel="stylesheet" href="{{asset('frontend/assets/css/bootstrap.min.css')}}">

<!-- Customizable CSS -->
<link rel="stylesheet" href="{{asset('frontend/assets/css/main.css')}}">
<link rel="stylesheet" href="{{asset('frontend/assets/css/blue.css')}}">
<link rel="stylesheet" href="{{asset('frontend/assets/css/owl.carousel.css')}}">
<link rel="stylesheet" href="{{asset('frontend/assets/css/owl.transitions.css')}}">
<link rel="stylesheet" href="{{asset('frontend/assets/css/animate.min.css')}}">
<link rel="stylesheet" href="{{asset('frontend/assets/css/rateit.css')}}">
<link rel="stylesheet" href="{{asset('frontend/assets/css/bootstrap-select.min.css')}}">

<!-- Icons/Glyphs -->
<link rel="stylesheet" href="{{asset('frontend/assets/css/font-awesome.css')}}">

<!-- Fonts -->
<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
</head>
<body class="cnt-home">
<!-- ============================================== HEADER ============================================== -->
@include('frontend.body.header')

<!-- ============================================== HEADER : END ============================================== -->
@yield('content')
<!-- /#top-banner-and-menu --> 

<!-- ============================================================= FOOTER ============================================================= -->
@include('frontend.body.footer')
<!-- ============================================================= FOOTER : END============================================================= --> 

<!-- For demo purposes – can be removed on production --> 

<!-- For demo purposes – can be removed on production : End --> 

<!-- JavaScripts placed at the end of the document so the pages load faster --> 
<script src="{{asset('frontend/assets/js/jquery-1.11.1.min.js')}}"></script> 
<script src="{{asset('frontend/assets/js/bootstrap.min.js')}}"></script> 
<script src="{{asset('frontend/assets/js/bootstrap-hover-dropdown.min.js')}}"></script> 
<script src="{{asset('frontend/assets/js/owl.carousel.min.js')}}"></script> 
<script src="{{asset('frontend/assets/js/echo.min.js')}}"></script> 
<script src="{{asset('frontend/assets/js/jquery.easing-1.3.min.js')}}"></script> 
<script src="{{asset('frontend/assets/js/bootstrap-slider.min.js')}}"></script> 
<script src="{{asset('frontend/assets/js/jquery.rateit.min.js')}}"></script> 
<script type="text/javascript" src="{{asset('frontend/assets/js/lightbox.min.js')}}"></script> 
<script src="{{asset('frontend/assets/js/bootstrap-select.min.js')}}"></script> 
<script src="{{asset('frontend/assets/js/wow.min.js')}}"></script> 
<script src="{{asset('frontend/assets/js/scripts.js')}}"></script>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> <span id="pname"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                <img src="" class="card-img-top" alt="..." style="height: 200px; width: 180px;" id="pimage">                    
                </div>

            </div>
            <div class="col-md-4">
                <ul class="list-group">
                <li class="list-group-item">Product Price: <strong class="text-danger">$<span id="pprice"></span></strong> 
                <del id="oldprice">$</del>
              </li>
  <li class="list-group-item">Product Code: <strong id="pcode"></strong></li>
  <li class="list-group-item">Category: <strong id="pcategory"></strong></li>
  <li class="list-group-item">Brand: <strong id="pbrand"></strong></li>
                    <li class="list-group-item">Stock: <span class="badge badge-pill badge-success" id="available" style="background: green; color:white;"></span>
                    <span class="badge badge-pill badge-danger" id="stockout" style="background: orange; color:white;"></span>
                  </li>
                </ul>


            </div>
            <div class="col-md-4">

                <div class="form-group">
                     <label for="exampleFormControlSelect1">Choose color</label>
                     <select class="form-control" id="exampleFormControlSelect1" name="color" id="color">
                       
                       
                    </select>
                </div>
            
                <div class="form-group" id="sizearea">
                     <label for="exampleFormControlSelect1">Choose size</label>
                     <select class="form-control" id="exampleFormControlSelect1" name="size" id="size">
                       
                       
                    </select>
                </div>

                <div class="form-group">
                     <label for="exampleFormControlSelect1">Quantity</label>
                    <input type="number" value="1" min="1" id="qty">
                </div>

<input type="hidden" id="product_id">
                <button type="submit" onclick="addToCart()" class="btn btn-primary mb-2">Add to Cart</button>

            </div>
        </div>




      </div>
      
    </div>
  </div>
</div>


<script type="text/javascript">
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    })

    function productView(id){
      $.ajax({
        type:'GET',
        url:'/product/view/modal/'+id,
        dataType:'json',
        success:function(data){
            $('#pname').text(data.product.product_name_en);
            $('#price').text(data.product.selling_price);
            $('#pcode').text(data.product.product_code);
            $('#pcategory').text(data.product.category.category_name_en);
            $('#pbrand').text(data.product.brand.brand_name_en);
            $('#pimage').attr('src','/'+data.product.product_thumbnail);
            $('#product_id').val(id);
            $('#qty').val(1);


            if (data.product.discount_price == null) {
              $('#pprice').text('');
              $('#oldprice').text('');
              $('#pprice').text(data.product.selling_price);
            } else {
              $('#pprice').text(data.product.discount_price);
              $('#oldprice').text(data.product.selling_price);
            }

            if (data.product.product_qty > 0) {
              $('#available').text('');
              $('#stockout').text('');
              $('#available').text('available');
            } else {
              $('#available').text('');
              $('#stockout').text('');
              $('#stockout').text('unavailable');
            }

            $('select[name="color"]').empty();
            $.each(data.color,function(key,value){
                $('select[name="color"]').append(' <option value="'+value+'">'+value+'  </option>');
            });
            $('select[name="size"]').empty();
            $.each(data.size,function(key,value){
                $('select[name="size"]').append(' <option value="'+value+'">'+value+'  </option>');
                
                if (data.size =="") {
                  $('#sizearea').hide();
                } else {
                  $('#sizearea').show();
                }
            });
        }
       
      })
    }
//

// add to cart 

function addToCart(){
  var product_name = $('#pname').text();
  var id = $('#product_id').val();

  var color = $('#color option:selected').text();
  var size = $('#size option:selected').text();

  var qty = $('#qty').val();
  $.ajax({
    type:"POST",
    dataType:'json',
    data:{
      color:color,
      size:size,
      quantity:qty,
      product_name:product_name,
    },
    url:"/cart/data/store/"+id,
    success:function(data){
      miniCart();
      $('#closeModal').click();
      
    }
  });
}

</script>

<script type="text/javascript">

  function miniCart(){
    $.ajax({
      type:'GET',
      url:'/product/mini/cart',
      dataType:'json',
      success:function(res){
        var miniCart = "";
        $('span[id="cartSub"]').text(res.cartTotal);
        $('#cartQty').text(res.cartQty);

        $.each(res.carts,function(key,val){
          miniCart += ` <div class="cart-item product-summary">
                  <div class="row">
                    <div class="col-xs-4">
                      <div class="image"> <a href="detail.html"><img src="/${val.options.image}" alt=""></a> </div>
                    </div>
                    <div class="col-xs-7">
                      <h3 class="name"><a href="index.php?page-detail">${val.name}</a></h3>
                      <div class="price">$ ${val.price} * ${val.qty} </div>
                    </div>
                    <div class="col-xs-1 action"> <button type="submit" id="${val.rowId}" onclick="miniCartRemove(this.id)"><i class="fa fa-trash"></i></button> </div>
                  </div>
                </div>
                <!-- /.cart-item -->
                <div class="clearfix"></div>
                <hr>`;
        });
        $('#miniCart').html(miniCart);
      }
    });

  }

  miniCart();
</script>

<script type="text/javascript">

  function miniCartRemove(id){

    $.ajax({
      type:'GET',
      url:'/minicart/product-remove/'+id,
      dataType:'json',
      success:function(data){
        miniCart();
      }
    })
  }
</script>

<script type="text/javascript">

  function addToWish(id){

    $.ajax({
      type:'POST',
      url:'/add-to-wishlist/'+id,
      dataType:'json',
      
      success:function(data){
        
      }
    })
  }
</script>


<script type="text/javascript">

  function wishlist(){
    $.ajax({
      type:'GET',
      url:'/user/get-wishlist-product',
      dataType:'json',
      success:function(res){
        var rows = "";
        

        $.each(res,function(key,val){
          rows += ` <tr>
					<td class="col-md-2"><img src="/${val.product.product_thumbnail}" alt="imga"></td>
					<td class="col-md-7">
						<div class="product-name"><a href="#">${val.product.product_name_en}</a></div>
						
						<div class="price">
            ${val.product.discount_price == null
            ?`${val.product.selling_price}`
            :`${val.product.discount_price} <span>${val.product.selling_price}</span>`
            }
							
						</div>
					</td>
					<td class="col-md-2">
          <button class="btn btn-primary icon" type="button" id="${val.product_id}" onclick="addToWish(this.id)" title="Add Cart"> <i class="fa fa-heart"></i>Add to Cart </button>
					</td>
					<td class="col-md-1 close-btn">
						<button type="submit" class="" id="${val.id}" onclick="wishRemove(this.id)"><i class="fa fa-times"></i></button>
					</td>
				</tr>`;
        });
        $('#wishlist').html(rows);
      }
    });

  }
  wishlist();
  
</script>

<script type="text/javascript">

  function wishRemove(id){

    $.ajax({
      type:'GET',
      url:'/user/wishlist-remove/'+id,
      dataType:'json',
      success:function(data){
        wishlist();
        
      }
    })
  }
</script>


<script type="text/javascript">

  function cart(){
    $.ajax({
      type:'GET',
      url:'/get-mycart',
      dataType:'json',
      success:function(res){
        var rows = "";
        

        $.each(res.carts,function(key,val){
          rows += ` <tr>
					<td class="col-md-1"><img src="/${val.options.image}" alt="imga" style="width:60px;height:60px;"></td>
					<td class="col-md-1">
						<div class="product-name"><a href="#">${val.name}</a></div>
						
						<div class="price">
           
           ${val.price}
							
						</div>
					</td>

          <td class="col-md-1">
            <strong>${val.options.color}</strong>
          </td>

          <td class="col-md-1">
          ${val.options.size == null 
          ? `<span>...</span>`
          : `<strong>${val.options.size}</strong>`
          }
           
          </td>

          <td class="col-md-1">

          ${val.qty > 1
            ? `<button type="submit" class="btn btn-danger btn-sm" id="${val.rowId}" onclick="decrement(this.id)" >-</button> `
            : `<button type="submit" class="btn btn-danger btn-sm" disabled >-</button> `
            }
				<input type="text" value="${val.qty}" min="1" max="100" disabled style="width:25px;">
        <button type="submit" class="btn btn-success btn-sm" id="${val.rowId}" onclick="increment(this.id)">+</button>

          </td>

          <td class="col-md-1">
            <strong>$${val.subtotal}</strong>
          </td>
					
					<td class="col-md-1 close-btn">
						<button type="submit" class="" id="${val.rowId}" onclick="remove(this.id)"><i class="fa fa-times"></i></button>
					</td>
				</tr>`;
        });
        $('#cart').html(rows);
      }
    });

  }
  cart();
  


</script>

<script type="text/javascript">

  function remove(id){

    $.ajax({
      type:'GET',
      url:'/cart-remove/'+id,
      dataType:'json',
      success:function(data){
        couponCalc();
        cart();
        miniCart();
        $('#couponField').show();
        $('#coupon_name').val('');
        
      }
    })
  }

  function increment(id){

$.ajax({
  type:'GET',
  url:'/cart-increment/'+id,
  dataType:'json',
  success:function(data){
    cart();
    miniCart();
    couponCalc();
    
  }
})
}


function decrement(id){

$.ajax({
  type:'GET',
  url:'/cart-decrement/'+id,
  dataType:'json',
  success:function(data){
    cart();
    miniCart();
    couponCalc();
    
  }
})
}
</script>


<script type="text/javascript">
  function applyCoupon(){
    var coupon = $('#coupon_name').val();
    $.ajax({
      type:'POST',
      url:"{{url('/coupon-apply')}}",
      dataType:'json',
      data:{coupon_name:coupon},
      success:function(data){
        couponCalc();
        $('#couponField').hide();
    
  }
    })
  }

  function couponCalc(){

    var couponAmount = $('#couponCalField');
    $.ajax({
      type:'GET',
      url:"{{url('/coupon-calculation')}}",
      dataType:'json',
      
      success:function(data){
        if (data.total) {
          couponAmount.html(
            `<tr>
				<th>
					<div class="cart-sub-total">
						Subtotal<span class="inner-left-md">$ ${data.total}</span>
					</div>
					<div class="cart-grand-total">
						Grand Total<span class="inner-left-md">$ ${data.total}</span>
					</div>
				</th>
			</tr>`
          );
        }
        else{
          couponAmount.html(
            `<tr>
				<th>
					<div class="cart-sub-total">
						Subtotal<span class="inner-left-md">$ ${data.subtotal}</span>
					</div>
          <div class="cart-sub-total">
						Coupon<span class="inner-left-md">$ ${data.coupon_name}</span>
            <button type="submit" onclick="removeCoupon()"><i class="fa fa-times"></i> </button>
					</div>

          <div class="cart-sub-total">
						Discount amount<span class="inner-left-md">$ ${data.discount_amount}</span>
					</div>
					<div class="cart-grand-total">
						Grand Total<span class="inner-left-md">$ ${data.total_amount}</span>
					</div>
				</th>
			</tr>`
          );
        }
    
  }
    })
  }

  couponCalc();
</script>

<script type="text/javascript">

  function removeCoupon(){
    $.ajax({
      type:'GET',
      url:"{{url('/coupon-removal')}}",
      dataType:'json',
      success:function(data){
        couponCalc();
        $('#couponField').show();
        $('#coupon_name').val('');
      }
    })
  }
</script>

</body>
</html>