<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
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
use App\Http\Controllers\Backend\ShippingAreaController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\StripeController;

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

