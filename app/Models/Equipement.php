<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipement extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'description',
        'pole_id'
    ];


    public function users (){
        return $this->belongsToMany(User::class,'user_equipement');
    }
    public function pole(){
        return $this->belongsTo(Pole::class);
    }

    public function storeUser($user)
        {
            $this->users()->attach($user);
        }
    public function removeUser($user)
        {
            $this->users()->detach($user);
        }

}


