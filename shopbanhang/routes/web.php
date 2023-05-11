<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController; 
use App\Http\Controllers\CartController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;

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

//fontend
Route::get('/','App\Http\Controllers\HomeController@index');
Route::get('/trang-chu','App\Http\Controllers\HomeController@index');
Route::post('/tim-kiem','App\Http\Controllers\HomeController@search');


Route::get('/sap-xep-desc','App\Http\Controllers\HomeController@sap_xep_desc');
Route::get('/sap-xep-asc','App\Http\Controllers\HomeController@sap_xep_asc');


//home
Route::get('/danh-muc-san-pham/{category_id}','App\Http\Controllers\CategoryProduct@show_category_home');

Route::get('/thuong-hieu-san-pham/{brand_id}','App\Http\Controllers\BrandProduct@show_brand_home');

Route::get('/chi-tiet-san-pham/{product_id}','App\Http\Controllers\ProductController@details_product');

//backend
Route::get('/admin','App\Http\Controllers\AdminController@index');
Route::get('/dashboard','App\Http\Controllers\AdminController@show_dashboard');
Route::get('/logout','App\Http\Controllers\AdminController@log_out');
Route::post('/admin-dashboard','App\Http\Controllers\AdminController@dashboard');

//category-product
Route::get('/add-category-product','App\Http\Controllers\CategoryProduct@add_category_product');
Route::get('/all-category-product','App\Http\Controllers\CategoryProduct@all_category_product');
Route::get('/edit-category-product/{catagory_product_id}','App\Http\Controllers\CategoryProduct@edit_category_product');
Route::get('/delete-category-product/{catagory_product_id}','App\Http\Controllers\CategoryProduct@delete_category_product');

Route::post('/save-category-product','App\Http\Controllers\CategoryProduct@save_category_product');
Route::post('/update-category-product/{catagory_product_id}','App\Http\Controllers\CategoryProduct@update_category_product');

Route::get('/unactive-category-product/{catagory_product_id}','App\Http\Controllers\CategoryProduct@unactive_category_product');
Route::get('/active-category-product/{catagory_product_id}','App\Http\Controllers\CategoryProduct@active_category_product');

//brand-product
Route::get('/add-brand-product','App\Http\Controllers\BrandProduct@add_brand_product');
Route::get('/all-brand-product','App\Http\Controllers\BrandProduct@all_brand_product');
Route::get('/edit-brand-product/{brand_product_id}','App\Http\Controllers\BrandProduct@edit_brand_product');
Route::get('/delete-brand-product/{brand_product_id}','App\Http\Controllers\BrandProduct@delete_brand_product');

Route::post('/save-brand-product','App\Http\Controllers\BrandProduct@save_brand_product');
Route::post('/update-brand-product/{brand_product_id}','App\Http\Controllers\BrandProduct@update_brand_product');

Route::get('/unactive-brand-product/{brand_product_id}','App\Http\Controllers\BrandProduct@unactive_brand_product');
Route::get('/active-brand-product/{brand_product_id}','App\Http\Controllers\BrandProduct@active_brand_product');

//product
Route::get('/add-product','App\Http\Controllers\ProductController@add_product');
Route::get('/all-product','App\Http\Controllers\ProductController@all_product');
Route::get('/edit-product/{product_id}','App\Http\Controllers\ProductController@edit_product');
Route::get('/delete-product/{product_id}','App\Http\Controllers\ProductController@delete_product');
Route::post('/save-product','App\Http\Controllers\ProductController@save_product');
Route::post('/update-product/{product_id}','App\Http\Controllers\ProductController@update_product');


Route::get('/unactive-product/{product_id}','App\Http\Controllers\ProductController@unactive_product');
Route::get('/active-product/{product_id}','App\Http\Controllers\ProductController@active_product');

//cart
Route::post('/save-cart','App\Http\Controllers\CartController@save_cart');
Route::post('/update-cart-quantity', 'App\Http\Controllers\CartController@update_cart_quantity');
Route::get('/show_cart','App\Http\Controllers\CartController@show_cart');
Route::get('/delete-to-cart/{rowId}','App\Http\Controllers\CartController@delete_to_cart');

//cart-ajax
Route::post('/add-cart-ajax', [CartController::class, 'add_cart_ajax'])->name('cart.add');
Route::get('/gio-hang','App\Http\Controllers\CartController@gio_hang');
Route::post('/update-cart', 'App\Http\Controllers\CartController@update_cart');
Route::get('/del-product/{session_id}','App\Http\Controllers\CartController@del_product');
Route::get('/del-all-product','App\Http\Controllers\CartController@del_all_product');

//coupon
Route::post('/check-coupon', 'App\Http\Controllers\CartController@check_coupon');
Route::get('/insert-coupon', 'App\Http\Controllers\CouponController@insert_coupon');
Route::get('/list-coupon', 'App\Http\Controllers\CouponController@list_coupon');
Route::get('/delete-coupon/{coupon_id}', 'App\Http\Controllers\CouponController@delete_coupon');
Route::get('/unset-coupon', 'App\Http\Controllers\CouponController@unset_coupon');
Route::post('/insert-coupon-code', 'App\Http\Controllers\CouponController@insert_coupon_code');


//check-out
Route::get('/login-checkout','App\Http\Controllers\CheckoutController@login_checkout');
Route::post('/add-customer','App\Http\Controllers\CheckoutController@add_customer');
Route::get('/del-fee','App\Http\Controllers\CheckoutController@del_fee');
Route::get('/checkout','App\Http\Controllers\CheckoutController@checkout');
Route::get('/logout-checkout','App\Http\Controllers\CheckoutController@logout_checkout');
Route::get('/payment','App\Http\Controllers\CheckoutController@payment');
Route::post('/select-delivery-home', [CheckoutController::class, 'select_delivery_home'])->name('select.deliveryhome');
Route::post('/calculate-fee', [CheckoutController::class, 'calculate_fee'])->name('calculate.fee');
Route::post('/confirm-order', [CheckoutController::class, 'confirm_order'])->name('confirm.order');

Route::post('/save-checkout-customer','App\Http\Controllers\CheckoutController@save_checkout_customer');
Route::post('/login-customer','App\Http\Controllers\CheckoutController@login_customer');
Route::post('/order-place','App\Http\Controllers\CheckoutController@order_place');

//order-admin
Route::get('/manage-order','App\Http\Controllers\OrderController@manage_order');
Route::get('/view-order/{order_code}','App\Http\Controllers\OrderController@view_order');
Route::get('/delete-order/{order_id}','App\Http\Controllers\OrderController@delete_order');

Route::post('/update-order-qty', [OrderController::class, 'update_order_qty'])->name('order.qty');
Route::post('/update-qty', [OrderController::class, 'update_qty'])->name('update.qty');
// Route::get('/manage-order','App\Http\Controllers\CheckoutController@manage_order');
// Route::get('/view-order/{order_id}','App\Http\Controllers\CheckoutController@view_order');

//delivery
Route::get('/delivery','App\Http\Controllers\DeliveryController@delivery');
Route::post('/select-delivery', [DeliveryController::class, 'select_delivery'])->name('select.delivery');

Route::post('/insert-delivery', [DeliveryController::class, 'insert_delivery'])->name('insert.delivery');

Route::post('/select-feeship', [DeliveryController::class, 'select_feeship'])->name('select.feeship');
Route::post('/update-delivery', [DeliveryController::class, 'update_delivery'])->name('update.delivery');


