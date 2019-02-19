<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Task;

class ProjectTasksController extends Controller
{
 
    
    
    public function store(Project $project)
    {
        $desc = request()->validate([
            'description' => 'required'
        ]);
        
        $project->addTask($desc);
        
        return back();
    }
}
