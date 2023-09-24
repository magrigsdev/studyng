<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_Etablissements extends Model
{
    use HasFactory;
    protected $table = 'Type_Etablissements';
    protected $fillable = ['nom'];

    public function etablissements()
    {
        return $this->hasMany(Etablissements::class);
    }

    //type etablissement

    public static function creerTypeEtablissement($nom){
        $obj = new self;
        $obj->nom = $nom;
        $obj->save();
    }

    //etablissement privée et public
   

}
