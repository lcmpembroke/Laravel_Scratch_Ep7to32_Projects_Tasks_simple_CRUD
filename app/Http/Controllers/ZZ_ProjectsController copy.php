<?php

namespace App\Http\Controllers;

use \App\Project;

use Illuminate\Http\Request;

// This file is before the "Cleaner Controllers and Mass Assignment Concerns" episode 14...
class ZZ_ProjectsController extends Controller
{
    public function index()
    {
        $projects = Project::all();
    
        return view('projects.index', ['projects' => $projects]);
    }

    public function create()
    {        
        return view('projects.create');
    }

    public function show($projectid)
    {        
        //dd(request()->all(), $projectid);
        $project = Project::findOrFail($projectid);
        return view('projects.show', compact('project'));
    }

    public function store()
    {     
        $project = new Project();
        $project->title = request('title');
        $project->description = request('description');    
        $project->save();    

        return redirect('/projects');
    }


    public function edit($projectid)  
    {        
        // this function responds to....example.com/project/1/edit
        // fetch down the project
        $project = Project::findOrFail($projectid);

        // pass it down to the view
        return view('projects.edit', compact('project'));
    }

    public function update($projectid)
    {  
        // die and dump...for debugging      
       // dd(request()->all());
       $project = Project::findOrFail($projectid);
       $project->title = request('title');
       $project->description = request('description');  
       $project->save();        
       return redirect('/projects');

    }


    public function destroy($projectid)
    {       
        // dd(request()->all(), $projectid);
        Project::findOrFail($projectid)->delete();
        return redirect('/projects');
       
    }


}
