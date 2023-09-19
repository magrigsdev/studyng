<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etablissements extends Model
{
    use HasFactory;
     protected $table = 'Etablissements'; 

    public function etudiants()
    {
        return $this->belongsTo(Etudiants::class);
    }
    public function diplomes()
    {
        return $this->belongsTo(Diplomes::class);
    }

    public function formations()
    {
        return $this->belongsTo(Formations::class);
    }
    
    public function niveaux()
    {
        return $this->belongsTo(Niveaux::class);
    }
    public function managers()
    {
        return $this->belongsTo(Managers::class);
    }
    public function type_etablissements()
    {
        return $this->belongsTo(Type_Etablissements::class);
    }

    
}
