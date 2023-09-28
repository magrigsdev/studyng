<?php

namespace App\Http\Controllers;

use App\Models\Etudiants;
use App\Models\Managers;
use Illuminate\Database\Capsule\Manager;
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

            $etudiants = [];
            $man_nom = "";

            //$data = Managers::all()->toArray();
            //dd($data);


            if($count>0){
                
                foreach ($data as  $item){
                    $row_etudiant = Etudiants::find($item->id);
                    $managers = Managers::find($row_etudiant->id_man);

                    $etudiant = [
                        'id'=>$item->id,
                        'nom' =>$item->nom,
                        'prenom'=>$item->prenom,
                        'email'=>$item->email,
                        'sexe'=>$item->sexe,
                        'date_naissance'=>$item->date_naissance,
                        'photo'=>$item->photo,
                        'date_inscription'=>$item->date_inscription,
                        'id_man'=>$managers->nom,
                    ];

                    $etudiants[] = $etudiant;
                }

                return response()->json([
                        'status' => true,
                        'message' => 'success',
                        'data' => $etudiants,
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
                $tableId = Etudiants::find($this->local_id); 

                if($tableId){

                    //$name = $tableId->nom;
                    //recuperer le nom du manager
                    $id_man = $tableId->id_man;
                    $tab_man = Managers::find($id_man);
                    //dd($id_man);
                    $man_nom = $tab_man->nom;

                    //le tab
                    $data = [
                        'id'=>$tableId->id,
                        'nom' =>$tableId->nom,
                        'prenom'=>$tableId->prenom,
                        'email'=>$tableId->email,
                        'sexe'=>$tableId->sexe,
                        'date_naissance'=>$tableId->date_naissance,
                        'photo'=>$tableId->photo,
                        'date_inscription'=>$tableId->date_inscription,
                        'id_man'=>$man_nom,
                    ];

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
            $etudiant = Etudiants::find($id);

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
                    'message'=>'aucune information a été trouvée!'

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

