<?php

namespace App\Http\Controllers;

use App\Models\Diplomes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

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
                $tableId = Diplomes::find($this->local_id);
                //dd($tableId);            

                if($tableId != null){
                    $tableId = Diplomes::find($this->local_id)->first();
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
            $etudiant = Diplomes::create([
                'nom'=> $request->nom,
            ]);

            if($etudiant){
                return response()->json([
                    'status'=>true,
                    'message'=>'donnée enregistrée',
                    
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
