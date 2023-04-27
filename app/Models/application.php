<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class application extends Model
{
    use HasFactory;

    protected $fillable = [

        'nom',
        'description',
         
    ];
    public function users (){
        return $this->belongsToMany(User::class);
    }
    public function fonctions (){
        return $this->belongsToMany(Fonctions::class,'application_fonction','fonction_id','application_id');   
    }
    public function actions() {
        return $this->hasMany(Action::class);
    }
}
