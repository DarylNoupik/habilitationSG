<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'matricule',
        'password',
        'phone',
        'location',
        'about_me',
        'role',
        'fonction_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function equipements (){
        return $this->belongsToMany(equipements::class);
    }

    public function fonction(){
        return $this->belongsTo(Fonctions::class);
    }

    public function applications (){
        return $this->belongsToMany(application::class,'application_user');
    }

    public function actions()
    {
        return $this->belongsToMany(Action::class, 'application_user_action', 'user_id', 'action_id')
                    ->withPivot('application_id')
                    ->withTimestamps();
    
    }

    public function addFonctionAction($applicationId,$actionId){
        $this->applications()->attach($applicationId, ['action_id' => $actionId]);
    }
 
    public function addMissingApplications()
    {
        $fonction = $this->fonction;
        if ($fonction) {
            $missingApplications = $fonction->applications()->whereNotIn('id', $this->applications()->pluck('id')->toArray())->get();
            $this->applications()->syncWithoutDetaching($missingApplications);
        }
    }

    public function addApplication($application){
        $this->applications()->syncWithoutDetaching($application->id);
    }

    
}
