<?php

namespace App\Http\Controllers;

use Validator;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request as GuzzleHttpRequest;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Query available vehicle variants
     * 
     * @param  Illuminate\Http\Request  $request
     * @param  int  $model_year
     * @param  string  $manufaturer
     * @param  string  $model
     * @return array
     */
    public function getVehicleVariants(
        Request $request,
        $model_year = null,
        $manufaturer = null,
        $model = null
    ) {
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
            return $this->defaultResponse();
        }

        // https://one.nhtsa.gov/webapi/api/SafetyRatings/modelyear/2013/make/Acura/model/rdx?format=json
        /* $client = new Client();
        $base_uri = 'https://one.nhtsa.gov/webapi/api/SafetyRatings/';
        $uri_parameters = 'modelyear/'. $model_year .
            '/make/'. $manufaturer .'/model/'. $model .'?format=json';

        try {
            $nhtsa_request = new GuzzleHttpRequest('GET', $base_uri.$uri_parameters);
            $nhtsa_response = $client->send($nhtsa_request);
            $body = $nhtsa_response->getBody();
        } catch (RequestException $e) {
            return $this->defaultResponse();
        } */

        $client = new Client();
        $res = $client->request('GET',
            'https://one.nhtsa.gov/webapi/api/SafetyRatings/modelyear/2013/make/Acura/model/rdx?format=json');
        $body = $res->getBody();

        $response = [
            $body
        ];

        return response()->json($response, 200,
            ['Content-type' => 'application/json; charset=utf-8'],
            JSON_UNESCAPED_UNICODE);
    }

    /**
     * Query available vehicle variants with JSON parameters
     * 
     * @param  Illuminate\Http\Request  $request
     * @return array
     */
    public function getVehicleVariantsJSON(Request $request) {
        $validator = Validator::make($request->all(), [
            'modelYear' => 'required|numeric',
            'manufacturer' => 'required|alpha_dash',
            'model' => 'required|alpha_dash',
            'withRating' => 'boolean'
        ]);

        if ($validator->fails()) {
            return $this->defaultResponse();
        }

        $response = [
            'OK'
        ];

        return response()->json($response, 200,
            ['Content-type' => 'application/json; charset=utf-8'],
            JSON_UNESCAPED_UNICODE);
    }

    /**
     * Default error response
     * 
     * @return Illuminate\Http\Response
     */
    public function defaultResponse() {
        $response = [
            'Count' => 0,
            'Results' => []
        ];

        return response()->json($response, 200,
            ['Content-type' => 'application/json; charset=utf-8'],
            JSON_UNESCAPED_UNICODE);
    }
}
