<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Managers extends Model
{
    use HasFactory;
    protected $table = 'Managers';

    public function etudiants()
    {
        return $this->hasMany(Etudiants::class);
    }

    public function etablissements()
    {
        return $this->hasMany(Etablissements::class);
    }

    

}
