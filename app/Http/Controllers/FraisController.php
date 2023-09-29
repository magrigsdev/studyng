<?php

namespace App\Http\Controllers;

use App\Models\Etudiants;
use App\Models\Frais;
use App\Models\Type_Frais;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class FraisController extends Controller
{
    //

    public $local_id;

    //getData
    public function getData()
    {
        $table = Schema::hasTable('Frais');

        if($table){
            $all = Frais::all();
            $count = Frais::count();

            if($count>0){

                foreach ($all as  $item){
                    $row_frais = Frais::find($item->id);
                    $etudiant = Etudiants::find($row_frais->id_etu);
                    $type_frais = Type_Frais::find($row_frais->id_tf);

                    $frais = [
                        'id'=>$item->id,
                        'intituler' =>$item->intituler,
                        'date'=> $this->FixedDate($item->date),
                        'id_etu'=>$etudiant->nom,
                        'id_tf'=>$type_frais->intituler,
                    ];

                    $frais_all[] = $frais;
                }

                return response()->json([
                        'status' => true,
                        'message' => 'success',
                        'data' => $frais_all,
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
    public function getItem($id)
    {
        
        //convertir  en id 
        if (is_string($id)){ $this->local_id = intval($id);} 
        else $this->local_id = $id;

        $table = Schema::hasTable('Frais');

            if($table){
                //verifier et retourne
                $tableId = Frais::where('id', $this->local_id)->first(); 
                //$tableId = Frais::find($this->local_id);
                

                if($tableId){
                    $name = $tableId->name;
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

    //create type etablissement
}
