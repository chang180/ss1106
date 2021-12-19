<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
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
        DB::table('locations')->truncate();

        // DB::table('locations')
        // ->insert([
        //     'name' => '台北市',
        // ]);

        LocationFactory::times(3)->create();
    }
}
