<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\AuthController;
use App\Models\Inventory;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login',[AuthController::class, 'login']);
    Route::post('logout', 'AuthController@logout');
    Route::post('register',[AuthController::class, 'register']);
    Route::post('me', 'AuthController@me');

});

Route::get('todays_topups','DashboardController@todays_topups');

Route::group(['middleware' => 'auth:api',], function () {
    Route::post('add',[InventoryController::class, 'create']);
    Route::get('show',[InventoryController::class, 'show']);
    Route::delete('delete/{id}',[InventoryController::class, 'delete']);
    Route::put('edit/{id}',[InventoryController::class, 'update']);
    Route::post('add-item',[CartController::class, 'create']);
    Route::get('show-cart',[CartController::class, 'show_cart']);
});