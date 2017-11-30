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

// Requirement 1 Endpoint
// GET http://localhost:8080/vehicles/<MODEL YEAR>/<MANUFACTURER>/<MODEL>
Route::get('vehicles/{model_year?}/{manufacturer?}/{model?}',
    'VehicleController@getVehicleVariants');

Route::post('vehicles', 'VehicleController@getVehicleVariantsJSON');
