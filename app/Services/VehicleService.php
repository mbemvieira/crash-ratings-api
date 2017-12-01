<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Response;

class VehicleService
{
    /**
     * Base URI constant
     * 
     * @var string
     */
    private const BASE_URI = 'https://one.nhtsa.gov/webapi/api/SafetyRatings/';

    /**
     * @var Client
     */
    private $client;

    /**
     * Service Constructor
     */
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => self::BASE_URI,
        ]);
    }

    /**
     * Interface function that fetches data from the API
     * 
     * @param  int  $model_year
     * @param  string  $manufaturer
     * @param  string  $model
     * @param  bool  $rating
     * @return array
     */
    public function findVehicles($model_year, $manufaturer, $model, $rating)
    {
        if ($rating) {
            $vehicles = $this->fetchVehiclesFromApiWithRating(
                $model_year,
                $manufaturer,
                $model
            );
        } else {
            $vehicles = $this->fetchVehiclesFromApi(
                $model_year,
                $manufaturer,
                $model
            );
        }

        return $vehicles;
    }

    /**
     * Fetch data from API
     * 
     * @param  int  $model_year
     * @param  string  $manufaturer
     * @param  string  $model
     * @return array
     */
    protected function fetchVehiclesFromApi(int $model_year,
        string $manufaturer, string $model
    )
    {
        $uri_parameters = 'modelyear/'. $model_year .
            '/make/'. $manufaturer .'/model/'. $model .'?format=json';

        try {
            $response = $this->client->request('GET', $uri_parameters);
            $content = $this->getContentFromResponse($response);
            
            unset($content['Message']);

            $content['Results'] = array_map(function ($item) {
                $item['Description'] = $item['VehicleDescription'];
                unset($item['VehicleDescription']);
                return $item;
            }, $content['Results']);
        } catch (RequestException $e) {
            return $this->defaultVehiclesArray();
        }
        
        return $content;
    }

    /**
     * Fetch data from API with ratings
     * 
     * @param  int  $model_year
     * @param  string  $manufaturer
     * @param  string  $model
     * @return array
     */
    protected function fetchVehiclesFromApiWithRating($model_year, $manufaturer, $model)
    {
        $vehicles = $this->fetchVehiclesFromApi($model_year, $manufaturer, $model);

        try {
            $vehicles['Results'] = array_map(function ($item) {
                $uri_parameters = 'VehicleId/'. $item['VehicleId'] .'?format=json';

                $response = $this->client->request('GET', $uri_parameters);
                $content = $this->getContentFromResponse($response);

                $item['CrashRating'] = $content['Results'][0]['OverallRating'];

                return $item;
            }, $vehicles['Results']);
        } catch (RequestException $e) {
            return $this->defaultVehiclesArray();
        }
        
        return $vehicles;
    }

    /**
     * Default vehicles array for empty data or request error
     * 
     * @return array
     */
    public function defaultVehiclesArray() {
        return $vehicles = [
            'Count' => 0,
            'Results' => []
        ];
    }

    /**
     * Read the response from the requested API
     * 
     * @param  GuzzleHttp\Psr7\Response  $response
     * @return array
     */
    protected function getContentFromResponse(Response $response)
    {
        return json_decode($response->getBody()->getContents(), true);
    }
}