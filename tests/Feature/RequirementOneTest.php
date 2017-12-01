<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RequimentOneTest extends TestCase
{
    /**
     * Test for 2015/Audi/A3
     *
     * @return void
     */
    public function testAudiA3()
    {
        $response = $this->get('vehicles/2015/Audi/A3');

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
        $response = $this->get('vehicles/2015/Toyota/Yaris');

        $response
            ->assertStatus(200)
            ->assertExactJson(VehicleAPIResults::TOYOTA_YARIS);
    }

    /**
     * Test for 2015/Ford/Crown Victoria
     *
     * @return void
     */
    public function testFordCrown()
    {
        $response = $this->get('vehicles/2015/Ford/Crown Victoria');

        $response
            ->assertStatus(200)
            ->assertExactJson(VehicleAPIResults::DEFAULT_EMPTY_RESULT);
    }

    /**
     * Test for undefined/Ford/Fusion
     *
     * @return void
     */
    public function testFordFusion()
    {
        $response = $this->get('vehicles/undefined/Ford/Fusion');

        $response
            ->assertStatus(200)
            ->assertExactJson(VehicleAPIResults::DEFAULT_EMPTY_RESULT);
    }
}