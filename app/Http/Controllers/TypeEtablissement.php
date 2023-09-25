<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type_Etablissements;
use Illuminate\Support\Facades\Schema;


class TypeEtablissement extends Controller
{
    public $local_id;

    //getData
    public function getData()
    {
        $table = Schema::hasTable('Type_Etablissements');

        if($table){
            $data = Type_Etablissements::all();
            $count = Type_Etablissements::count();

            if($count>0){
                return response()->json([
                        'status' => true,
                        'message' => 'success',
                        'data' => $data,
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

        $table = Schema::hasTable('Type_Etablissements');

           if($table){
                //verifier et retourne
                //$tableId = Type_Etablissements::find($this->local_id);

                $tableId = Type_Etablissements::where('id_typ_eta', $this->local_id)->first();
          
                if($tableId){
                    $nom = $tableId->nom;
                    return response()->json([
                        'status' => true,
                        'message' => 'success',
                        'data' => $nom,
                        
                       
                    ], 200);
                }

                else{
                    return response()->json([
                        'status' => false,
                        'message' => 'Aucune donnée trouvée',
                        
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
    public function createTypeEtab(Request $request)
    {
        $request -> validate(["nom" => "required"]);
        $obj = new Type_Etablissements();

        $obj::creerTypeEtablissement($request->nom);
    }

} 
