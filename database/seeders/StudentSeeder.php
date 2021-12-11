<?php

namespace Database\Seeders;

use App\Models\Hobby;
use App\Models\Location;
use App\Models\Phone;
use App\Models\Student;
use Database\Factories\LocationFactory;
use Database\Factories\StudentFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Location as ReflectionLocation;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //seeder
        // DB::table('students')->truncate();
        
        Student::unguard();
        Location::unguard();
        Phone::unguard();
        Hobby::unguard();
        StudentFactory::times(300)
        ->haslocationRelation(1)
        ->hasphoneRelation(1)
        ->hashobbyRelation(3)
        ->create();
        Student::reguard();
        Location::reguard();
        Phone::reguard();
        Hobby::reguard();
    }
}
