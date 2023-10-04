<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::options('{all}', function () {

    return response('', 200);
})->where('all', '.*');

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
return $request->user();
});*/

Route::prefix('v1')->group(function () {
  
    Route::post('userCreate', 'Api\UserController@userCreate');


    Route::get('getUsers', 'Api\UserController@getUsers');


    Route::post('userInvoiceCreate', 'Api\UserController@userInvoiceCreate');

    Route::get('getUserInvoiceCreate/{userId}', 'Api\UserController@getUserInvoiceCreate');

});
