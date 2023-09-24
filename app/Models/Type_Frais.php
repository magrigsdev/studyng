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

    public static function creerTypeFrais($intituler)
    {
        $obj = new self;
        $obj->intituler = $intituler;
        $obj->save();
    }
}
