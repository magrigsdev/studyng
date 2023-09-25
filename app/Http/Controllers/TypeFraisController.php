<?php

namespace App\Http\Controllers;

use App\Models\Type_Frais;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class TypeFraisController extends Controller
{
     //

    public $local_id;

    //getData
    public function getData()
    {
        $table = Schema::hasTable('Type_Frais');

        if($table){
            $data = Type_Frais::all();
            $count = Type_Frais::count();

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

        $table = Schema::hasTable('Type_Frais');

            if($table){
                //verifier et retourne
                //$tableId = Type_Frais::find($this->local_id);
                 $tableId = Type_Frais::where('id_typ_fra', $this->local_id)->first(); 
               

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

    //create type etablissement
    public function createType_Frais(Request $request)
    {
        $request -> validate(["nom" => "required"]);
        $obj = new Type_Frais();

        $obj::creerTypeFrais($request->nom);
    }
}
