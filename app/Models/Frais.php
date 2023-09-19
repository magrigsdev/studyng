<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frais extends Model
{
    use HasFactory;

    public function etudiants()
    {
        return $this->belongsTo(Etudiants::class);
    }

    public function type_frais()
    {
        return $this->belongsTo(Type_frais::class);
    }
}
