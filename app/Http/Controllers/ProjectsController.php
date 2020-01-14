<?php

namespace App\Http\Controllers;

use App\Mail\ProjectCreated;
use \App\Project;
use Illuminate\Filesystem\Filesystem;

use Illuminate\Http\Request;
use Laravel\Tinker\Console\TinkerCommand;
use SebastianBergmann\Environment\Console;

class ProjectsController extends Controller
{
    public function __construct()
    {
        //dd(request()->user());
        $this->middleware('auth');
    }
    

    public function index()
    {

        // $projects = auth()->user()->projects;
        // return view('projects.index', compact('projects'));

        // alternative way to write the above...easier on the eye
        return view('projects.index', [
            'projects' => auth()->user()->projects
        ]);



        //$projects = Project::all();
        //$projects = Project::where('owner_id', auth()->id())->take(1)->get();
        
        // simplify below to "give me the current user's projects
        // $projects = Project::where('owner_id', auth()->id())->get();
        // something like....$user->$projects;
        // $projects = auth()->user()->projects;

        // ***************************
        // section here is to demontrate cache view in Telescope dev tool
        // cache()->rememberForever('stats', function () {
        //     // can do a database query here...we just return an array for now
        //     return ['lessons' => 1300, 'hours' => 50000, 'series' => 100];
        // });
        
        
        // $stats = cache()->get('stats');
        //@dump($stats);
        //dump($stats);
        //
        // ***************************

        // return $projects; this gives JSON in the browser
        //dump($projects);
        //@dump($projects);

        // return view('projects.index', compact('projects'));
    }

    public function create()
    {        
        return view('projects.create');
    }

    public function show(Project $project)
    {    
        // lots of ways to check authorisation....    
        // abort_unless(auth()->user()->owns($project),403);
        // abort_if(! auth()->user()->owns($project),403);
        // abort_if($project->owner_id !== auth()->id(), 403);
        // abort_if(\Gate::denies('update', $project),403);
        // abort_unless(\Gate::allows('update', $project),403);  
        // auth()->user()->can('update', $project);

        //dd($project);

        $this->authorize('view', $project);
        
   
        return view('projects.show', compact('project'));
    }


    public function store()
    {   
        //error_log(auth()->id());
        $attributes = $this->validateProject();
        $attributes['owner_id'] = auth()->id();
        
        $project = Project::create($attributes);


        // NOTE NEED TO USE A queue FOR SENDING EMAIL...BUT LEARNING LATER...
        \Mail::to($project->owner->email)->send(
            new ProjectCreated($project)
        );


        return redirect('/projects');
    }


    public function edit(Project $project)
    {        
        return view('projects.edit', compact('project'));
    }

    public function update(Project $project)
    {  
        $this->authorize('update', $project);
        $project->update($this->validateProject());   
        return redirect('/projects');
    }


    public function destroy(Project $project)
    {     
        $this->authorize('delete', $project);  
        $project->delete();
        return redirect('/projects');
       
    }

    protected function validateProject()
    {
        return request()->validate([
            'title' => ['required','min:3', 'max:255'],
            'description' => ['required','min:3'] 
        ]);
    }

}
