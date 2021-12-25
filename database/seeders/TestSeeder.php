<?php

namespace Database\Seeders;

use App\Http\Controllers\StudentController;
use App\Models\Hobby;
use App\Models\Phone;
use App\Models\Location;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Database\Factories\StudentFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestSeeder extends Seeder
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


        // StudentFactory::times(10)
        // ->haslocationRelation(1)
        // ->hasphoneRelation(1)
        // ->hashobbyRelation(3)
        // ->create();

        //     DB::table('students')
        //     ->insert([[
        //         'name' => '张三',
        //         'chinese' => '100',
        //         'english' => '100',
        //         'math' => '100',
        //         'photo' => 'chihiro018.jpg',
        //         'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //         'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     ],[
        //         'name' => '李四',
        //         'chinese' => '100',
        //         'english' => '100',
        //         'math' => '100',
        //         'photo' => 'chihiro018.jpg',
        //         'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //         'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     ],[
        //         'name' => '王二麻子',
        //         'chinese' => '100',
        //         'english' => '100',
        //         'math' => '100',
        //         'photo' => 'chihiro018.jpg',
        //         'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //         'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     ]]);

        // for ($i = 0; $i < 5; $i++) {
        DB::table('students')->insert(
            [
                'name' => Str::random(10),
                'chinese' => rand(50, 100),
                'english' => rand(50, 100),
                'math' => rand(50, 100),
                'photo' => 'chihiro018.jpg',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        );
        $this->call([
            LocationSeeder::class,
            PhoneSeeder::class,
            HobbySeeder::class,
        ]);
        // }
    }
}
