<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function tasks()
    {
        return $this->belongsToMany('App\Task');
    }

    public function accepted_task()
    {
        $user_id = $this->id;
        DB::table('task_user')
            ->where('user_id', $user_id)
            ->where('accepted', 1)
            ->first();

        return $this->hasOne('App\Task');
    }

    public function my_tasks($id)
    {
        $tasks = DB::table('tasks')
            ->where('creator_id', $id)->get();

        foreach($tasks as $task)
        {
            $task_user = DB::table('task_user')
                ->where('task_id', $task->id)->get();

            if($task->taken == 1)
            {
                $task->students = DB::table('users')
                    ->where('accepted_id', $task->id)->get()->first();
            }
            else
            {
                $task->students = new Collection();

                foreach ($task_user as $item)
                {
                    $user = DB::table('users')
                        ->where('id', $item->user_id)->get()->first();
                    $_user = new User();

                    $_user->priority = $item->priority;
                    $_user->id = $user->id;
                    $_user->name = $user->name;

                    $task->students->push($_user);
                }
            }


        }
        return $tasks;
    }

    public function applied_students($id)
    {
        $students = DB::table('task_user')
            ->where('task_id', $id)->get();

        return $students;
    }


}
