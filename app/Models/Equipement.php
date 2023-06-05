<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipement extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom'
    ];


    public function users (){
        return $this->belongsToMany(User::class);
    }
    public function pole(){
        return $this->belongsTo(Pole::class);
    }
}


