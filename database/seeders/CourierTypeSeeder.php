<?php

namespace Database\Seeders;

use App\Models\CourierType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourierTypeSeeder extends Seeder
{
    public function run(): void
    {
        $courierTypes = collect([
            'bike',
            'foot',
            'car',
        ]);

        $courierTypes->each(function(string $courierType) {
            CourierType::create([
                'name' => $courierType,
            ]);
        });
    }
}
