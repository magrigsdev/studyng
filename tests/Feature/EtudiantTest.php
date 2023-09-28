<?php

namespace Tests\Feature;


use Tests\TestCase;
use App\Models\Etudiants;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\WithFaker;

use App\Http\Controllers\EtudiantsController;
use Illuminate\Foundation\Testing\RefreshDatabase;


class EtudiantTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
        public function test_etudiant_update()
        {
        //     $post = Etudiants::create([
        //         'nom'=>'kouilou',
        //         'prenom'=>'loic',
        //         'sexe'=>'m',
        //         'email'=>'loic@gmail.com',
        //         'date_naissance'=>'2000_09_30',
        //         'photo'=>'./elian/image.jpg',
        //         'date_inscription'=>'2000_09_10',
        //         'id_man'=>2
        //     ]);
        // $this->assertEquals(0, Etudiants::all());

        
        //$etu->updateItem($req, $id);
        }

       


 }
 //$tableId = Etudiants::where('id_etu', $this->local_id)->first();
