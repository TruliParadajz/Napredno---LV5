<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Provider\hr_HR\Person;
use Faker\Generator;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Admin
        DB::table('users')->insert([
            'name' => 'Filip',
            'email' => 'nargz44'.'@gmail.com',
            'password' => 'admin',
            'role' => 3,
        ]);

        $faker = Faker\Factory::create();

        //Teachers    
        for($i = 1; $i < 6; $i++)
        {
            DB::table('users')->insert([
                'name' => $faker->firstName ,
                'email' => $i.'@gmail.com',
                'password' => $i,
                'role' => 2
            ]);
        }

        //Students

        for($i = 6; $i < 17; $i++)
        {
            DB::table('users')->insert([
                'name' => $faker->firstName ,
                'email' => $i.'@gmail.com',
                'password' => $i,
                'role' => 1
            ]);
        }
    }
}
