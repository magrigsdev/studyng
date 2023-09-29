<?php

namespace App\Http\Controllers;

use App\Models\Diplomes;
use App\Models\Type_Etablissements;
use App\Models\Etudiants;
use Illuminate\Http\Request;
use App\Models\Etablissements;
use App\Models\Formations;
use App\Models\Managers;
use App\Models\Niveaux;
use Illuminate\Support\Facades\Schema;
use App\Functions\Myfunctions;

class EtablissementsController extends Controller
{
    //
    use Myfunctions;
        public $local_id;

    //getData
    public function getData()
    {
        $table = Schema::hasTable('Etablissements');

        if($table){
            $all = Etablissements::all();
            $count = Etablissements::count();

            if($count>0){
                foreach ($all as  $item){
                    $row_eta = Etablissements::find($item->id);
                    $etudiant = Etudiants::find($row_eta->id_etu);
                    $manager = Managers::find($row_eta->id_man);
                    $formation = Formations::find($row_eta->id_for);
                    $typetablement = Type_Etablissements::find($row_eta->id_tye);
                    $diplome = Diplomes::find($row_eta->id_dip);
                    $niveau = Niveaux::find($row_eta->id_niv);

                    $etablissement = [
                        'id'=>$item->id,
                        'intituler' =>$item->intituler,
                        'nom' =>$item->nom,
                        'date'=> $this->FixedDate($item->date),
                        'id_etu'=>$etudiant->nom,
                        'manager'=>$manager->nom,
                        'formation'=>$formation->nom,
                        'typetablement'=>$typetablement->nom,
                        'diplome'=>$diplome->nom,
                        'niveau'=>$niveau->nom,
                    ];

                    $etablissements[] = $etablissement;
                }

                return response()->json([
                        'status' => true,
                        'message' => 'success',
                        'data' => $etablissements,
                    ], 200);
            }
            else{
                return response()->json([
                        'status' => false,
                        'message' => 'aucune données',       
                    ], 404);
            }     
        }

        else{
           return response()->json([
                    'status'=>false,
                    'message'=>"la table n'existe pas",    
                ],404); 
        }
    }

    //get item
    public function getItem($id){
        
        //convertir  en id 
        if (is_string($id)){ $this->local_id = intval($id);} 
        else $this->local_id = $id;

        $table = Schema::hasTable('Etablissements');

            if($table){
                //verifier et retourne
                $tableId = Etablissements::where('id', $this->local_id)->first(); 
                //$tableId = Frais::find($this->local_id);

                if($tableId){
                    $name = $tableId->intituler;
                    return response()->json([
                        'status' => true,
                        'message' => 'success',
                        'data' => $name,
                    ], 200);
                }

                else{
                    return response()->json([
                        'status' => false,
                        'message' => 'aucune données',
                    ], 404);

                    }
            }

            else{
                return response()->json([
                    'status'=>false,
                    'message'=>"la table n'existe pas",    
                ],404);

            }

    }

}
