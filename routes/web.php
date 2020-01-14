<?php

use Illuminate\Filesystem\Filesystem;
use App\Services\Twitter;
//use App\Repositories\UserRepository;


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
// with a single line of code...i.e.shortcut to do all of the below...!
//Route::resource('projects', 'ProjectsController');

Route::resource('projects', 'ProjectsController')->middleware('can:update,project');

Route::post('/projects/{project}/tasks', 'ProjectTasksController@store');

// Removed as now using CompletedTasksController
//Route::patch('/tasks/{task}', 'ProjectTasksController@update');

Route::post('completed-tasks/{task}','CompletedTasksController@store');
Route::delete('completed-tasks/{task}','CompletedTasksController@destroy');


// php artisan route:list will review all registered routes for this application
//
// Route::get('/projects', 'ProjectsController@index');
// Route::get('/projects/create', 'ProjectsController@create');
// Route::get('/projects/{project}', 'ProjectsController@show');
// Route::post('/projects', 'ProjectsController@store');
// Route::get('/projects/{project}/edit', 'ProjectsController@edit');
// Route::patch('/projects/{project}', 'ProjectsController@update');
// Route::delete('/projects/{project}', 'ProjectsController@destroy');


// Can generate the boilerplate controller code too using
// $ php artisan make:controller PostsController -r
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
