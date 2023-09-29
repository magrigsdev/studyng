<?php

namespace App\Http\Controllers;

use App\Models\Etablissements;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class EtablissementsController extends Controller
{
    //
        public $local_id;

    //getData
    public function getData()
    {
        $table = Schema::hasTable('Etablissements');

        if($table){
            $data = Etablissements::all();
            $count = Etablissements::count();

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
