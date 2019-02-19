<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;



class ProjectsController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $projects = auth()->user()->projects;
        // $projects = Project::where('owner_id', auth()->id())->get();
        
        return view('projects.projects', [
            'projects' => $projects
        ]);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
    {   
        return view('projects.create');
    }
    
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        
        $attributes = request()->validate([
            'title' => ['required','min:3', 'max:255'],
            'description' => 'required'
            ]);
            
            
        $attributes['owner_id'] = auth()->id();
        
        
        
        $project = Project::create( $attributes );
        session()->flash('message','Your Project has been created');
        
        return redirect("/projects");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        
        $this->authorize('update', $project);
        
        return view('projects.project', compact('project'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {   
        $this->authorize('update', $project);
        
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {   
        $this->authorize('update', $project);
        
         $attributes = request()->validate([
            'title' => ['required','min:3', 'max:40'],
            'description' => ['required','min:3', 'max:255']
            ]);
        
        $project->update($attributes);
        
        
        return redirect('/projects');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $this->authorize('update', $project);
        
        $project->delete();

        return redirect('/projects');
    }
}
