<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Niveaux extends Model
{
    use HasFactory;

    
    protected $table = 'Niveaux'; 

    public function etablissements()
    {
        return $this->hasMany(Etablissements::class);
    }
}
