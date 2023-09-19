<?php

namespace App\Http\Controllers;

use App\Models\Diplomes;
use App\Models\Niveaux;
use App\Models\Type_Etablissements;
use Illuminate\Http\Request;

class storeController extends Controller
{
    //

   public  $Niveaux = ["première année","deuxième année","troisième année"];
   public  $etablissement = ["public","privée"];
   

    public function storeNiveau()
    {
        // $niveau = new Niveaux;
        // $niveau->nom = "première année";

        foreach ($this->Niveaux as $key => $value) {
            # code...
            $niveau = new Niveaux;
            $niveau->nom = $value;
            $niveau->save();

        }
    }

        public function storeType_etablissement()
    {

        foreach ($this->etablissement as $key => $value) {
            # code...
            $typeEt = new Type_Etablissements();
            $typeEt->nom = $value;
            $typeEt->save();

        }
    }

   
}
