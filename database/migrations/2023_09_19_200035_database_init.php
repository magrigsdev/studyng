<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DatabaseInit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         // etape 1
           Schema::create('Managers', function (Blueprint $table) {
            $table->id('id');
            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->unique();
            $table->string('sexe');
            $table->text('addresse');
            $table->date('date_creation');
            $table->timestamps();
            
        });

            Schema::create('Etudiants', function (Blueprint $table) {
            $table->id('id');
            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->unique();
            $table->string('sexe');
            $table->date('date_naissance');
            $table->string('photo');
            $table->date('date_inscription');
            
            $table->unsignedBigInteger('id_man');
            $table->foreign('id_man')->references('id')->on('Managers');
            $table->timestamps();
            
        });
        
        // etape 2

            Schema::create('Type_Frais', function (Blueprint $table) {
            $table->id('id');
            $table->string('intituler');  
            $table->timestamps();                    
        });

            Schema::create('Type_Etablissements', function (Blueprint $table) {
            $table->id('id');
            $table->string('nom');
            $table->timestamps();                      
        });

            Schema::create('Formations', function (Blueprint $table) {
            $table->id('id');
            $table->string('nom');
            $table->timestamps();                      
        });

            Schema::create('Niveaux', function (Blueprint $table) {
            $table->id('id');
            $table->string('nom');
            $table->timestamps(); 
                                 
        });

            Schema::create('Diplomes', function (Blueprint $table) {
            $table->id('id');
            $table->string('nom');
            $table->timestamps();                      
        });

            Schema::create('Frais', function (Blueprint $table) {
            $table->id('id');
            $table->string('intituler');
            $table->date('date');
            $table->timestamps();

            $table->unsignedBigInteger('id_etu');
            $table->foreign('id_etu')->references('id')->on('Etudiants');

            $table->unsignedBigInteger('id_tf');
            $table->foreign('id_tf')->references('id')->on('Type_Frais');
             
        });

         Schema::create('Etablissements', function (Blueprint $table) {
            $table->id('id');
            $table->string('intituler');
            $table->string('nom');
            $table->date('date');
            $table->timestamps();

            $table->unsignedBigInteger('id_etu');
            $table->foreign('id_etu')->references('id')->on('Etudiants');

            $table->unsignedBigInteger('id_man');
            $table->foreign('id_man')->references('id')->on('Managers');

            $table->unsignedBigInteger('id_for');
            $table->foreign('id_for')->references('id')->on('Formations');

            $table->unsignedBigInteger('id_tye');
            $table->foreign('id_tye')->references('id')->on('Type_Etablissements');

            $table->unsignedBigInteger('id_dip');
            $table->foreign('id_dip')->references('id')->on('Diplomes');

            $table->unsignedBigInteger('id_niv');
            $table->foreign('id_niv')->references('id')->on('Niveaux');
             
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
         Schema::dropIfExists('Managers');
         Schema::dropIfExists('Etudiants');
         Schema::dropIfExists('Type_Frais');
         Schema::dropIfExists('Type_Etablissements');
         Schema::dropIfExists('Formations');

         Schema::dropIfExists('Niveaux');
         Schema::dropIfExists('Diplomes');
         Schema::dropIfExists('Frais');
         Schema::dropIfExists('Etablissements');
    }
}
