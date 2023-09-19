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
}
