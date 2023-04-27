<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'nom',
        'description',
        'application_id'
    ];

    public function fonctions (){
        return $this->belongsToMany(Fonctions::class);
    }
    public function application() {
        return $this->belongsTo(application::class);
    }
}
