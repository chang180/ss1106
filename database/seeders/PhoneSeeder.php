<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PhoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('phones')->truncate();

        DB::table('phones')
        ->insert([
            'phone' => '0912345678',
        ]);
    }
}
