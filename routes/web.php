<?php

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

use Illuminate\Support\Facades\Artisan;



Route::get('file/{id}','FileController@getfile')->name('UserDownloadFile')->middleware(['signed','auth']);
Route::get('files/{id}','FileController@getSignedUrl')->middleware('auth');




Route::get('/', 'Front\FrontController@index')->name('home');
Route::get('/shop', 'Front\FrontController@shop')->name('shop');






Route::get('/mytest', function () {
    return view('test');
});


Route::get('/printp/{id}', function ($id) {
    $pack = App\Package::findorfail($id);
    $user = App\User::findorfail(Auth::id());
    return view('printp', compact(['pack']));
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::post('/get_user_reference','AdminAjaxController@get_user_reference')->name('get_user_reference');
//************************************* start Front Site **********************************************

//front product
//front product

Route::resource('/basket', 'Front\FrontBasketesController');
Route::delete('/basket/delete/{id}', 'Front\FrontAjaxsController@deleteItem')->name('ajax.delete');
Route::post('/basket/minus', 'Front\FrontAjaxsController@minusProductCount')->name('ajax.minus');
Route::post('/basket/add', 'Front\FrontAjaxsController@addProductCount')->name('ajax.add');
Route::post('/commentStore', 'Front\FrontAjaxsController@commentStore')->name('ajax.commentStore');
Route::post('/view-set_view_post','Front\FrontAjaxsController@set_view_post')->name('view.set_view_post');
Route::post('/view-set_view_product','Front\FrontAjaxsController@set_view_product')->name('view.set_view_product');
Route::post('/panel-add_favorite','Front\FrontAjaxsController@add_favorite')->name('panel.add_favorite');
Route::post('/panel-add_remove_favorite','Front\FrontAjaxsController@add_remove_favorite')->name('panel.add_remove_favorite');
Route::post('/panel-delete_favorite','Front\FrontAjaxsController@delete_favorite')->name('panel.delete_favorite');
Route::post('/all-search','Front\FrontAjaxsController@search')->name('search.search');

Route::get('admin/payment', 'Admin\AdminPaymentController@send')->name('payment.send');
Route::get('admin/paymentBack', 'Admin\AdminPaymentController@back')->name('payment.paymentBack');

//************************************* start Front Site **********************************************

Route::group(['middleware' => 'admin'], function (){

        Route::get('admin/stats', 'lastloginuser@stats')->name('stats');
        Route::get('admin/lastlogin', 'lastloginuser@index')->name('lastlogin');

        /***************** AdminB *****************/
        Route::get('admin/orders-product/export', 'Admin\AdminOrdersController@report')->name('orders.report');
        Route::resource('admin/orders-product', 'Admin\AdminOrdersController');
        Route::resource('admin/orders-download', 'Admin\AdminDownloadsController');
        Route::resource('admin/dashboard', 'Admin\AdminDashboardController');

        Route::post('admin/users/move_user', 'Admin\AdminUsersController@move_user');
        Route::resource('admin/users', 'Admin\AdminUsersController');
        Route::resource('admin/admins', 'Admin\AdminAdminsController');
        Route::resource('admin/attribute', 'Admin\AdminAttributesController');
        Route::resource('admin/categories', 'Admin\AdminCategoriesController');
        Route::resource('admin/PostCategory', 'Admin\AdminPostCategoriesController');
        Route::resource('admin/comment-product', 'Admin\AdminCommentProductController');
        Route::resource('admin/comment-post', 'Admin\AdminCommentPostController');
        Route::resource('admin/settings', 'Admin\AdminSettingsController');
        Route::resource('admin/sliders', 'Admin\AdminSlidersController');
        Route::resource('admin/banners', 'Admin\AdminBannersController');
        Route::resource('admin/brands', 'Admin\AdminBrandsController');
        Route::resource('admin/menus', 'Admin\AdminMenusController');


        Route::get('admin/calculation', 'Admin\AdminCalculationController@calculation');


        //************************************* Admin Site **********************************************
        Route::get('admin/products/deletegalleryproduct/{id}', 'Admin\AdminProductsController@deletegalleryproduct')->name('gallery.delete');

        Route::get('admin/product/attributes/{slug}', 'Admin\AdminProductsController@attributes');
        Route::post('admin/product/attribute_create', 'Admin\AdminProductsController@attribute_create')->name('attribute_create');
        Route::resource('admin/products', 'Admin\AdminProductsController');

        Route::resource('admin/posts', 'Admin\AdminPostsController');
        Route::resource('admin/profile', 'Admin\AdminProfilesController');

        //************************************* Admin Site **********************************************

        /***************** AdminB *****************/


        /***************** ajax B *****************/
        Route::post('/getoffcode', 'AdminAjaxController@getoffcode');
        Route::post('/commentminiproduct', 'AdminAjaxController@commentminiproduct');
        Route::post('/setlike', 'AdminAjaxController@setlike');
        Route::post('/setdislike', 'AdminAjaxController@setdislike');
        Route::post('/checkbag', 'AjaxController@checkbag')->name('checkbag');
        Route::post('/number_format_price', 'AdminAjaxController@number_format_price')->name('number_format_price');
        Route::post('/check_return_code_wallet', 'AdminAjaxController@check_return_code_wallet')->name('check_return_code_wallet');
        Route::post('/refresh_price_wallet', 'AjaxController@refresh_price_wallet')->name('refresh_price_wallet');
        Route::post('/Money_transfer_wallet', 'AdminAjaxController@Money_transfer_wallet')->name('Money_transfer_wallet');
        Route::post('/selfupdateuser', 'AdminAjaxController@selfupdateuser')->name('selfupdateuser');
        Route::post('/uploadimageprofile', 'AdminAjaxController@uploadimageprofile')->name('uploadimageprofile');
        Route::post('/Change_status_user', 'AdminAjaxController@Change_status_user')->name('Change_status_user');
        Route::post('/Change_status_user_wallet', 'AdminAjaxController@Change_status_user_wallet')->name('Change_status_user_wallet');
        Route::post('/Change_status_user_sendmoney', 'AdminAjaxController@Change_status_user_sendmoney')->name('Change_status_user_sendmoney');
        Route::post('/Change_status_user_seller', 'AdminAjaxController@Change_status_user_seller')->name('Change_status_user_seller');
        Route::post('/Change_documents_user', 'AdminAjaxController@Change_documents_user')->name('Change_documents_user');
        Route::post('/Change_documents_status_user', 'AdminAjaxController@Change_documents_status_user')->name('Change_documents_status_user');
        Route::post('/getstate', 'AdminAjaxController@getstate');
        Route::post('/admin/admins/Change_user_isadmin', 'AdminAjaxController@Change_user_isadmin')->name('Change_user_isadmin');
        Route::post('/admin/alerts/alert_status', 'AdminAjaxController@alert_status')->name('alert_status');
        Route::post('/admin/alerts/alert_remove', 'AdminAjaxController@alert_remove')->name('alert_remove');
        Route::post('/admin/delete_post', 'AdminAjaxController@delete_post')->name('post.delete_post');
        Route::post('/admin/delete_posts', 'AdminAjaxController@delete_posts')->name('post.delete_posts');
        Route::post('/admin/delete_attribute', 'AdminAjaxController@delete_attribute')->name('product.delete_attribute');
        Route::post('/admin/delete_attributes', 'AdminAjaxController@delete_attributes')->name('product.delete_attributes');
        Route::post('/admin/delete_attributes_val', 'AdminAjaxController@delete_attributes_val')->name('product.delete_attributes_val');
        Route::post('/admin/delete_post_category', 'AdminAjaxController@delete_post_category')->name('post.delete_post_category');
        Route::post('/admin/delete_posts_Categories', 'AdminAjaxController@delete_posts_Categories')->name('post.delete_posts_Categories');
        Route::post('/admin/delete_product_Category', 'AdminAjaxController@delete_product_Category')->name('post.delete_product_Category');
        Route::post('/admin/delete_products_Categories', 'AdminAjaxController@delete_products_Categories')->name('post.delete_products_Categories');
        Route::post('/admin/delete_product', 'AdminAjaxController@delete_product')->name('post.delete_product');
        Route::post('/admin/delete_products', 'AdminAjaxController@delete_products')->name('post.delete_products');
        Route::post('/admin/admins/service-comment-ajax', 'AdminAjaxController@service_comment_ajax')->name('service-comment-ajax');
        Route::post('/admin/admins/service-comment-ajax-delete', 'AdminAjaxController@service_comment_ajax_delete')->name('service-comment-ajax-delete');
        Route::post('/admin/admins/product-comment-ajax', 'AdminAjaxController@product_comment_ajax')->name('product-comment-ajax');
        Route::post('/admin/admins/product-comment-ajax-delete', 'AdminAjaxController@product_comment_ajax_delete')->name('product-comment-ajax-delete');
        Route::post('/admin/admins/change_price_monys_user', 'AdminAjaxController@change_price_monys_user')->name('change_price_monys_user');

        Route::post('/admin/user/delete_user', 'AdminAjaxController@delete_user')->name('user.delete_user');
        Route::post('/admin/user/delete_users', 'AdminAjaxController@delete_users')->name('user.delete_users');

        Route::post('/admin/slider/delete_image_slider', 'AdminAjaxController@delete_image_slider')->name('slider.delete_image_slider');
        Route::post('/admin/slider/set_link_slider', 'AdminAjaxController@set_link_slider')->name('slider.set_link_slider');
        Route::post('/admin/slider/set_status_slider', 'AdminAjaxController@set_status_slider')->name('slider.set_status_slider');

        Route::post('/admin/slider/delete_image_banner', 'AdminAjaxController@delete_image_banner')->name('banner.delete_image_banner');
        Route::post('/admin/slider/set_link_banner', 'AdminAjaxController@set_link_banner')->name('banner.set_link_banner');
        Route::post('/admin/slider/set_status_banner', 'AdminAjaxController@set_status_banner')->name('banner.set_status_banner');

        Route::post('/admin/brand/delete_image_brand', 'AdminAjaxController@delete_image_brand')->name('brand.delete_image_brand');
        Route::post('/admin/brand/set_link_brand', 'AdminAjaxController@set_link_brand')->name('brand.set_link_brand');
        Route::post('/admin/brand/set_title_brand', 'AdminAjaxController@set_title_brand')->name('brand.set_title_brand');
        Route::post('/admin/brand/set_status_brand', 'AdminAjaxController@set_status_brand')->name('brand.set_status_brand');

        /***************** ajax B *****************/


//    Route::get('admin/dashboard', 'Admin\AdminDashboardUserController@index')->name('dashboard.index');

});

Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('verifire', 'User\UserRegisterController@verifire')->name('verifire');
Route::post('verifire_code', 'User\UserRegisterController@verifire_code')->name('verifire_code');
Route::post('password/reset', 'User\UserRegisterController@verifire_password')->name('verifire_password');
Route::get('/password/verify', 'User\UserRegisterController@verifire_code_password')->name('verifire_code_password');
Route::get('password/pass', 'User\UserRegisterController@verifire_code_password_code')->name('verifire_code_password_code');
Route::post('password/pass', 'User\UserRegisterController@verifire_code_password_code')->name('verifire_code_password_code');
Route::post('reset_password', 'User\UserRegisterController@reset_password')->name('reset_password');






//------------------------------Ajax----------------------------
Route::post('/Again_code','AjaxController@Again_code')->name('Again_code');


/********** Run php artisan in Host **********/
Route::get('/rs/{namecontroller}', 'phpArtisan@rs'); // ساخت کنترلر ریسورس در مسیر اصلی
// example : http://site-url.com/rs/name

Route::get('/rsp/{namecontroller}/{path}', 'phpArtisan@rsp'); // ساخت کنترلر ریسورس در پوشه دلخواه
// example : http://site-url.com/rsp/name/path

Route::get('/ctrl/{namecontroller}', 'phpArtisan@ctrl'); // ساخت کنترلر در مسیر اصلی
// example : http://site-url.com/ctrl/name

Route::get('/rq/{namecontroller}', 'phpArtisan@rq'); // ساخت رکوئست در مسیر اصلی
// example : http://site-url.com/rq/name

Route::get('/ctrlp/{namecontroller}/{path}', 'phpArtisan@ctrlp'); // ساخت کنترلر در پوشه دلخواه
// example : http://site-url.com/ctrlp/name/path

Route::get('/mdl/{namecontroller}', 'phpArtisan@mdl'); //ساخت مدل
// example : http://site-url.com/mdl/name

Route::get('/mg/{namecontroller}', 'phpArtisan@mg'); // ساخت مایگریشن
// example : http://site-url.com/mg/name

Route::get('/runmg', 'phpArtisan@runmg'); // اجرای مایگریشن
// example : http://site-url.com/runmg
/********** Run php artisan in Host **********/

Route::post('order-verify', 'OrderController@verify');
Route::get('payment-verify', 'PaymentController@verify')->name('payment.verify');





Route::get('/admin/j', function () {
    $users=App\Tree::all();
    return view('j',compact(['users']));
});



/***************** Shopping Cart  ******************/
Route::post('/addcart', 'ShoppingCartController@addcart');
Route::post('/removecart', 'ShoppingCartController@removecart');
Route::post('/updatecart', 'ShoppingCartController@updatecart');
//Route::get('/cart', 'ShoppingCartController@cart');
/***************** Shopping Cart  ******************/


/***************** FrontController  ******************/

Route::get('/checkout', 'Front\FrontController@checkout');
Route::get('/blog', 'Front\FrontController@blog_index');
Route::get('/blog/{slug}', 'Front\FrontController@blog');
Route::get('/post-search', 'Front\FrontController@blog_search')->name('post_search');
Route::get('/contact', 'Front\FrontController@contact');
Route::get('/product/{slug}', 'Front\FrontController@product');
Route::get('/about', 'Front\FrontController@about');
Route::post('/comment_post_store', 'Front\FrontController@comment_post')->name('comment_post_store');
Route::post('/contact_store', 'Front\FrontController@contact_store')->name('contact_store');

Route::post('/product-filter/doSearch-filter', 'Front\FrontController@doSearch')->name('shop.doSearch');

/***************** FrontController  ******************/

Route::group(['middleware' => 'admin'], function () {
    /***************** PanelFrontController  ******************/
    Route::get('/panel', 'Front\PanelController@index');
    Route::post('/comment_product_store', 'Front\FrontController@comment_product')->name('comment_product_store');
    Route::get('/panel/orders', 'Front\PanelController@orders');
    Route::get('/panel/favorites', 'Front\PanelController@favorites');
    Route::get('/panel/profile', 'Front\PanelController@profile');
    Route::post('/panel/edit_profile', 'Front\PanelController@edit_profile')->name('panel.edit_profile');
});
/***************** PanelFrontController  ******************/
