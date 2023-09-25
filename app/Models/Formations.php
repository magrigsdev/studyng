<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formations extends Model
{
    use HasFactory;
    protected $table = 'Formations';
     public function etablissements()
    {
        return $this->hasMany(Etablissements::class);
    }

    public static function creerFormations($nom)
    {
        $obj = new self;
        $obj->nom = $nom;
        $obj->save();
    }
}
