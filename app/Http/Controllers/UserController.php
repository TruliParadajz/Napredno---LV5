<?php
/*
*Powered by PhpStorm
*/
namespace App\Http\Controllers;

use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);

        if($user->accepted_id != null)
        {
            $tasks = DB::table('tasks')
                ->where('id', $user->accepted_id)->get();

            $tasks->format = 1;
        }

        else
        {
            $tasks = DB::table('task_user')
                ->where('user_id', $user_id)->get();
            $tasks->format = 2;

            foreach($tasks as $task)
            {
                $task->info = DB::table('tasks')
                    ->where('id', $task->task_id)
                    ->get()
                    ->first();

                $temp = Task::find($task->id);
                $task->info->creator = $temp->creator();

                $task->info->priority = DB::table('task_user')
                    ->where('user_id', $user_id)
                    ->where('task_id', $tasks[0]->id)
                    ->get()
                    ->first();
            }
        }



        if($tasks->format == 1)
        {
            foreach($tasks as $task)
            {
                $temp = Task::find($task->id);
                $task->creator = $temp->creator();

                $task->priority = DB::table('task_user')
                    ->where('user_id', $user_id)
                    ->where('task_id', $tasks[0]->id)
                    ->get()
                    ->first();
            }
        }

        return view('user.index', ['tasks' => $tasks]);
    }

    public function all_tasks()
    {
        $user_id = Auth::User()->id;
        $tasks = Task::all()->where('taken', 0);
        //$tasks_applied = DB::table('task_user')->where('user_id', $user_id)->get();
        //
        $tasks_applied = Task::where('user_id', '=', $user_id)->get();

        $fHas = false;
        foreach($tasks as $key => $task)
        {
            foreach($tasks_applied as $item)
            {
                if($task->id == $item->task_id)
                    $fHas = true;
            }
            if($fHas){
                unset($tasks[$key]);
            }
            $fHas = false;
        }


        foreach($tasks as $task)
        {

            $task->creator = $task->creator();
        }


        return view('user.all_tasks', ['tasks' => $tasks]);
    }

    public function apply()
    {
        $user_id = Auth::User()->id;
        $task_id = Input::get('task_id');
        $priority = Input::get('priority');

        DB::table('task_user')
            ->insert(
                ['user_id' => $user_id, 'task_id' => $task_id, 'priority' => $priority]
            );

        return redirect('user.all_tasks');
    }

    public function change_priority()
    {
        $task_id = Input::get('task_id');
        $priority = Input::get('priority');

        DB::table('task_user')
            ->where('id', $task_id)
            ->update(['priority' => $priority]);

        return redirect('user.index');
    }

}
