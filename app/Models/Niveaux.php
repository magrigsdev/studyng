<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Niveaux extends Model
{
    use HasFactory;

    
    protected $table = 'Niveaux'; 
        protected $fillable = [
        'nom',     
    ];

    public function etablissements()
    {
        return $this->hasMany(Etablissements::class);
    }


    public static function creerTypeNiveau($nom){
        $obj = new self;
        $obj->nom = $nom;
        $obj->save();
    }
}
