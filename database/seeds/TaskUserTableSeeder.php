<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('task_user')->insert([
            'task_id' => 1,
            'user_id' => 10,
            'priority' => 1,
            'accepted' => 0,
        ]);
        DB::table('task_user')->insert([
            'task_id' => 2,
            'user_id' => 10,
            'priority' => 2,
            'accepted' => 0,
        ]);
        DB::table('task_user')->insert([
            'task_id' => 3,
            'user_id' => 10,
            'priority' => 3,
            'accepted' => 0,
        ]);

        DB::table('task_user')->insert([
            'task_id' => 1,
            'user_id' => 11,
            'priority' => 1,
            'accepted' => 0,
        ]);
        DB::table('task_user')->insert([
            'task_id' => 2,
            'user_id' => 11,
            'priority' => 2,
            'accepted' => 0,
        ]);
        DB::table('task_user')->insert([
            'task_id' => 3,
            'user_id' => 11,
            'priority' => 3,
            'accepted' => 0,
        ]);

    }
}
