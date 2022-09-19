<?php

use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\RouteController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Rules\Role;

//dashboard
Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');


//login , register
Route::middleware(['isAuth'])->group(function () {
    Route::redirect('/', 'loginPage', 302);
    Route::get('loginPage', [AuthController::class, 'loginPage'])->name('auth#loginPage');
    Route::get('registerPage', [AuthController::class, 'registerPage'])->name('auth#registerPage');
});


Route::middleware('auth')->group(function () {
    Route::middleware(['isAdmin'])->group(function () {
        Route::group(['prefix' => 'category'], function () {
            Route::get('list', [CategoryController::class, 'list'])->name('category#list');
            Route::get('createPage', [CategoryController::class, 'createPage'])->name('category#createPage');
            Route::post('create', [CategoryController::class, 'create'])->name('category#create');
            Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('category#delete');
            Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('category#edit');
            Route::put('update/{id}', [CategoryController::class, 'update'])->name('category#update');
        });

        Route::prefix('admin')->group(function () {
            Route::get('changepassword', [AdminController::class, 'change_pass'])->name('user#change_pass');
            Route::post('changepassword', [AdminController::class, 'password_change'])->name('user#change_pass');
            Route::get('profile', [AdminController::class, 'profile_page'])->name('user#profile');
            Route::get('profile/edit', [AdminController::class, 'edit_profile'])->name('user#profile_edit');
            Route::post('profile/update/{id}',[AdminController::class,'update_profile'])->name('user#profile_update');
            Route::get('admin_list',[AdminController::class,'admin_list'])->name('admin#list');
            Route::get('delete_user/{id}',[AdminController::class,'destroy_user'])->name('admin#destroy');
        });

        // Procucts Routes
        Route::prefix('products')->group(function(){
            Route::get('',[ProductController::class,'index'])->name('products');
            Route::get('createPage',[ProductController::class,'createPage'])->name('products_createPage');
            Route::post('insert',[ProductController::class,'insert'])->name('product_insert');
            Route::get('delete/{id}',[ProductController::class,'destroy'])->name('product_delete');
            Route::get('more/{id}',[ProductController::class,'view_more'])->name('product_view_more');
            Route::get('editPage/{id}',[ProductController::class,'editPage'])->name('product_edit_page');
            Route::post('update/{id}',[ProductController::class,'update'])->name('product#update');
        });

        Route::prefix('orders')->group(function(){
            Route::get('',[OrderController::class,'index'])->name('admin#order_list');
            Route::get('change_status',[OrderController::class,'change_status'])->name('admin#order_chage');
            Route::get('order/{id}',[OrderController::class,'order_info'])->name('admin#order_info');
        });

        Route::prefix('users')->group(function(){
            Route::get('',[AdminUserController::class,'index'])->name('admin#user_list');
            Route::get('change/user/{id}',[AdminUserController::class,'change_user'])->name('admin#user_change');
            Route::get('delete/user',[AdminUserController::class,'delete_user'])->name('admin#user_delete');
            Route::get('change/role',[AdminUserController::class,'change_role'])->name('admin#chage_role');
            Route::get('edit/{id}',[AdminUserController::class,'edit'])->name('admin#user_edit');
        });
        Route::prefix('contacts')->group(function(){
            Route::get('',[ContactController::class,'index'])->name('admin#contact_list');
            Route::get('info/{id}',[ContactController::class,'more_info'])->name('admin#contact_more_info');
            Route::get('delete',[ContactController::class,'destroy'])->name('admin#contact_destroy');
        });
    });







    Route::group(['middleware' => 'isUser', 'prefix' => 'user'], function () {
        Route::get('home',[UserController::class,'home'])->name('user#home');
        Route::prefix('password')->group(function(){
            Route::get('change',[UserController::class,'changePasswordPage'])->name('user#changePassword');
            Route::post('change',[UserController::class,'changePassword'])->name('user#changePassword');
        });
        Route::get('profile',[UserController::class,'profile'])->name('profile');
        Route::post('profile',[UserController::class,'profileUpdate'])->name('profile');
        Route::get('sorting/pizza/list',[HomeController::class,'sorting'])->name('user#pizza_sorting');
        Route::get('pizza/list/filterBy/{id}',[HomeController::class,'filter'])->name('user#pizza_filter');
        Route::get('pizza/detail/{id}',[HomeController::class,'detail'])->name('user#pizza_detail');
        Route::get('cart/list',[RouteController::class,'cart_list'])->name('user#cart_list');
        Route::post('add/cart',[AjaxController::class,'add_to_cart'])->name('user#cart_add');
        Route::get('cartCount',[AjaxController::class,'cart_count'])->name('user#cart_count');
        Route::post('add/order',[AjaxController::class,'add_order'])->name('user#add_order');
        Route::get('order/history',[RouteController::class,'order_history'])->name('user#order_history');
        Route::get('cart/remove',[AjaxController::class,'remove_one_cart'])->name('user#remvoe_one_cart');
        Route::get('remove/carts',[UserController::class,'remove_all_carts'])->name('user#remove_all_cart');
        Route::get('contact',[RouteController::class,'contact_page'])->name('user#contact');
        Route::post('contact',[RouteController::class,'contact_add'])->name('user#contact');
        
    });
});
