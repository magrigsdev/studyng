<?php

namespace App\Http\Controllers;

use App\Models\Diplomes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class DiplomesController extends Controller
{
    
     //
    public $local_id;

    //getData
    public function getData()
    {
        $table = Schema::hasTable('Diplomes');

        if($table){
            $data = Diplomes::all();
            $count = Diplomes::count();

            if($count > 0){
                return response()->json([
                        'status' => true,
                        'message' => 'success',
                        'data' => $data,
                    ], 200);
            }
            else{
                return response()->json([
                        'status' => false,
                        'message' => 'aucune données trouvée',       
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
        //$tableId = Niveaux::where('id_niv', $this->local_id)->first();
        if (is_string($id)){ $this->local_id = intval($id);} 
        else $this->local_id = $id;

        $table = Schema::hasTable('Diplomes');

            if($table){
                //verifier et retourne
                $tableId = Diplomes::where('id_dip', $this->local_id)->first();            

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

    //create type etablissement
    public function createDiplome(Request $request)
    {
        $request -> validate(["nom" => "required"]);
        $obj = new Diplomes();

        $obj::creerDiplome($request->nom);
    }
}
