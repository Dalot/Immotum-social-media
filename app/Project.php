<?php

namespace App;

use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;
use App\Events\ProjectCreated;

class Project extends Model
{
    protected $guarded = [];
    
    protected $dispatchesEvents = [
            'created' => ProjectCreated::class
        ];
    
    
 /*   public static function boot()
    {
        parent::boot();
        
        static::created(function($project)
        {
            \Mail::to($project->owner->email)->send(
                new ProjectCreated($project)
            );
        });
    }   */
        
        
    public function owner()
    {
        return $this->belongsTo(User::class);
    }
        
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
    
    public function addTask($desc)
    {
       
        $this->tasks()->create($desc);
    }
    
    
}


