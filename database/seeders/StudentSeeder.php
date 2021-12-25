<?php

namespace Database\Seeders;

use App\Models\Hobby;
use App\Models\Location;
use App\Models\Phone;
use App\Models\Student;
use Database\Factories\StudentFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //清空
        DB::table('students')->truncate();
        DB::table('phones')->truncate();
        DB::table('locations')->truncate();
        DB::table('hobbies')->truncate();
        
        // Student::unguard();
        // Location::unguard();
        // Phone::unguard();
        // Hobby::unguard();

        // StudentFactory::times(50)
        // ->haslocationRelation(1)
        // ->hasphoneRelation(1)
        // ->hashobbyRelation(3)
        // ->create();

        for($i=1; $i<=500; $i++){
            StudentFactory::times(1)
            ->haslocationRelation(1)
            ->hasphoneRelation(1)
            ->hashobbyRelation(rand(1,3))
            ->create();
        }
        // Student::reguard();
        // Location::reguard();
        // Phone::reguard();
        // Hobby::reguard();
    }
}
