<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Task;
use \App\Project;

class ProjectTasksController extends Controller
{

    public function store(Project $project)
    {  

        $attributes = request()->validate(['description' => 'required|min:5']);
        $project->addTask($attributes);
        return back();
    }

    // Removed update() function 
    // Don't want to update a task within a controller....should be calling a method on the task...so use a CompletedTasksController
    
    // public function update(Task $task)
    // {  
    //     // $task->complete(request()->has('completed'));
    //     // request()->has('completed') ? $task->complete() : $task->incomplete();

    //     $method = request()->has('completed') ? 'complete' : 'incomplete';
    //     $task->$method();

    //     return back();
    // }

}
