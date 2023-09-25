<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diplomes extends Model
{
    use HasFactory;
    protected $table = 'Diplomes'; 

    public function etablissements()
    {
        return $this->hasMany(Etablissements::class);
    }

    public static function creerDiplome($nom){
        $obj = new self;
        $obj->nom = $nom;
        $obj->save();
    }
}
