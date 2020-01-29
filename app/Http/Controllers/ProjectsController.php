<?php

namespace App\Http\Controllers;

use \App\Project;
use App\Mail\ProjectCreated;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use Illuminate\Filesystem\Filesystem;
use Laravel\Tinker\Console\TinkerCommand;
use SebastianBergmann\Environment\Console;

class ProjectsController extends Controller
{
    public function __construct()
    {
        // need to be authenticated (logged in) to deal with any project
        $this->middleware('auth');
    }
    

    public function index(Request $request)
    {  
        $projects = auth()->user()->projects;

        return view('projects.index', compact('projects'));

        // ***************************
        // section here was to demontrate cache view in Telescope dev tool
        // cache()->rememberForever('stats', function () {
        //     // can do a database query here...we just return an array for now
        //     return ['lessons' => 1300, 'hours' => 50000, 'series' => 100];
        // });
        // $stats = cache()->get('stats');
        //@dump($stats);
        //dump($stats);
        // ***************************
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
      
        // can use $this->authorize() because Controller class imports AuthorizesRequests trait - looks at the ProjectPolicy
        $this->authorize('view', $project);
        return view('projects.show', compact('project'));
    }


    public function store()
    {   
        $attributes = $this->validateProject();
        $attributes['owner_id'] = auth()->id();
        
        // NOTE: save to database is handled as part of the create() method
        $project = Project::create($attributes);

        // NOTE: need to user a QUEUE for sending mail...but not covered yet...
        Mail::to($project->owner->email)->send(
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
        //$this->authorize('update', $project);
        $project->update($this->validateProject());   
        return redirect('/projects');
    }


    public function destroy(Project $project)
    {     
        //$this->authorize('delete', $project);  
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
