<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register','Api\Client\AuthController@register');
Route::post('/login','Api\Client\AuthController@login');
Route::post('/verification','Api\Client\AuthController@verification');
Route::post('/resend/verification','Api\Client\AuthController@resend_verification');
Route::post('/reset', 'Api\Client\AuthController@forgetpassword');
//
Route::post('countries', 'Api\ApiController@countries');
Route::post('cities', 'Api\ApiController@cities');
Route::post('categories', 'Api\ApiController@categories');
Route::post('category/services', 'Api\ApiController@servicesByCategoryID');
// Route::post('/edit_password', 'Api\AuthController@editPassword');
// Route::post('/google', 'Api\AuthController@google');
// Route::post('/facebook', 'Api\AuthController@facebook');
Route::post('contact', 'Api\ApiController@contact');
Route::post('terms', 'Api\ApiController@terms');

Route::group(['middleware' => 'auth:api'], function () {
    //
	Route::post('/edit', 'Api\Client\AuthController@profile');
    Route::post('/logout','Api\Client\AuthController@logout');
    // Route::post('/refresh', 'Api\AuthController@refresh');
	Route::post('notifications', 'Api\Client\ApiController@notifications');
	Route::post('notifications/read', 'Api\Client\ApiController@notificationsRead');
	Route::post('home', 'Api\Client\ApiController@home');
	Route::post('search', 'Api\Client\ApiController@search');
	Route::post('latestnews', 'Api\Client\ApiController@latestnews');
	Route::post('providers', 'Api\Client\ApiController@providers');
	Route::post('providers/details', 'Api\Client\ApiController@getProvider');
	Route::post('service/providers', 'Api\Client\ApiController@providersByService');
	Route::post('buildingTypes', 'Api\Client\ApiController@buildingTypes');
	Route::post('providers/subservices', 'Api\Client\ApiController@subservicesByProviderID');
	Route::post('providers/products', 'Api\Client\ApiController@productsByProviderID');
	Route::post('providers/timeperiods', 'Api\Client\ApiController@timePeriodsByProviderBranchID');
	//
	Route::post('orders/new', 'Api\Client\ApiController@newOrder');
	Route::post('orders/edit', 'Api\Client\ApiController@editOrder');
    Route::post('orders/cancel', 'Api\Client\ApiController@cancelOrder');
    Route::post('orders/accept', 'Api\Client\ApiController@acceptOrder');
    Route::post('orders/reject', 'Api\Client\ApiController@rejectOrder');
    Route::post('orders/images/delete', 'Api\Client\ApiController@deleteAttachment');
    Route::post('orders/details', 'Api\Client\ApiController@getOrder');
    Route::post('orders', 'Api\Client\ApiController@getOrders');    
    Route::post('orders/comments', 'Api\Client\ApiController@getOrderComments');
    Route::post('orders/comments/add', 'Api\Client\ApiController@addComment');
	//

});


Route::group(['prefix' => 'providers'], function () {
    Route::post('/register','Api\Provider\AuthController@register');
	Route::post('/login','Api\Provider\AuthController@login');
	Route::post('/verification','Api\Provider\AuthController@verification');
	Route::post('/resend/verification','Api\Provider\AuthController@resend_verification');
	Route::post('/reset', 'Api\Provider\AuthController@forgetpassword');


    Route::group(['middleware' => ['auth:proapi']], function () {
	    //
		Route::post('/edit', 'Api\Provider\AuthController@profile');
	    Route::post('/logout','Api\Provider\AuthController@logout');
    	// Route::post('/refresh', 'Api\AuthController@refresh');
		Route::post('notifications', 'Api\Provider\ApiController@notifications');
		Route::post('notifications/read', 'Api\Provider\ApiController@notificationsRead');
		Route::post('branch/number', 'Api\Provider\ApiController@branchNumber');
		Route::post('branch/new', 'Api\Provider\ApiController@newBranch');
		Route::post('branch/edit', 'Api\Provider\ApiController@editBranch');
		Route::post('branch/delete', 'Api\Provider\ApiController@deleteBranch');
		Route::post('packages', 'Api\Provider\ApiController@packages');
		Route::post('packages/pay', 'Api\Provider\ApiController@payPackage');
		Route::post('branch/service/new', 'Api\Provider\ApiController@newBranchService');
		Route::post('branch/service/edit', 'Api\Provider\ApiController@editBranchService');
		Route::post('branch/service/delete', 'Api\Provider\ApiController@deleteBranchService');
		Route::post('branch/timeperiod/new', 'Api\Provider\ApiController@newBranchTimePeriod');
		Route::post('branch/timeperiod/edit', 'Api\Provider\ApiController@editBranchTimePeriod');
		Route::post('branch/timeperiod/delete', 'Api\Provider\ApiController@deleteBranchTimePeriod');
    	Route::post('promocode/check', 'Api\Provider\ApiController@checkPromoCode');
    	Route::post('orders/cancel', 'Api\Provider\ApiController@cancelOrder');
    	Route::post('orders/accept', 'Api\Provider\ApiController@acceptOrder');
	    Route::post('order/details', 'Api\Provider\ApiController@getOrder');
	    Route::post('orders', 'Api\Provider\ApiController@getOrders');    
	    Route::post('orders/comments', 'Api\Provider\ApiController@getOrderComments');
	    Route::post('orders/comments/add', 'Api\Provider\ApiController@addComment');

    });
});


Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found. If error persists, contact info@teraninja.com'], 404);
});
