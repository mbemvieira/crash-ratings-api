<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RequirementThreeTest extends TestCase
{
    /**
     * Test for 2015/Audi/A3?withRating=true
     *
     * @return void
     */
    public function testAudiA3WithRatingTrue()
    {
        $response = $this->get('vehicles/2015/Audi/A3?withRating=true');

        $response
            ->assertStatus(200)
            ->assertExactJson(VehicleAPIResults::AUDI_A3_WITH_RATING);
    }

    /**
     * Test for 2015/Toyota/Yaris?withRating=true
     *
     * @return void
     */
    public function testToyotaYarisWithRatingTrue()
    {
        $response = $this->get('vehicles/2015/Toyota/Yaris?withRating=true');

        $response
            ->assertStatus(200)
            ->assertExactJson(VehicleAPIResults::TOYOTA_YARIS_WITH_RATING);
    }

    /**
     * Test for 2015/Audi/A3?withRating=false
     *
     * @return void
     */
    public function testAudiA3WithRatingFalse()
    {
        $response = $this->get('vehicles/2015/Audi/A3?withRating=false');
        
        $response
            ->assertStatus(200)
            ->assertExactJson(VehicleAPIResults::AUDI_A3);
    }

    /**
     * Test for 2015/Audi/A3?withRating=bananas
     *
     * @return void
     */
    public function testAudiA3WithRatingBananas()
    {
        $response = $this->get('vehicles/2015/Audi/A3?withRating=bananas');
        
        $response
            ->assertStatus(200)
            ->assertExactJson(VehicleAPIResults::AUDI_A3);
    }
}
