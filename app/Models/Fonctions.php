<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fonctions extends Model
{
    use HasFactory;
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
}
