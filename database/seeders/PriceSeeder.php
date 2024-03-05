<?php

namespace Database\Seeders;

use App\Models\Price;
use Database\Factories\PriceFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Price::Factory()->times(25)->create();
    }
}
