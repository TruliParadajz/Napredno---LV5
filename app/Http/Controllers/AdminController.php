<?php
/*
*Powered by PhpStorm
*/
namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $users = User::all();

        return view('admin.index', ['users' => $users]);
    }

    public function change_role()
    {
        $user_id = Input::get('user_id');
        $role = Input::get('role');

        DB::table('users')
            ->where('id', $user_id)
            ->update(['role' => $role]);

        Session::flash('success', 'Successfully changed');

        return redirect('admin.index');
    }

}
