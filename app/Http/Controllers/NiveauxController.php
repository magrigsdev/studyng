<?php

namespace App\Http\Controllers;

use App\Models\Niveaux;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

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
                //$tableId = Niveaux::where('id_niv', $this->local_id)->first();
                $tableId = Niveaux::find($this->local_id)->first();

                //verifier et retourne

                if($tableId){
                     $name = $tableId->nom;
                    return response()->json([
                        'status' => true,
                        'message' => 'success',
                        'data' => $name,
                        'temp' => $tableId->count()
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

    //create type etablissement
        public function createItem(Request $request){

        $validator = Validator::make($request->all(), [
        'nom'=>'required',
        ]);

        if($validator->fails()){
            response()->json([
                'message'=>'données mal saisies',
                'status'=>false,
            ], 422);
        }else{
            $etudiant = Niveaux::create([
                'nom'=> $request->nom,
            ]);

            if($etudiant){
                return response()->json([
                    'status'=>true,
                    'message'=>'information enregistré',
                ], 200);
            }
            else{
                return response()->json([
                    'status'=>false,
                    'message'=>"Une erreur s'est produite ",
                    
                ], 200);
            }

        }
    }

}
