<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TravelPostPlanController;
use App\Http\Controllers\VerticalController;
use App\Http\Controllers\SubCategoryController;


Route::get('/', function () {
    return view('welcome');
});

Route::controller(AuthController::class)->prefix('admin')->group(function () {
    Route::get('login', 'loginView')->name('login');
    Route::post('login', 'loginCrediential')->name('login.crediential');
    Route::get('forgot-password', 'forgotPassword')->name('admin.forgotpassword');
    Route::post('reset-forgot-password', 'resetForgotPassword')->name('admin.reset.forgotpassword');
    Route::get('change-password', 'changePassword')->name('admin.change.password');
    Route::post('store-password', 'storePassword')->name('admin.store.password');
});


// Route::middleware('auth')->group(function () {
Route::controller(DashboardController::class)->prefix('admin')->middleware('auth')->group(function () {
    Route::get('dashboard', 'Dashboard')->name('dashboard');
    Route::get('logout', 'logout')->name('logout');
    Route::get('profile', 'profile')->name('profile');
});

Route::controller(UserController::class)->prefix('admin')->group(function () {
    Route::get('user-list', 'userList')->name('user.list');
    Route::get('user-create', 'userCreate')->name('user.create');
    Route::post('user-store', 'userStore')->name('user.store');
    Route::get('user-edit/{id}', 'userEdit')->name('user.edit');
    Route::post('user-update/{id}', 'userUpdate')->name('user.update');
    Route::get('user-delete/{id}', 'userDelete')->name('user.delete');
    Route::get('user-profile-update/{id?}', 'userProfileUpdateView')->name('user.profile.update.view');
    Route::post('user-profile-update/{id?}', 'userProfileUpdate')->name('user.profile.update');
});

Route::controller(CategoryController::class)->prefix('admin')->group(function () {
    Route::get('category-list', 'categoryList')->name('category.list');
    Route::get('category-create', 'categoryCreate')->name('category.create');
    Route::post('category-store', 'categoryStore')->name('category.store');
    Route::get('category-edit/{id}', 'categoryEdit')->name('category.edit');
    Route::post('category-update/{id}', 'categoryUpdate')->name('category.update');
    Route::get('category-delete/{id}', 'categoryDelete')->name('category.delete');
});
Route::controller(VerticalController::class)->prefix('admin')->group(function () {
    Route::get('vertical-list', 'verticalList')->name('vertical.list');
    Route::get('vertical-create', 'verticalCreate')->name('vertical.create');
    Route::post('vertical-store', 'verticalStore')->name('vertical.store');
    Route::get('vertical-edit/{id}', 'verticalEdit')->name('vertical.edit');
    Route::post('vertical-update/{id}', 'verticalUpdate')->name('vertical.update');
    Route::get('vertical-delete/{id}', 'verticalDelete')->name('vertical.delete');
});

Route::controller(SubCategoryController::class)->prefix('admin')->group(function () {
    Route::get('sub-category-list', 'subCategoryList')->name('sub.category.list');
    Route::get('sub-category-create', 'subCategoryCreate')->name('sub.category.create');
    Route::post('sub-category-store', 'subCategoryStore')->name('sub.category.store');
    Route::get('sub-category-edit/{id}', 'subCategoryEdit')->name('sub.category.edit');
    Route::post('sub-category-update/{id}', 'subCategoryUpdate')->name('sub.category.update');
    Route::get('sub-category-delete/{id}', 'subCategoryDelete')->name('sub.category.delete');
});
Route::controller(TravelPostPlanController::class)->prefix('admin')->group(function () {
    //---------------------------Hangout routes------------------------
    Route::get('view-hangout', 'viewHangout')->name('view.hangout');
    Route::post('add-hangout', 'addHangout')->name('add.hangout');
    Route::post('edit-hangout', 'editHangout')->name('edit.hangout');
    Route::get('delete-hangout/{id}', 'deleteHangout')->name('delete.hangout');

    //----------------------------Post routes--------------------------
    Route::get('view-post', 'viewPost')->name('view.post');
    Route::post('add-post', 'addPost')->name('add.post');
    Route::post('edit-post', 'editPost')->name('edit.post');
    Route::get('delete-post/{id}', 'deletePost')->name('delete.post');

});


