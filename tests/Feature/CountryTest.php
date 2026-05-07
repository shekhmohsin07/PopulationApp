<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Country;

class CountryTest extends TestCase
{
    use RefreshDatabase;

    public function test_azerbaijan_exists_in_database()
    {
        
        Country::create([
            'country' => 'Azerbaijan',
            'population' => 10397513
        ]);

        
        $this->assertDatabaseHas('countries', [
            'country' => 'Azerbaijan',
        ]);
    }
}
