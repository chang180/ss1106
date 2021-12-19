<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class HobbySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('hobbies')->truncate();

        DB::table('hobbies')
        ->insert([
            'hobby' => '玩游戏',
        ]);
    }
}
