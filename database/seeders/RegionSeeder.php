<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    public function run(): void
    {
        $regionNames = collect([
            'region_1',
            'region_2',
            'region_3',
        ]);

        $regionNames->each(function(string $regionName) {
            Region::create([
                'name' => $regionName,
            ]);
        });
    }
}
