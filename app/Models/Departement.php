<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'direction_id'
    ];

    public function services (){
        return $this->hasMany(Service::class);
    }

    public function direction (){
        return $this->belongsTo(Direction::class);
    }

}
