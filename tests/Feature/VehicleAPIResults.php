<?php

namespace Tests\Feature;

class VehicleAPIResults
{
    /**
     * Default response for errors or empty results
     * 
     * @var array
     */
    public const DEFAULT_EMPTY_RESULT = [
        'Count' => 0,
        'Results'=> [],
    ];

    /**
     * Expected result for 2015/Audi/A3
     * 
     * @var array
     */
    public const AUDI_A3 = [
        'Count' => 4,
        'Results'=> [
            [
                'VehicleId' => 9403,
                'Description' => '2015 Audi A3 4 DR AWD',
            ],
            [
                'VehicleId' => 9408,
                'Description' => '2015 Audi A3 4 DR FWD',
            ],
            [
                'VehicleId' => 9405,
                'Description' => '2015 Audi A3 C AWD',
            ],
            [
                'VehicleId' => 9406,
                'Description' => '2015 Audi A3 C FWD',
            ],
        ],
    ];

    /**
     * Expected result for 2015/Toyota/Yaris
     * 
     * @var array
     */
    public const TOYOTA_YARIS = [
        'Count' => 2,
        'Results'=> [
            [
                'VehicleId' => 9791,
                'Description' => '2015 Toyota Yaris 3 HB FWD',
            ],
            [
                'VehicleId' => 9146,
                'Description' => '2015 Toyota Yaris Liftback 5 HB FWD',
            ],
        ],
    ];

    /**
     * Expected result for 2015/Audi/A3?withRating=true
     * 
     * @var array
     */
    public const AUDI_A3_WITH_RATING = [
        'Count' => 4,
        'Results'=> [
            [
                'VehicleId' => 9403,
                'Description' => '2015 Audi A3 4 DR AWD',
                'CrashRating' => '5',
            ],
            [
                'VehicleId' => 9408,
                'Description' => '2015 Audi A3 4 DR FWD',
                'CrashRating' => '5',
            ],
            [
                'VehicleId' => 9405,
                'Description' => '2015 Audi A3 C AWD',
                'CrashRating' => 'Not Rated',
            ],
            [
                'VehicleId' => 9406,
                'Description' => '2015 Audi A3 C FWD',
                'CrashRating' => 'Not Rated',
            ],
        ],
    ];

    /**
     * Expected result for 2015/Toyota/Yaris?withRating=true
     * 
     * @var array
     */
    public const TOYOTA_YARIS_WITH_RATING = [
        'Count' => 2,
        'Results'=> [
            [
                'VehicleId' => 9791,
                'Description' => '2015 Toyota Yaris 3 HB FWD',
                'CrashRating' => 'Not Rated',
            ],
            [
                'VehicleId' => 9146,
                'Description' => '2015 Toyota Yaris Liftback 5 HB FWD',
                'CrashRating' => '4',
            ],
        ],
    ];    
}