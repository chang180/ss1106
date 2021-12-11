<?php

namespace Database\Seeders;

use Database\Factories\LocationFactory;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LocationFactory::times(10)->create();
    }
}
