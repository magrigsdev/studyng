<?php

namespace App\Http\Controllers;

use App\Models\Managers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class ManagersController extends Controller
{

    public $local_id;

    //getData
    public function getData()
    {
        $table = Schema::hasTable('Managers');

        if($table){
            $data = Managers::all();
            $count = Managers::count();

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

        $table = Schema::hasTable('Managers');

            if($table){
                //verifier et retourne
                $tableId = Managers::where('id_man', $this->local_id)->first(); 
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
        'addresse'=>'required',
        'photo'=>'required',
        'date_creation'=>'required',
        
        ]);

        if($validator->fails()){
            response()->json([
                'message'=>'données mal saisies',
                'status'=>false,
            ], 422);
        }else{
            $etudiant = Managers::create([
                'nom'=> $request->nom,
                'prenom'=> $request->prenom,
                'email' => $request->email,
                'sexe'=>$request->sexe,
                'addresse' => $request->addresse,
                'photo'=>$request->photo,
                'date_creation'=>$request->date_creation,
            ]);

            if($etudiant){
                return response()->json([
                    'status'=>true,
                    'message'=>'manager enregistré',
                    
                ], 200);
            }
            else{
                return response()->json([
                    'status'=>false,
                    'message'=>"Une erreur s'est produite  ",
                    
                ], 500);
            }

        }
    }

        public function updateItem(Request $request,  $id){
            $validator = Validator::make($request->all(), [

            'nom'=>'required',
            'prenom' =>'required',
            'email'=>'required',
            'sexe'=>'required',
            'addresse'=>'required',
            'photo'=>'required',
            'date_creation'=>'required',

            ]);

        if($validator->fails()){
            response()->json([
                'message'=>'données mal saisies',
                'status'=>false,
            ], 422);
        }else{
            $etudiant = Managers::find($id);

            if($etudiant){
                $etudiant->update([
                'nom'=> $request->nom,
                'prenom'=> $request->prenom,
                'email' => $request->email,
                'sexe'=>$request->sexe,
                'addresse' => $request->addresse,
                'photo'=>$request->photo,
                'date_creation'=>$request->date_creation,
                ]);

                return response()->json([
                    'status'=>true,
                    'message'=>'manager mise à jour'

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

        public function getItemByName($nom){

        $table = Schema::hasTable('Managers');

            if($table){
                //verifier et retourne
                $manager_name = Managers::where('nom', $nom)->first(); 
                //$tableId = Frais::find($this->local_id);

                if($manager_name){
                    return response()->json([
                        'status' => true,
                        'message' => 'success',
                        'data' => $manager_name,
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
