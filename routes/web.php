<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


use Illuminate\Support\Facades\App;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

//Tasks
Route::get('/tasks.index', 'TaskController@index');
Route::get('/tasks.my', 'TaskController@showMyTasks');
Route::get('/index.change_language', 'TaskController@change_language');

Route::post('/tasks.store', 'TaskController@store');
Route::post('/tasks.accept', 'TaskController@accept_task');

//Admin
Route::get('/admin.index', 'AdminController@index');
Route::post('/admin.change_role', 'AdminController@change_role');

//User
Route::get('/user.index', 'UserController@index');
Route::get('/user.all_tasks', 'UserController@all_tasks');

Route::post('user.apply', 'UserController@apply');
Route::post('user.change_priority', 'UserController@change_priority');

Route::get('change/{lang}', function($lang){
    switch ($lang) {
        case 'en':
            App::setLocale('hr');
            break;

        case 'hr':
            App::setLocale('en');
            break;

        default:
            App::setLocale('hr');
            break;
    }
    return redirect('/tasks.index');
});



























