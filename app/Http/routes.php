<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/




/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    /**
     * Frontend Routing
     */
    Route::get('/',['as'=>'home','uses'=>'HomeController@index']);

    /**
     * Admin Routes
     */

    Route::group(['prefix' => 'admin'], function () {
       Route::get('/', [
            'as' => 'login',
            'uses' => 'AdminAuthController@login'
        ]);
        Route::resource('articles', 'ArticlesController');
        # Logout From Portal
        Route::get('logout', [
            'as' => 'logout',
            'uses' => 'AdminAuthController@logout',
        ]);
        Route::post('/', ['uses' => 'AdminAuthController@signIn']);
        Route::get('dashboard', ['as'=> 'admin_dashboard', 'uses' => 'AdminController@dashboard']);
        /**
         * Category
         */
        Route::group(['prefix' =>'category','middleware'=>['adminAuth']],function(){
            Route::get('create',['as'=>'new_category','uses'=>'CategoryController@create']);
            Route::post('create',['as'=>'new_category','uses'=>'CategoryController@store']);
            Route::get('category',['as'=>'category','uses'=>'CategoryController@index']);
            Route::get('category-list', ['as' => 'category_list', 'uses' => 'CategoryController@categoryData']);
            Route::get('soft-delete/{id}',['as'=>'category_soft_delete','uses'=>'CategoryController@softDelete']);
            Route::get('soft-delete-restore/{id}',['as'=>'category_soft_delete_restore','uses'=>'CategoryController@softDeleteRestore']);
            Route::get('sub-create/{id}',['as'=>'new_sub_category','uses'=>'CategoryController@SubCategoryCreate']);
            Route::post('sub-create/{id}',['as'=>'new_sub_category','uses'=>'CategoryController@SubCategoryStore']);
            Route::get('sub-category/{id}', ['as' => 'sub_category', 'uses' => 'CategoryController@subIndex']);
            Route::get('sub-category-list/{id}', ['as' => 'sub_category_list', 'uses' => 'CategoryController@subCategoryData']);
            Route::get('category-edit/{id}',['as'=>'category_edit','uses'=>'CategoryController@edit']);
            Route::post('category-update/{id}',['as'=>'category_update','uses'=>'CategoryController@update']);
        });

        Route::group(['prefix'=>'settings','middleware'=>['adminAuth']],function(){
            Route::group(['prefix'=>'region'],function(){
                Route::get('region-create',['as'=>'region_create','uses'=>'RegionController@create']);
                Route::post('region-create',['as'=>'region_create','uses'=>'RegionController@store']);
                Route::get('region',['as'=>'region','uses'=>'RegionController@index']);
                Route::get('region-list',['as'=>'region_list','uses'=>'RegionController@regionData']);
                Route::get('region-edit/{id}',['as'=>'region_edit','uses'=>'RegionController@edit']);
                Route::post('region-update/{id}',['as'=>'region_update','uses'=>'RegionController@update']);
            });
            Route::group(['prefix'=>'city'],function(){
                Route::get('city-create',['as'=>'city_create','uses'=>'CityController@create']);
                Route::post('city-create',['as'=>'city_create','uses'=>'CityController@store']);
                Route::get('city',['as'=>'city','uses'=>'CityController@index']);
                Route::get('city-list',['as'=>'city_list','uses'=>'CityController@cityData']);
                Route::get('city-edit/{id}',['as'=>'city_edit','uses'=>'CityController@edit']);
                Route::post('city-update/{id}',['as'=>'city_update','uses'=>'CityController@update']);
            });
            Route::group(['prefix'=>'area'],function(){
                Route::get('area-create',['as'=>'area_create','uses'=>'AreaController@create']);
                Route::post('area-create',['as'=>'area_create','uses'=>'AreaController@store']);
                Route::get('area',['as'=>'area','uses'=>'AreaController@index']);
                Route::get('area-list',['as'=>'area_list','uses'=>'AreaController@areaData']);
                Route::get('area-edit/{id}',['as'=>'area_edit','uses'=>'AreaController@edit']);
                Route::post('area-update/{id}',['as'=>'area_update','uses'=>'AreaController@update']);
            });
            Route::group(['prefix'=>'attribute'],function(){
                Route::get('create',['as'=>'attribute_create','uses'=>'MeasurementAttributeController@create']);
                Route::post('create',['as'=>'attribute_create','uses'=>'MeasurementAttributeController@store']);
                Route::get('attribute',['as'=>'attribute','uses'=>'MeasurementAttributeController@index']);
                Route::get('attribute-soft-delete/{id}',['as'=>'attribute_soft_delete','uses'=>'MeasurementAttributeController@softDelete']);
                Route::get('attribute=soft-delete-restore/{id}',['as'=>'attribute_soft_delete_restore','uses'=>'MeasurementAttributeController@softDeleteRestore']);
            });

            Route::group(['prefix'=>'common'],function(){
                Route::get('common',['as'=>'common','uses'=>'CommonSetingsController@index']);
                Route::post('common',['as'=>'common','uses'=>'CommonSetingsController@update']);
                Route::get('logo',['as'=>'logo','uses'=>'CommonSetingsController@logo']);
                Route::post('logo',['as'=>'logo','uses'=>'CommonSetingsController@logoUpdate']);
                Route::get('new_option',['as'=>'new_option','uses'=>'CommonSetingsController@create']);
                Route::post('new_option',['as'=>'new_option','uses'=>'CommonSetingsController@store']);
                /*
               * File manager route collection
               */
                Route::get('dialog', function () {
                    return view('admin.filemanager.dialog3');
                });
                Route::get('dialog.php', function () {
                    return view('admin.filemanager.dialog3');
                });
                Route::post('execute.php', function () {
                    return view('admin.filemanager.execute_brand');
                });
                Route::post('upload.php', function () {
                    return view('admin.filemanager.upload_brand');
                });
                Route::post('success.php', function () {
                    return view('admin.filemanager.uploader.success');
                });
                Route::post('ajax_calls.php', function () {
                    return view('admin.filemanager.ajax_calls_brand');
                });
            });
            Route::group(['prefix'=>'manufacture'],function(){
                Route::get('create',['as'=>'manufacture_create','uses'=>'ManufactureController@create']);
                Route::post('create',['as'=>'manufacture_create','uses'=>'ManufactureController@store']);
                Route::get('manufacture',['as'=>'manufacture','uses'=>'ManufactureController@index']);
                Route::get('soft-delete/{id}',['as'=>'manufacture_soft_delete','uses'=>'ManufactureController@softDelete']);
                Route::get('soft-delete-restore/{id}',['as'=>'manufacture_soft_delete_restore','uses'=>'ManufactureController@softDeleteRestore']);
                Route::get('manufacture-list', ['as' => 'manufacture_list', 'uses' => 'ManufactureController@manufactureData']);
                Route::get('manufacture-edit/{id}',['as'=>'manufacture_edit','uses'=>'ManufactureController@edit']);
                Route::post('manufacture-update/{id}',['as'=>'manufacture_update','uses'=>'ManufactureController@update']);
                /*
               * File manager route collection
               */
                Route::get('dialog', function () {
                    return view('admin.filemanager.dialog3');
                });
                Route::get('dialog.php', function () {
                    return view('admin.filemanager.dialog3');
                });
                Route::post('execute.php', function () {
                    return view('admin.filemanager.execute_brand');
                });
                Route::post('upload.php', function () {
                    return view('admin.filemanager.upload_brand');
                });
                Route::post('success.php', function () {
                    return view('admin.filemanager.uploader.success');
                });
                Route::post('ajax_calls.php', function () {
                    return view('admin.filemanager.ajax_calls_brand');
                });
            });
        });

        Route::group(['prefix'=>'product','middleware'=>['adminAuth']],function(){
            Route::get('create',['as'=>'product_create','uses'=>'ProductController@create']);
            Route::post('create',['as'=>'product_create','uses'=>'ProductController@store']);
            Route::get('product',['as'=>'product','uses'=>'ProductController@index']);
            Route::get('product-list', ['as' => 'product_list', 'uses' => 'ProductController@productData']);
            Route::get('sub-category-by-category', ['as' => 'sub_category_by_category', 'uses' => 'ProductController@subCategory']);
            Route::get('product-edit/{id}',['as'=>'product_edit','uses'=>'ProductController@edit']);
            Route::post('product-update/{id}',['as'=>'product_update','uses'=>'ProductController@update']);
            Route::get('soft-delete/{id}',['as'=>'product_soft_delete','uses'=>'ProductController@softDelete']);
            Route::get('soft-delete-restore/{id}',['as'=>'product_soft_delete_restore','uses'=>'ProductController@softDeleteRestore']);
            Route::get('add-to-color-name',['as'=>'add_to_color_name','uses'=>'ProductController@getColorNameList']);
            Route::get('add-to-tag-name',['as'=>'add_to_tag_name','uses'=>'ProductController@getTagNameList']);
            /*
             * Product Image route collection
             */

            Route::get('product-image/{id}',['as'=>'product_image','uses'=>'ProductController@productImage']);
            Route::get('product-image-list/{id}', ['as' => 'product_image_list', 'uses' => 'ProductController@productImageData']);
            Route::get('add-image/{id}',['as'=>'add_image','uses'=>'ProductController@addImage']);
            Route::post('add-image/{id}',['as'=>'add_image','uses'=>'ProductController@storeImage']);
            Route::post('remove-image',['as'=>'remove_image','uses'=>'ProductController@removeImage']);
            Route::get('add-image-dialog',['as'=>'add_image_dialog','uses'=>'ProductController@addImageDialog']);
            /*
             * File manager route collection
             */
            Route::get('dialog', function () {
                return view('admin.filemanager.dialog');
            });
            Route::get('dialog', function () {
                return view('admin.filemanager.dialog');
            });
            Route::get('dialog.php', function () {
                return view('admin.filemanager.dialog');
            });
            Route::post('execute.php', function () {
                return view('admin.filemanager.execute');
            });
            Route::post('upload.php', function () {
                return view('admin.filemanager.upload');
            });
            Route::post('success.php', function () {
                return view('admin.filemanager.uploader.success');
            });
            Route::post('ajax_calls.php', function () {
                return view('admin.filemanager.ajax_calls');
            });
        });

        /**
         * Special offer/deals
         */

        Route::group(['prefix' =>'special','middleware'=>['adminAuth']],function(){
            Route::get('create',['as'=>'new_offer','uses'=>'SpecialOfferController@create']);
            Route::post('create',['as'=>'new_offer','uses'=>'SpecialOfferController@store']);
            Route::get('offer',['as'=>'offer','uses'=>'SpecialOfferController@index']);
            Route::get('offer-list', ['as' => 'offer_list', 'uses' => 'SpecialOfferController@offerData']);
            Route::get('soft-delete/{id}',['as'=>'offer_soft_delete','uses'=>'SpecialOfferController@softDelete']);
            Route::get('soft-delete-restore/{id}',['as'=>'offer_soft_delete_restore','uses'=>'SpecialOfferController@softDeleteRestore']);
        });
        /**
         * Slideshow
         */

        Route::group(['prefix' =>'slide','middleware'=>['adminAuth']],function(){
            Route::get('create',['as'=>'new_slideshow','uses'=>'SlideshowController@create']);
            Route::post('create',['as'=>'new_slideshow','uses'=>'SlideshowController@store']);
            Route::get('slideshow',['as'=>'slideshow','uses'=>'SlideshowController@index']);
            Route::get('slideshow-list', ['as' => 'slideshow_list', 'uses' => 'SlideshowController@slideshowData']);
            Route::get('delete/{id}',['as'=>'slideshow_delete','uses'=>'SlideshowController@delete']);
            /*
             * File manager route collection
             */
            Route::get('dialog', function () {
                return view('admin.filemanager.dialog');
            });
            Route::get('dialog.php', function () {
                return view('admin.filemanager.dialog');
            });
            Route::post('execute.php', function () {
                return view('admin.filemanager.execute');
            });
            Route::post('upload.php', function () {
                return view('admin.filemanager.upload');
            });
            Route::post('success.php', function () {
                return view('admin.filemanager.uploader.success');
            });
            Route::post('ajax_calls.php', function () {
                return view('admin.filemanager.ajax_calls');
            });
        });
        /**
         * Orders
         */

        Route::group(['prefix' =>'order','middleware'=>['adminAuth']],function(){
            Route::get('all',['as'=>'all','uses'=>'OrderController@all']);
            Route::get('all-list',['as'=>'all_list','uses'=>'OrderController@allData']);
            Route::get('complete',['as'=>'complete','uses'=>'OrderController@complete']);
            Route::get('complete-list',['as'=>'complete_list','uses'=>'OrderController@completeData']);
            Route::get('cash',['as'=>'cash','uses'=>'OrderController@cash']);
            Route::get('cash-list',['as'=>'cash_list','uses'=>'OrderController@cashData']);
            Route::get('pending',['as'=>'pending','uses'=>'OrderController@pending']);
            Route::get('pending-list',['as'=>'pending_list','uses'=>'OrderController@pendingData']);
            Route::get('pre-order',['as'=>'pre_order','uses'=>'OrderController@preOrder']);
            Route::get('pre-order-list',['as'=>'pre_order_list','uses'=>'OrderController@preOrderData']);
            Route::get('cash-pay/{id}',['as'=>'cash_pay','uses'=>'OrderController@cashPay']);
            Route::post('cash-pay/{id?}',['as'=>'cash_pay','uses'=>'OrderController@cashPayPost']);
            Route::get('get-order-items/{id?}',['as'=>'get_order_items','uses'=>'OrderController@getOrderItems']);
        });
        Route::group(['prefix'=>'charge','middleware'=>['adminAuth']],function(){
            Route::get('charge-create',['as'=>'charge_create','uses'=>'ChargeController@create']);
            Route::post('charge-create',['as'=>'charge_create','uses'=>'ChargeController@store']);
            Route::get('charge',['as'=>'charge','uses'=>'ChargeController@index']);
            Route::get('charge-list',['as'=>'charge_list','uses'=>'ChargeController@chargeData']);
            Route::get('charge-edit/{id}',['as'=>'charge_edit','uses'=>'ChargeController@edit']);
            Route::post('charge-update/{id}',['as'=>'charge_update','uses'=>'ChargeController@update']);
            Route::post('generate-city-list',['as'=>'generate_city_list','uses'=>'ChargeController@generateCityData']);
            Route::post('generate-area-list',['as'=>'generate_area_list','uses'=>'ChargeController@generateAreaData']);
        });
    });
});
