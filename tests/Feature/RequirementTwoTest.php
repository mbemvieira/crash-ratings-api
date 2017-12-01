<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RequirementTwoTest extends TestCase
{
    /**
     * Test for 2015/Audi/A3
     *
     * @return void
     */
    public function testAudiA3()
    {
        $response = $this->json('POST', '/vehicles', [
            'modelYear' => 2015,
            'manufacturer' => 'Audi',
            'model' => 'A3',
        ]);

        $response
            ->assertStatus(200)
            ->assertExactJson(VehicleAPIResults::AUDI_A3);
    }

    /**
     * Test for 2015/Toyota/Yaris
     *
     * @return void
     */
    public function testToyotaYaris()
    {
        $response = $this->json('POST', '/vehicles', [
            'modelYear' => 2015,
            'manufacturer' => 'Toyota',
            'model' => 'Yaris',
        ]);

        $response
            ->assertStatus(200)
            ->assertExactJson(VehicleAPIResults::TOYOTA_YARIS);
    }

    /**
     * Test for Honda/Accord
     *
     * @return void
     */
    public function testHondaAccord()
    {
        $response = $this->json('POST', '/vehicles', [
            'manufacturer' => 'Honda',
            'model' => 'Accord',
        ]);

        $response
            ->assertStatus(200)
            ->assertExactJson(VehicleAPIResults::DEFAULT_EMPTY_RESULT);
    }
}
