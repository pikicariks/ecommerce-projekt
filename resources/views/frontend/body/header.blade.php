<header class="header-style-1"> 
  
  <!-- ============================================== TOP MENU ============================================== -->
  <div class="top-bar animate-dropdown">
    <div class="container">
      <div class="header-top-inner">
        <div class="cnt-account">
          <ul class="list-unstyled">
            <li><a href="#"><i class="icon fa fa-user"></i>
            @if(session()->get('language') == 'bosnian') Profil @else  My Account @endif

           </a></li>
            <li><a href="{{route('wishlist')}}"><i class="icon fa fa-heart"></i>
            @if(session()->get('language') == 'bosnian') Omiljeno @else  Wishlist @endif

            </a></li>
            <li><a href="{{route('cart')}}"><i class="icon fa fa-shopping-cart"></i>
            @if(session()->get('language') == 'bosnian') Korpa @else  My Cart @endif

            </a></li>
            <li><a href="{{route('checkout')}}"><i class="icon fa fa-check"></i>
            @if(session()->get('language') == 'bosnian') Kupi @else  Checkout @endif

            </a></li>

            <li><a href="" type="button" data-toggle="modal" data-target="#ordertracking"><i class="icon fa fa-check"></i>
Order tracking
            </a></li>

            @auth
            <li><a href="{{route('login')}}"><i class="icon fa fa-user"></i>User profile</a></li>
            @else
            <li><a href="{{route('login')}}"><i class="icon fa fa-lock"></i>Login/Register</a></li>
            @endauth
            

          </ul>
        </div>
        <!-- /.cnt-account -->
        
        <div class="cnt-block">
          <ul class="list-unstyled list-inline">
            <li class="dropdown dropdown-small"> <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="value">USD </span><b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">USD</a></li>
                <li><a href="#">INR</a></li>
                <li><a href="#">GBP</a></li>
              </ul>
            </li>
            <li class="dropdown dropdown-small"> <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="value">
              @if(session()->get('language') == 'bosnian') Jezik @else Language @endif
             </span><b class="caret"></b></a>
              <ul class="dropdown-menu">
                @if(session()->get('language') == 'bosnian')
                <li><a href="{{route('english.language')}}">English</a></li>
                @else
                <li><a href="{{route('bosnian.language')}}">Bosanski</a></li>
                @endif
                
              </ul>
            </li>
          </ul>
          <!-- /.list-unstyled --> 
        </div>
        <!-- /.cnt-cart -->
        <div class="clearfix"></div>
      </div>
      <!-- /.header-top-inner --> 
    </div>
    <!-- /.container --> 
  </div>
  <!-- /.header-top --> 
  <!-- ============================================== TOP MENU : END ============================================== -->
  <div class="main-header">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-3 logo-holder"> 

        @php
            $setting = App\Models\SiteSett::find(1);
            $cats = App\Models\Category::get();
        @endphp
          <!-- ============================================================= LOGO ============================================================= -->
          <div class="logo"> <a href="{{url('/')}}"> <img src="{{asset($setting->logo)}}" alt="logo"> </a> </div>
          <!-- /.logo --> 
          <!-- ============================================================= LOGO : END ============================================================= --> </div>
        <!-- /.logo-holder -->
        
        <div class="col-xs-12 col-sm-12 col-md-7 top-search-holder"> 
          <!-- /.contact-row --> 
          <!-- ============================================================= SEARCH AREA ============================================================= -->
          <div class="search-area">
            <form method="post" action="{{route('product.search')}}">
              @csrf
              <div class="control-group">
                <ul class="categories-filter animate-dropdown">
                  <li class="dropdown"> <a class="dropdown-toggle"  data-toggle="dropdown" href="category.html">Categories <b class="caret"></b></a>
                    <ul class="dropdown-menu" role="menu" >
                     @foreach($cats as $cat)
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">{{$cat->category_name_en}}</a></li>
                     @endforeach
                    </ul>
                  </li>
                </ul>
                <input class="search-field" onfocus="search_result_show()" onblur="search_result_hide()" id="search" placeholder="Search here..." />
                <button class="search-button" type="submit"></button> </div>
            </form>

            <div id="searchProducts"></div>
          </div>
          <!-- /.search-area --> 
          <!-- ============================================================= SEARCH AREA : END ============================================================= --> </div>
        <!-- /.top-search-holder -->
        
        <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row"> 
          <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->
          
          <div class="dropdown dropdown-cart"> <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
            <div class="items-cart-inner">
              <div class="basket"> <i class="glyphicon glyphicon-shopping-cart"></i> </div>
              <div class="basket-item-count"><span class="count" id="cartQty"></span></div>
              <div class="total-price-basket"> <span class="lbl">cart -</span> 
              <span class="total-price"> <span class="sign">$</span>
              <span class="value" id="cartSub"></span> </span> 
            </div>
            </div>
            </a>
            <ul class="dropdown-menu">
              <li>
               

                <div id="miniCart">
                  
                </div>


                <div class="clearfix cart-total">
                  <div class="pull-right"> <span class="text">Sub Total :</span><span class='price' id="cartSub"></span> </div>
                  <div class="clearfix"></div>
                  <a href="checkout.html" class="btn btn-upper btn-primary btn-block m-t-20">Checkout</a> </div>
                <!-- /.cart-total--> 
                
              </li>
            </ul>
            <!-- /.dropdown-menu--> 
          </div>
          <!-- /.dropdown-cart --> 
          
          <!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= --> </div>
        <!-- /.top-cart-row --> 
      </div>
      <!-- /.row --> 
      
    </div>
    <!-- /.container --> 
    
  </div>
  <!-- /.main-header --> 
  
  <!-- ============================================== NAVBAR ============================================== -->
  <div class="header-nav animate-dropdown">
    <div class="container">
      <div class="yamm navbar navbar-default" role="navigation">
        <div class="navbar-header">
       <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> 
       <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        </div>
        <div class="nav-bg-class">
          <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
            <div class="nav-outer">
              <ul class="nav navbar-nav">
                <li class="active dropdown yamm-fw"> <a href="{{url('/')}}" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">
                @if(session()->get('language') == 'bosnian') Pocetak @else  Home @endif
  
                </a> </li>

              @php
                $categories = App\Models\Category::orderBy('category_name_en','ASC')->get();
              @endphp
              @foreach($categories as $category)
                <li class="dropdown yamm mega-menu"> <a href="home.html" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">
                @if(session()->get('language') == 'bosnian') {{$category->category_name_hin}} @else  {{$category->category_name_en}} @endif

                </a>
                  <ul class="dropdown-menu container">
                    <li>
                      <div class="yamm-content ">
                        <div class="row">

                        @php
                $subcategories = App\Models\SubCategory::where('category_id',$category->id)->orderBy('subcategory_name_en','ASC')->get();
              @endphp

              @foreach($subcategories as $subcat)
                          <div class="col-xs-12 col-sm-6 col-md-2 col-menu">
                            <a href="{{url('subcategory/product/'.$subcat->id.'/'.$subcat->subcategory_slug_en)}}">
                          <h2 class="title">
                          @if(session()->get('language') == 'bosnian')  {{$subcat->subcategory_name_hin}} @else   {{$subcat->subcategory_name_en}} @endif

                         </h2>
                         </a>

                          @php
                $subsubcategories = App\Models\SubSubCategory::where('subcategory_id',$subcat->id)->orderBy('subsubcategory_name_en','ASC')->get();
              @endphp

              @foreach($subsubcategories as $ssubcat)
                            <ul class="links">
                              <li><a href="{{url('subsubcategory/product/'.$ssubcat->id.'/'.$ssubcat->subsubcategory_slug_en)}}">
                              @if(session()->get('language') == 'bosnian')   {{$ssubcat->subsubcategory_name_hin}} @else    {{$ssubcat->subsubcategory_name_en}} @endif

                             </a></li>
                              
                            </ul>
                            @endforeach
                          </div>
                          <!-- /.col -->
                          @endforeach
                          
                          
                          <!-- /.col -->
                          
                          <div class="col-xs-12 col-sm-6 col-md-4 col-menu banner-image"> <img class="img-responsive" src="{{asset('frontend/assets/images/banners/top-menu-banner.jpg')}}" alt=""> </div>
                          <!-- /.yamm-content --> 
                        </div>
                      </div>
                    </li>
                  </ul>
                </li>
                @endforeach

                <li> <a href="{{ route('shop.page') }}">Shop</a> </li>
                <li class="dropdown  navbar-right special-menu"> <a href="#">Todays offer</a> </li>

                <li class="dropdown  navbar-right special-menu"> <a href="{{ route('home.blog') }}">Blog</a> </li>
              </ul>
              <!-- /.navbar-nav -->
              <div class="clearfix"></div>
            </div>
            <!-- /.nav-outer --> 
          </div>
          <!-- /.navbar-collapse --> 
          
        </div>
        <!-- /.nav-bg-class --> 
      </div>
      <!-- /.navbar-default --> 
    </div>
    <!-- /.container-class --> 
    
  </div>
  <!-- /.header-nav --> 
  <!-- ============================================== NAVBAR : END ============================================== --> 
  


  <div class="modal fade" id="ordertracking" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tracking Order</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <form action="{{route('order.tracking')}}" method="post">
@csrf
<div class="modal-body">
  <label for="">Invoice Code</label>
  <input type="text" name="code" required class="form-control" placeholder="Your order invoice no">
</div>

<button class="btn btn-danger" type="submit" style="margin-left: 17px;">Track Now</button>

      </form>


      </div>
      
    </div>
  </div>
</div>

</header>

<style>
  
.search-area{
  position: relative;
}
  #searchProducts {
    position: absolute;
    top: 100%;
    left: 0;
    width: 100%;
    background: #ffffff;
    z-index: 999;
    border-radius: 8px;
    margin-top: 5px;
  }
</style>

<script>
  function search_result_hide(){
    $("#searchProducts").slideUp();
  }
   function search_result_show(){
      $("#searchProducts").slideDown();
  }

</script> 