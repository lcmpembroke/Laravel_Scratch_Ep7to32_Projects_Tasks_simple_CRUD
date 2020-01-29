<?php

use Illuminate\Filesystem\Filesystem;
use App\Services\Twitter;


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

Route::get('/', function (Twitter $twitter) {
    //dd($twitter);
    //return view('welcome');
    return redirect('/projects');
});

// Laravel resource routing assigns the typical "CRUD" routes to a controller 
//Note that in middleware, 'project' corresponds to the route parameter (see using php artisan route:list...in the curly braces)
Route::resource('projects', 'ProjectsController')->middleware('can:create,App\Project');

Route::post('/projects/{project}/tasks', 'ProjectTasksController@store');

// Removed    Route::patch('/tasks/{task}', 'ProjectTasksController@update');    as now using CompletedTasksController:
Route::post('completed-tasks/{task}','CompletedTasksController@store');
Route::delete('completed-tasks/{task}','CompletedTasksController@destroy');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::fallback(function () {
    return view('errors.404');
});
