<?php

namespace App\Http\Controllers;

use App\Models\Etudiants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class EtudiantsController extends Controller
{
     //
    public $local_id;

    //getData or getItems
    public function getData()
    {
        $table = Schema::hasTable('Etudiants');

        if($table){
            $data = Etudiants::all();
            $count = Etudiants::count();

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

        $table = Schema::hasTable('Etudiants');

            if($table){
                //verifier et retourne
                $tableId = Etudiants::where('id_etu', $this->local_id)->first(); 
                //$tableId = Frais::find($this->local_id);
                

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

    //create item
    public function createItem(Request $request){

        $validator = Validator::make($request->all(), [

        'nom'=>'required',
        'prenom' =>'required',
        'email'=>'required',
        'sexe'=>'required',
        'date_naissance'=>'required',
        'photo'=>'required',
        'date_inscription'=>'required',
        'id_man'=>'required',

        ]);

        if($validator->fails()){
            response()->json([
                'message'=>'données mal saisies',
                'status'=>false,
            ], 422);
        }else{
            $etudiant = Etudiants::create([
                'nom'=> $request->nom,
                'prenom'=> $request->prenom,
                'email' => $request->email,
                'sexe'=>$request->sexe,
                'date_naissance' => $request->date_naissance,
                'photo'=>$request->photo,
                'date_inscription'=>$request->date_inscription,
                'id_man'=>$request->id_man,
            ]);

            if($etudiant){
                return response()->json([
                    'status'=>true,
                    'message'=>'etudiant enregistré',
                    
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

    //update item
    public function updateItem(Request $request,  $id){
        $validator = Validator::make($request->all(), [

        'nom'=>'required',
        'prenom' =>'required',
        'email'=>'required',
        'sexe'=>'required',
        'date_naissance'=>'required',
        'photo'=>'required',
        'date_inscription'=>'required',
        'id_man'=>'required',

        ]);

        if($validator->fails()){
            response()->json([
                'message'=>'données mal saisies',
                'status'=>false,
            ], 422);
        }else{
            $etudiant = Etudiants::where('id_etu', $id);

            if($etudiant){
                $etudiant->update([
                'nom'=> $request->nom,
                'prenom'=> $request->prenom,
                'email' => $request->email,
                'sexe'=>$request->sexe,
                'date_naissance' => $request->date_naissance,
                'photo'=>$request->photo,
                'date_inscription'=>$request->date_inscription,
                'id_man'=>$request->id_man,
                ]);

                return response()->json([
                    'status'=>true,
                    'message'=>'etudiant mise à jour'

                ], 200);
            }
            else{
                return response()->json([
                    'status'=>false,
                    'message'=>'aucune information ne correspond à cette etudiant !'

                ], 404);

            }

            
        }
    }
    public  function DateNaisCheck($dateNais){
        $reponse = false;
        $checkdate = strtotime($dateNais);
        ($checkdate !== false && $checkdate < time()) ? $reponse =  true : $reponse =  false;
        

        return $reponse;
    }

}

