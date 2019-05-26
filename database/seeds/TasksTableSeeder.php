<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Provider\hr_HR\Person;
use Faker\Generator;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $creatorId = 1;
        for($i = 0; $i < 20; $i++)
        {
            if($i % 5 == 0 && $i != 0)
            {
                $creatorId++;
            }
            DB::table('tasks')->insert([
                'name' =>str_random(10),
                'name_english' => str_random(10),
                'description' => str_random(50),
                'type' => 'Stručni',
                'creator_id' => $creatorId,
            ]);
        }
    }
}
