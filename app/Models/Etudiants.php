<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiants extends Model
{
    use HasFactory;
    protected $table = 'Etudiants';

    public function managers()
    {
        return $this->belongsTo(Managers::class);
    }

    public function frais()
    {
        return $this->hasMany(Frais::class);
    }

    public function etablissements()
    {
        return $this->hasMany(Etablissements::class);
    }

}
