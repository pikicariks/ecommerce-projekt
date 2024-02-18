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
/*
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
    Route::post('/sub/sub/store',[SubCategoryController::class,'SubSubStore'])->name('subsubcategory.store');
    Route::get('/sub/sub/edit/{id}',[SubCategoryController::class,'SubSubEdit'])->name('subsubcategory.edit');
    Route::post('/sub/sub/update',[SubCategoryController::class,'SubSubUpdate'])->name('subsubcategory.update');
    Route::get('/sub/sub/delete/{id}',[SubCategoryController::class,'SubSubDelete'])->name('subsubcategory.delete');

});