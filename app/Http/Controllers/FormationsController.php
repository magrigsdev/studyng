<?php

namespace App\Http\Controllers;

use App\Models\Formations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class FormationsController extends Controller
{
    //
    
    public $local_id;

    //getData
    public function getData()
    {
        $table = Schema::hasTable('Formations');

        if($table){
            $data = Formations::all();
            $count = Formations::count();

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
        //$tableId = Diplomes::where('id_dip', $this->local_id)->first(); 

        $table = Schema::hasTable('Formations');

            if($table){

                //verifier et retourne
                $tableId = Formations::where('id', $this->local_id)->first(); 

                if($tableId){
                    $name = $tableId->nom;
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
