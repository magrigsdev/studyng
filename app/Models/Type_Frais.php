<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_Frais extends Model
{
    use HasFactory;
    protected $table = 'Type_Frais';
    
    public function frais()
    {
        return $this->belongsTo(Frais::class);
    }
}
