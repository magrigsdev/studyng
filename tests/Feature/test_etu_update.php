<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Etudiants;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class test_etu_update extends TestCase
{
    public function test_etu_update(){
        $id = 3;
        $nom ='kouilou';
                $prenom ='loic';
                $sexe ='m';
                $email ='loic@gmail.com';
                $daten ='2000_09_30';
                $photo ='./elian/image.jpg';
                $datein = '2000_09_10';
        $id_man = 2;

        $sql = "update Etudiants
                 set nom =:nom, prenom =:prenom, email =:email, 
                 date_naissance =: daten, photo =:hoto, 
                 date_inscription =:datein, id_man =:id_man 
                 where id_etu =:id";

        DB::update($sql, [
                'nom'=>'kouilouzz',
                'prenom'=>'loic',
                'sexe'=>'m',
                'email'=>'loiczzrr@gmail.com',
                'date_naissance'=>'2000_09_30',
                'photo'=>'./elian/image.jpg',
                'date_inscription'=>'2000_09_10',
                'id_man'=>2


        ]);
        //$this->assertEquals(0, Etudiants::all());

        }
}
