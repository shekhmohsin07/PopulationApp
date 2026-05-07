<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;
use Illuminate\Support\Carbon;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = json_decode(file_get_contents(database_path('data/asia.json')), true);
        
        foreach ($data as $row) {
            Country::create([
                'id' => $row['id'],
                'country' => $row['country'],
                'population' => $row['population'],
                'created_at' => Carbon::parse($row['created_at']),
                'updated_at' => Carbon::parse($row['updated_at']),
            ]);
        }
    }
}
