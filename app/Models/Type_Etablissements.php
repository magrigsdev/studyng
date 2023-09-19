<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_Etablissements extends Model
{
    use HasFactory;
    protected $table = 'Type_Etablissements'; 

    public function etablissements()
    {
        return $this->hasMany(Etablissements::class);
    }
}
