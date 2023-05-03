<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasEvents;

class Fonctions extends Model
{
    use HasFactory,HasEvents;
    protected $fillable = [
        'nom',
        'service_id'
    ];


    public function applications (){
        return $this->belongsToMany(application::class, 'application_fonction','fonction_id','application_id');
    }

    public function users (){
        return $this->hasMany(User::class);
    }
    public function service (){
        return $this->belongsTo(Service::class);
    }

    public function actions()
    {
        return $this->belongsToMany(Action::class, 'fonction_actions', 'fonction_id', 'action_id');
            
    }

    public function applicationActions()
    {
        return $this->hasManyThrough(Action::class, application::class)
            ->join('application_fonction', 'application_fonction.application_id', '=', 'applications.id')
            ->where('application_fonction.fonction_id', $this->id);
    }

    public function addAction(Action $actions)
    {
        $this->actions()->syncWithoutDetaching($actions);
        //$actions = $this->actions()->pluck('id')->toArray();
        //$this->users()->syncWithoutDetaching($actions);
    }


    public function addApplication(application $application)
    {
        
      
            $this->applications()->syncWithoutDetaching($application->id);
            $applications = $this->applications()->pluck('id')->toArray();
            $this->users()->syncWithoutDetaching($applications);
    
        
    }
    

    public static function boot() 
    {
        parent::boot();
    
        static::saved(function ($fonction) {
            $users = $fonction->users;
            foreach($users as $user) {
                $user->applications()->sync($fonction->applications);
            }
        });
    
        static::deleted(function ($fonction) {
            $users = $fonction->users;
            foreach($users as $user) {
                $user->applications()->detach($fonction->applications);

            }
        });
    }

    
}
