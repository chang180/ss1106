<?php

namespace Database\Seeders;

use Database\Factories\CarFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //清空
        DB::table('cars')->truncate();

        CarFactory::times(50)->create();
    }
}
