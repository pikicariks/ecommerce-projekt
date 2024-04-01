<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\AdminUserController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Frontend\IndexController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Frontend\LanguageController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\User\CartPageController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\ShippingAreaController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\StripeController;
use App\Http\Controllers\User\AllUserController;
use App\Http\Controllers\User\CashController;
use App\Http\Controllers\Frontend\HomeBlogController;
use App\Http\Controllers\Backend\SiteSetting as SiteSettingController;
use App\Http\Controllers\Backend\ReturnController;
use App\Http\Controllers\User\ReviewController;
use App\Http\Controllers\Frontend\ShopController;
/*u
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['prefix'=> 'admin', 'middleware'=>['admin:admin']], function(){
	Route::get('/login', [AdminController::class, 'loginForm']);
	Route::post('/login',[AdminController::class, 'store'])->name('admin.login');
});


Route::middleware(['auth:admin'])->group(function(){



Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
    return view('admin.index');
})->name('dashboard');

//admin related routes

Route::get('/admin/logout',[AdminController::class,'destroy'])->name('admin.logout');

Route::get('/admin/profile',[AdminProfileController::class,'AdminProfile'])->name('admin.profile');



Route::get('/admin/profile/edit',[AdminProfileController::class,'AdminProfileEdit'])->name('admin.profile.edit');

Route::get('/admin/change/password',[AdminProfileController::class,'AdminChangePass'])->name('admin.change.password');


Route::post('/admin/profile/store',[AdminProfileController::class,'AdminProfileStore'])->name('admin.profile.store');

Route::post('/update/change/password',[AdminProfileController::class,'UpdatePass'])->name('update.change.password');
});
// user related routes


Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    $id = Auth::user()->id;
        $data = User::find($id);
    return view('dashboard',compact('data'));
})->name('dashboard');

Route::get('/',[IndexController::class,'index']);

Route::get('/user/logout',[IndexController::class,'UserLogout'])->name('user.logout');

Route::get('/user/profile',[IndexController::class,'UserProfile'])->name('user.profile');

Route::post('/user/profile/store',[IndexController::class,'UserStore'])->name('user.profile.store');

Route::get('/user/change/password',[IndexController::class,'UserChangePassword'])->name('change.password');

Route::post('/user/password/update',[IndexController::class,'PasswordUpdate'])->name('user.password.update');

//admin brand all routes

Route::prefix('brand')->group(function(){
    Route::get('/view',[BrandController::class,'BrandView'])->name('all.brand');
    Route::post('/store',[BrandController::class,'BrandStore'])->name('brand.store');
    Route::get('/edit/{id}',[BrandController::class,'BrandEdit'])->name('brand.edit');
    Route::post('/update',[BrandController::class,'BrandUpdate'])->name('brand.update');
    Route::get('/delete/{id}',[BrandController::class,'BrandDelete'])->name('brand.delete');

});
//admin category all routes
Route::prefix('category')->group(function(){
    Route::get('/view',[CategoryController::class,'CategoryView'])->name('all.category');
    Route::post('/store',[CategoryController::class,'CategoryStore'])->name('category.store');
    Route::get('/edit/{id}',[CategoryController::class,'CategoryEdit'])->name('category.edit');
    Route::post('/update',[CategoryController::class,'CategoryUpdate'])->name('category.update');
    Route::get('/delete/{id}',[CategoryController::class,'CategoryDelete'])->name('category.delete');
    // admin subcategory all routes

    Route::get('/sub/view',[SubCategoryController::class,'SubCategoryView'])->name('all.subcategory');
    Route::post('/sub/store',[SubCategoryController::class,'SubStore'])->name('subcategory.store');
    Route::get('/sub/edit/{id}',[SubCategoryController::class,'SubEdit'])->name('subcategory.edit');
    Route::post('/sub/update',[SubCategoryController::class,'SubUpdate'])->name('subcategory.update');
    Route::get('/sub/delete/{id}',[SubCategoryController::class,'SubDelete'])->name('subcategory.delete');

    //admin subsubcategory all routes
    Route::get('/sub/sub/view',[SubCategoryController::class,'SubSubCategoryView'])->name('all.subsubcategory');

    Route::get('/subcategory/ajax/{category_id}',[SubCategoryController::class,'GetSubCategory']);
    Route::get('/sub-subcategory/ajax/{subcategory_id}',[SubCategoryController::class,'GetSubSub']);

    Route::post('/sub/sub/store',[SubCategoryController::class,'SubSubStore'])->name('subsubcategory.store');
    Route::get('/sub/sub/edit/{id}',[SubCategoryController::class,'SubSubEdit'])->name('subsubcategory.edit');
    Route::post('/sub/sub/update',[SubCategoryController::class,'SubSubUpdate'])->name('subsubcategory.update');
    Route::get('/sub/sub/delete/{id}',[SubCategoryController::class,'SubSubDelete'])->name('subsubcategory.delete');

});
//admin product all routes
Route::prefix('product')->group(function(){
    Route::get('/add',[ProductController::class,'AddProduct'])->name('add-product');
    Route::post('/store',[ProductController::class,'StoreProduct'])->name('product-store');
    Route::get('/manage',[ProductController::class,'ManageProduct'])->name('manage-product');

    Route::get('/edit/{id}',[ProductController::class,'ProductEdit'])->name('product.edit');
    Route::post('/data/update',[ProductController::class,'DataUpdate'])->name('product-update');
    Route::post('/image/update', [ProductController::class, 'MultiImageUpdate'])->name('update-product-image');
    Route::post('/thambnail/update', [ProductController::class, 'ThambnailImageUpdate'])->name('update-product-thambnail');

    Route::get('/multiimg/delete/{id}', [ProductController::class, 'MultiImageDelete'])->name('product.multiimg.delete');

    Route::get('/inactive/{id}', [ProductController::class, 'ProductInactive'])->name('product.inactive');

    Route::get('/active/{id}', [ProductController::class, 'ProductActive'])->name('product.active');

    Route::get('/delete/{id}', [ProductController::class, 'ProductDelete'])->name('product.delete');

});

// admin slider all routes 
Route::prefix('slider')->group(function(){
    Route::get('/view',[SliderController::class,'SliderView'])->name('manage-slider');
    Route::post('/store',[SliderController::class,'SliderStore'])->name('slider.store');
    Route::get('/edit/{id}',[SliderController::class,'SliderEdit'])->name('slider.edit');
    Route::post('/update',[SliderController::class,'SliderUpdate'])->name('slider.update');
    Route::get('/delete/{id}',[SliderController::class,'SliderDelete'])->name('slider.delete');
    Route::get('/inactive/{id}', [SliderController::class, 'SliderInactive'])->name('slider.inactive');

    Route::get('/active/{id}', [SliderController::class, 'SliderActive'])->name('slider.active');

});

//frontend all routes
//multi-lang routes
Route::get('/language/bosnian', [LanguageController::class, 'Bosnian'])->name('bosnian.language');

Route::get('/language/english', [LanguageController::class, 'English'])->name('english.language');
//product details page url

Route::get('/product/details/{id}/{slug}', [IndexController::class, 'ProductDetails']);

//product tag url
Route::get('/product/tag/{tag}', [IndexController::class, 'TagWiseProduct']);

//subcategory wise data
Route::get('/subcategory/product/{subcat_id}/{slug}', [IndexController::class, 'SubCatData']);

Route::get('/subsubcategory/product/{ssubcat_id}/{slug}', [IndexController::class, 'SubSubCatData']);


Route::get('/product/view/modal/{id}', [IndexController::class, 'ProductViewAjax']);

Route::post('/cart/data/store/{id}', [CartController::class, 'CartStoreProduct']);

Route::get('/product/mini/cart', [CartController::class, 'MiniCartAdd']);

Route::get('/minicart/product-remove/{id}', [CartController::class, 'MiniCartRemove']);


////////

Route::post('/add-to-wishlist/{id}', [CartController::class, 'AddToWish']);


Route::group(['prefix'=>'user','middleware' => ['user','auth'],'namespace'=>'User'],function(){

Route::get('/wishlist', [WishlistController::class, 'WishlistView'])->name('wishlist');


Route::get('/get-wishlist-product', [WishlistController::class, 'GetProdWish']);

Route::get('/wishlist-remove/{id}', [WishlistController::class, 'WishRemoveProd']);

Route::post('/stripe/order',[StripeController::class,'StripeOrder'])->name('stripe.order');

Route::post('/cash/order',[CashController::class,'CashOrder'])->name('cash.order');

Route::get('/my/orders', [AllUserController::class, 'GetOrders'])->name('my.orders');

Route::get('/order_details/{id}', [AllUserController::class, 'OrderDetails']);

Route::get('/invoice_download/{id}', [AllUserController::class, 'InvoiceDownload']);
////////////////////////////////////

Route::post('/order/tracking', [AllUserController::class, 'OrderTracking'])->name('order.tracking');

});

Route::get('/cart', [CartPageController::class, 'MyCart'])->name('cart');

Route::get('/get-mycart', [CartPageController::class, 'GetCartProducts']);

Route::get('/cart-remove/{id}', [CartPageController::class, 'RemoveCartProduct']);

Route::get('/cart-increment/{id}', [CartPageController::class, 'Increment']);

Route::get('/cart-decrement/{id}', [CartPageController::class, 'Decrement']);


// admin coupons routes

Route::prefix('coupons')->group(function(){
    Route::get('/view',[CouponController::class,'CouponView'])->name('manage-coupon');
    Route::post('/store',[CouponController::class,'CouponStore'])->name('coupon.store');
    Route::get('/edit/{id}',[CouponController::class,'CouponEdit'])->name('coupon.edit');
    Route::post('/update/{id}',[CouponController::class,'CouponUpdate'])->name('coupon.update');
    Route::get('/delete/{id}',[CouponController::class,'CouponDelete'])->name('coupon.delete');

});

// admin shipping routes

Route::prefix('shipping')->group(function(){
    Route::get('/division/view',[ShippingAreaController::class,'DivisionView'])->name('manage-division');
    Route::post('/division/store',[ShippingAreaController::class,'DivisionStore'])->name('division.store');
    Route::get('/division/edit/{id}',[ShippingAreaController::class,'DivisionEdit'])->name('division.edit');
    Route::post('/division/update/{id}',[ShippingAreaController::class,'DivisionUpdate'])->name('division.update');
    Route::get('/division/delete/{id}',[ShippingAreaController::class,'DivisionDelete'])->name('division.delete');


    // district routes

    Route::get('/district/view',[ShippingAreaController::class,'DistrictView'])->name('manage-district');
    Route::post('/district/store',[ShippingAreaController::class,'DistrictStore'])->name('district.store');
    Route::get('/district/edit/{id}',[ShippingAreaController::class,'DistrictEdit'])->name('district.edit');
    Route::post('/district/update/{id}',[ShippingAreaController::class,'DistrictUpdate'])->name('district.update');
    Route::get('/district/delete/{id}',[ShippingAreaController::class,'DistrictDelete'])->name('district.delete');

    // state routes

    Route::get('/state/view',[ShippingAreaController::class,'StateView'])->name('manage-state');
    Route::post('/state/store',[ShippingAreaController::class,'StateStore'])->name('state.store');
    Route::get('/state/edit/{id}',[ShippingAreaController::class,'StateEdit'])->name('state.edit');
    Route::post('/state/update/{id}',[ShippingAreaController::class,'StateUpdate'])->name('state.update');
    Route::get('/state/delete/{id}',[ShippingAreaController::class,'StateDelete'])->name('state.delete');



});

Route::post('/coupon-apply',[CartController::class,'CouponApply']);

Route::get('/coupon-calculation',[CartController::class,'CouponCalculate']);

Route::get('/coupon-removal',[CartController::class,'RemoveCoupon']);


//////////////

Route::get('/checkout',[CartController::class,'Checkout'])->name('checkout');

Route::get('/district-get/ajax/{division_id}',[CheckoutController::class,'GetDistrict']);

Route::get('/state-get/ajax/{district_id}',[CheckoutController::class,'GetState']);


Route::post('/checkout/store',[CheckoutController::class,'CheckoutStore'])->name('checkout.store');

////// admin order routes
Route::prefix('orders')->group(function(){
    Route::get('/pending/orders',[OrderController::class,'PendingOrders'])->name('pending-orders');
    Route::get('/pending/orders/details/{order_id}', [OrderController::class, 'PendingOrdersDetails'])->name('pending.order.details');
    Route::get('/confirmed/orders',[OrderController::class,'ConfirmedOrders'])->name('confirmed-orders');
    Route::get('/processing/orders', [OrderController::class, 'ProcessingOrders'])->name('processing-orders');

    Route::get('/picked/orders', [OrderController::class, 'PickedOrders'])->name('picked-orders');
    
    Route::get('/shipped/orders', [OrderController::class, 'ShippedOrders'])->name('shipped-orders');
    
    Route::get('/delivered/orders', [OrderController::class, 'DeliveredOrders'])->name('delivered-orders');
    
    Route::get('/cancel', [OrderController::class, 'CancelOrders'])->name('cancel-orders');

    Route::get('/pending/confirm/{id}', [OrderController::class, 'PendingToConfirm'])->name('pending-confirm');

    Route::get('/confirm/processing/{order_id}', [OrderController::class, 'ConfirmToProcessing'])->name('confirm.processing');

Route::get('/processing/picked/{order_id}', [OrderController::class, 'ProcessingToPicked'])->name('processing.picked');

Route::get('/picked/shipped/{order_id}', [OrderController::class, 'PickedToShipped'])->name('picked.shipped');

Route::get('/shipped/delivered/{order_id}', [OrderController::class, 'ShippedToDelivered'])->name('shipped.delivered');

Route::get('/invoice/download/{order_id}', [OrderController::class, 'AdminInvoiceDownload'])->name('invoice.download');

Route::post('/return/order/{order_id}', [AllUserController::class, 'ReturnOrder'])->name('return.order');

Route::get('/return/order/list', [AllUserController::class, 'ReturnOrderList'])->name('return.order.list');


Route::get('/cancel/orders', [AllUserController::class, 'CancelOrders'])->name('cancel.orders');
});



Route::prefix('reports')->group(function(){
    Route::get('/view',[ReportController::class,'AllReports'])->name('all-reports');
 
    Route::post('/search/by-date',[ReportController::class,'ReportByDate'])->name('search-by-date');

    Route::post('/search/by-month',[ReportController::class,'ReportByMonth'])->name('search-by-month');

    Route::post('/search/by-year',[ReportController::class,'ReportByYear'])->name('search-by-year');




});

Route::prefix('alluser')->group(function(){
    Route::get('/view',[AdminProfileController::class,'AllUsers'])->name('all-users');
  
});

////////////////////////////////
Route::prefix('blog')->group(function(){
    Route::get('/category',[BlogController::class,'BlogCategory'])->name('blog.category');
 
    Route::post('/store',[BlogController::class,'BlogCategoryStore'])->name('blogcategory.store');

    Route::get('/category/edit/{id}',[BlogController::class,'BlogCategoryEdit'])->name('blogcategory.edit');

    Route::post('/category/update/{id}',[BlogController::class,'BlogCategoryUpdate'])->name('blogcategory.update');

    Route::get('/category/delete/{id}',[BlogController::class,'BlogCategoryDelete'])->name('blogcategory.delete');


    Route::post('/post/store',[BlogController::class,'PostStore'])->name('post-store');

    Route::get('/list/post', [BlogController::class, 'ListBlogPost'])->name('list.post');

Route::get('/add/post', [BlogController::class, 'AddBlogPost'])->name('add.post');

Route::get('/post/delete/{id}',[BlogController::class,'PostDelete'])->name('post.delete');

});
//////////////////////////////
Route::get('/blog', [HomeBlogController::class, 'AddBlogPost'])->name('home.blog');

Route::get('/post/details/{id}', [HomeBlogController::class, 'DetailsBlogPost'])->name('post.details');

Route::get('/blog/category/post/{category_id}', [HomeBlogController::class, 'HomeBlogCatPost']);

/////////////////////////////////////////
Route::prefix('setting')->group(function(){
    Route::get('/site',[SiteSettingController::class,'SetSite'])->name('site.setting');
 
    Route::post('/site/update/{id}',[SiteSettingController::class,'UpdateSiteSetting'])->name('update.sitesetting');

    Route::get('/seo',[SiteSettingController::class,'SeoSetting'])->name('seo.setting');

    Route::post('/seo/update/{id}',[SiteSettingController::class,'UpdateSEO'])->name('update.seo');

});

////////////////////
Route::prefix('return')->group(function(){

    Route::get('/admin/request', [ReturnController::class, 'ReturnRequest'])->name('return.request');
    
    Route::get('/admin/return/approve/{order_id}', [ReturnController::class, 'ReturnRequestApprove'])->name('return.approve');

    Route::get('/admin/all/request', [ReturnController::class, 'ReturnAllRequest'])->name('all.request');
    });





///////////////

Route::post('/review/store', [ReviewController::class, 'ReviewStore'])->name('review.store');

//////////////////////

Route::prefix('review')->group(function(){

    Route::get('/pending', [ReviewController::class, 'PendingReview'])->name('pending.review');
    
    Route::get('/admin/approve/{id}', [ReviewController::class, 'ReviewApprove'])->name('review.approve');


    Route::get('/published', [ReviewController::class, 'PublishReviews'])->name('publish.review');


    Route::get('/delete/{id}', [ReviewController::class, 'DeleteReview'])->name('delete.review');
    });


Route::prefix('stock')->group(function(){

    Route::get('/product', [ProductController::class, 'ProdStock'])->name('product.stock');
    
});


Route::prefix('adminuserrole')->group(function(){

    Route::get('/all', [AdminUserController::class, 'AllAdminRole'])->name('all.admin.user');
    
    Route::get('/add', [AdminUserController::class, 'AddAdminRole'])->name('add.admin');

    Route::post('/store', [AdminUserController::class, 'StoreAdminRole'])->name('admin.user.store');

    Route::get('/edit/{id}', [AdminUserController::class, 'EditAdminRole'])->name('edit.admin.user');


    Route::post('/update', [AdminUserController::class, 'UpdateAdminRole'])->name('admin.user.update');

    Route::get('/delete/{id}', [AdminUserController::class, 'DeleteAdminRole'])->name('delete.admin.user');

});

Route::post('/search', [IndexController::class, 'ProductSearch'])->name('product.search');
///////////

Route::post('search-product', [IndexController::class, 'SearchProduct']);



///

Route::get('/shop', [ShopController::class, 'ShopPage'])->name('shop.page');

Route::post('/shop/filter', [ShopController::class, 'ShopFilter'])->name('shop.filter');


