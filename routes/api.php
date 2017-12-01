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

// Requirement 1 and 3 Endpoint
Route::get('vehicles/{model_year?}/{manufacturer?}/{model?}',
    'VehicleController@getVehicleVariants');

// Requirement 2 and 3 Endpoint
Route::post('vehicles', 'VehicleController@getVehicleVariantsJSON');
