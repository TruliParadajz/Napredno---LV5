<?php
/*
*Powered by PhpStorm
*/
namespace App\Http\Controllers;

use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class TaskController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('teacher');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all();

        foreach($tasks as $task)
        {
            $task->creator = $task->creator();
        }

        return view('tasks.index', ['tasks' => $tasks]);
    }

    public function change_language()
    {
        if (App::getLocale()=='en') {
            App::setLocale('hr');
        }
        else
        {
            App::setLocale('en');
        }

        $tasks = Task::all();

        foreach($tasks as $task)
        {
            $task->creator = $task->creator();
        }

        return view('tasks.index', ['tasks' => $tasks]);
    }

    public function showMyTasks()
    {
        $user_id = Auth::User()->id;
        $user = User::find($user_id);
        $user_tasks = $user->my_tasks($user_id);

        return view('tasks.my', ['tasks' => $user_tasks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Only admin and teacher can create
        $task = new Task();
        $task->name = Input::get('name');
        $task->name_english = Input::get('name_english');
        $task->description = Input::get('description');
        $task->type = Input::get('type');
        $task->creator_id = Input::get('creator_id');
        $task->type = Input::get('type');
        $task->creator_id = Input::get('creator_id');
        $task->save();

        Session::flash('success', 'New Task was successfully created');

        return redirect('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function accept_task()
    {
        $student_id = Input::get('student_id');
        $task_id = Input::get('task_id');

        DB::table('task_user')
            ->where('task_id', $task_id)
            ->update(['accepted' => 1]);

        DB::table('users')
            ->where('id', $student_id)
            ->update(['accepted_id' => $task_id]);

        DB::table('tasks')
            ->where('id', $task_id)
            ->update(['taken' => 1]);

        return redirect('tasks.my');
    }




}
