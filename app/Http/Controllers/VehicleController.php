<?php

namespace App\Http\Controllers;

use Validator;
use App\Services\VehicleService;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * @var VehicleService
     */
    private $vehicleService;
    
    public function __construct(VehicleService $vehicleService)
    {
        $this->vehicleService = $vehicleService;
    }

    /**
     * Query available vehicle variants
     * 
     * @param  Illuminate\Http\Request  $request
     * @param  int  $model_year
     * @param  string  $manufaturer
     * @param  string  $model
     * @return array
     */
    public function getVehicleVariants(Request $request, $model_year = null,
        $manufaturer = null, $model = null
    )
    {
        if (is_null($model_year) || is_null($manufaturer) || is_null($model) ||
            ! preg_match('/[0-9]+/', $model_year) ||
            ! preg_match('/[A-Za-z]+(-[A-Za-z]+)?/', $manufaturer) ||
            ! preg_match('/[A-Za-z]+(-[A-Za-z]+)?/', $model)
        ) {
            return $this->defaultResponse();
        }

        $validator = Validator::make($request->all(), [
            'withRating' => 'boolean'
        ]);

        if ($validator->fails()) {
            return $this->vehicleService->defaultVehiclesArray();
        }

        $rating = $request->input('withRating', false);

        $vehicles = $this->vehicleService->findVehicles($model_year, $manufaturer, $model, $rating);
        
        return response()->json($vehicles, 200,
            ['Content-type' => 'application/json; charset=utf-8'],
            JSON_UNESCAPED_UNICODE);
    }

    /**
     * Query available vehicle variants with JSON parameters
     * 
     * @param  Illuminate\Http\Request  $request
     * @return array
     */
    public function getVehicleVariantsJSON(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'modelYear' => 'required|numeric',
            'manufacturer' => 'required|alpha_dash',
            'model' => 'required|alpha_dash',
            'withRating' => 'boolean'
        ]);

        if ($validator->fails()) {
            return $this->vehicleService->defaultVehiclesArray();
        }

        $model_year = $request->input('modelYear');
        $manufaturer = $request->input('manufacturer');
        $model = $request->input('model');
        $rating = $request->input('withRating', false);

        $vehicles = $this->vehicleService->findVehicles($model_year, $manufaturer, $model, $rating);

        return response()->json($vehicles, 200,
            ['Content-type' => 'application/json; charset=utf-8'],
            JSON_UNESCAPED_UNICODE);
    }
}
