<?php

/*
|--------------------------------------------------------------------------
| admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'dashboard'], function () {
    Auth::routes();

    Route::group(['middleware' => ['auth']], function () {
        Route::get('/' ,'HomeController@index')->name('home');
        //settings
        Route::resource('settings','Admin\SettingController');
        //users
        Route::resource('users','Admin\UserController');
        //countries
        Route::resource('countries','Admin\CountryController');
        //cities
        Route::resource('cities','Admin\CityController');
        //buildingType
        Route::resource('buildingType','Admin\BuildingTypeController');
        //news
        Route::resource('news','Admin\NewsController');
        //categroies
        Route::resource('categroies','Admin\CateogryController');
        //Clients
        Route::resource('clients','Admin\ClientsController');
        //Providers
        Route::resource('providers','Admin\ProvidersController');
        //Packages
        Route::resource('packages','Admin\PackagesController');
        //Services
        Route::resource('services','Admin\ServicesController');
        //SubServices
        Route::resource('sub_services','Admin\SubServicesController');
        //PromoCode
        Route::resource('promo_code','Admin\PromoCodeController');
        //products
        Route::resource('products','Admin\ProductsController');
        //Providers Branches
        Route::resource('providers_branches','Admin\ProviderBranchController');
        //Orders
        Route::resource('orders','Admin\OrderController');
        //transactions
        Route::resource('package_bank_transaction', 'Admin\PackageBankTransactionController');
        //confirm transactions
        Route::post('package_bank_transaction/confirm-transaction', 'Admin\PackageBankTransactionController@confirmTransaction');
        //Branch Period Time
        Route::resource('branch_period_time', 'Admin\TimeBranchPeriodController');

        Route::post('orders/{order}/search','Admin\OrderController@search_upload')->name('search.upload');
        //order comments
        Route::resource('comments','Admin\CommentsController');
        //payments
        Route::resource('payments','Admin\PaymentsController');
        //payment packages
        Route::resource('payment-packages','Admin\PaymentPackageController');
        //customer support
        Route::resource('customer-support','Admin\CustomerSupportChatController');

    });
});
