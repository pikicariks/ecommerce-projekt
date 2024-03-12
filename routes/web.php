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


});

Route::get('/cart', [CartPageController::class, 'MyCart'])->name('cart');

Route::get('/get-mycart', [CartPageController::class, 'GetCartProducts']);

Route::get('/cart-remove/{id}', [CartPageController::class, 'RemoveCartProduct']);

Route::get('/cart-increment/{id}', [CartPageController::class, 'Increment']);

Route::get('/cart-decrement/{id}', [CartPageController::class, 'Decrement']);
