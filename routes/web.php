<?php

use Illuminate\Support\Facades\Route;

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

//  Route::get('/', function () {
//      return view('welcome');
// });

Route::get('/','frontendController@index');
Route::get('about','frontendController@about');
Route::get('contact','frontendController@contact');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::get('category','addCategory@category');
Route::get('update/{category_id}','addCategory@update');
Route::post('categoryPost','addCategory@categoryPost');
Route::post('updateCategoryPost','addCategory@updateCategoryPost');
Route::get('delete/{category_id}','addCategory@delete');
Route::get('restore/{category_id}','addCategory@restore');
Route::get('harddelete/{category_id}','addCategory@harddelete');
Route::get('editprofile','profile@editprofile');
Route::post('editprofilePost','profile@editprofilePost');
Route::post('editprofilepasswordPost','profile@editprofilepasswordPost');

//message controller
Route::post('messagepost','messageController@messagepost');
Route::get('message','messageController@message');
Route::get('deleteMessage/{mess_id}','messageController@deleteMessage');



Route::get('product','ProductController@product');
Route::post('productPost','ProductController@productPost');
Route::get('banner','BannerController@banner');
Route::post('bannerPost','BannerController@bannerPost');
Route::get('updateBanner/{banner_id}','BannerController@update');
Route::post('updateBannerPost','BannerController@updateBannerPost');
Route::get('deleteBanner/{banner_id}','BannerController@deleteBanner');
Route::get('restoreBanner/{banner_id}','BannerController@restoreBanner');
Route::get('harddeleteBanner/{banner_id}','BannerController@harddeleteBanner');

Route::get('updateProduct/{product_id}','ProductController@updateProduct');
Route::post('updateProductPost','ProductController@updateProductPost');
Route::get('deleteProduct/{produst_id}','ProductController@deleteProduct');
Route::get('restoreProduct/{produst_id}','ProductController@restoreProduct');
Route::get('harddeleteProduct/{produst_id}','ProductController@harddeleteProduct');

//couponController
Route::get('coupon','couponController@coupon');
Route::post('couponPost','couponController@couponPost');
Route::get('deleteCoupon/{coupon_id}','couponController@deleteCoupon');


Route::get('productDetails/{product_id}','ProductController@productDetails');

//testimonial HomeController
Route::get('testimonial','testimonialController@testimonial');
Route::post('testimonialPost','testimonialController@testimonialPost');
Route::get('updateTestimonial/{testimonial_id}','testimonialController@updateTestimonial');
Route::post('updateTestimonialPost','testimonialController@updateTestimonialPost');
Route::get('deleteTestimonial/{testimonial_id}','testimonialController@deleteTestimonial');
Route::get('restoreTestimonial/{testimonial_id}','testimonialController@restoreTestimonial');
Route::get('harddeleteTestimonial/{testimonial_id}','testimonialController@harddeleteTestimonial');


Route::get('shop','frontendController@shop');

//cart Controller
Route::post('addtocart','cartController@addtocart');
Route::get('deleteCartItem/{cart_id}','cartController@deleteCartItem');

//for coupon
Route::get('cartpage','cartController@cartpage');
Route::get('cartpage/{cart_name}','cartController@cartpage');

Route::post('updateCart','cartController@updateCart');

//favouriteController
Route::post('addtofavourite','favouriteController@addtofavourite');
Route::get('deleteFavtItem/{favt_id}','favouriteController@deleteFavtItem');

//checkoutController
Route::post('/checkout','CheckoutController@index');
Route::post('/checkoutPost','CheckoutController@checkoutPost');

//customer/login
Route::get('/customer/login','customerController@login');
Route::get('/customer/register','customerController@registration');
Route::post('customer_register_post','customerController@customer_register_post');


// StripePaymentController

Route::get('stripe', 'StripePaymentController@stripe');
Route::post('stripe', 'StripePaymentController@stripePost')->name('stripe.post');

// orderController
Route::get('order','orderController@order');
Route::get('deleteOrder/{order_id}','orderController@deleteOrder');

Route::get('orderInfo','orderController@orderInfo');
Route::get('deleteOrderInfo/{order_id}','orderController@deleteOrderInfo');

//Report controller
Route::get('report','reportController@report');

//User controller
Route::get('deleteUser/{user_id}','userController@deleteUser');
