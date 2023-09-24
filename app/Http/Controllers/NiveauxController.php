<?php

namespace App\Http\Controllers;

use App\Models\Niveaux;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class NiveauxController extends Controller
{
    //
    public $local_id;

    //getData
    public function getData()
    {
        $table = Schema::hasTable('Niveaux');

        if($table){
            $data = Niveaux::all();
            $count = Niveaux::count();

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

        $table = Schema::hasTable('Niveaux');

            if($table){
                //verifier et retourne
                $tableId = Niveaux::find($this->local_id);
                $name = $tableId->name;

                if($tableId){
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
    public function createTypeEtab(Request $request)
    {
        $request -> validate(["nom" => "required"]);
        $obj = new Niveaux();

        $obj::creerTypeNiveau($request->nom);
    }
}
