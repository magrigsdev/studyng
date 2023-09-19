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
            $table->id('id_man');
            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->unique();
            $table->string('sexe');
            $table->text('addresse');
            $table->date('date_creation');
            
        });

            Schema::create('Etudiants', function (Blueprint $table) {
            $table->id('id_etu');
            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->unique();
            $table->string('sexe');
            $table->date('date_naissance');
            $table->string('photo');
            $table->date('date_inscription');
            
            $table->unsignedBigInteger('id_man');
            $table->foreign('id_man')->references('id_man')->on('Managers');
            
        });
        
        // etape 2

            Schema::create('Type_Frais', function (Blueprint $table) {
            $table->id('id_typ_fra');
            $table->string('intituler');                      
        });

            Schema::create('Type_Etablissements', function (Blueprint $table) {
            $table->id('id_typ_eta');
            $table->string('nom');                      
        });

            Schema::create('Formations', function (Blueprint $table) {
            $table->id('id_for');
            $table->string('nom');                      
        });

            Schema::create('Niveaux', function (Blueprint $table) {
            $table->id('id_niv');
            $table->string('nom');                      
        });

            Schema::create('Diplomes', function (Blueprint $table) {
            $table->id('id_dip');
            $table->string('nom');                      
        });

            Schema::create('Frais', function (Blueprint $table) {
            $table->id('id_frais');
            $table->string('intituler');
            $table->date('date');

            $table->unsignedBigInteger('id_etu');
            $table->foreign('id_etu')->references('id_etu')->on('Etudiants');

            $table->unsignedBigInteger('id_typ_fra');
            $table->foreign('id_typ_fra')->references('id_typ_fra')->on('Type_Frais');
             
        });

         Schema::create('Etablissements', function (Blueprint $table) {
            $table->id('id_eta');
            $table->string('intituler');
            $table->string('nom');
            $table->date('date');

            $table->unsignedBigInteger('id_etu');
            $table->foreign('id_etu')->references('id_etu')->on('Etudiants');

            $table->unsignedBigInteger('id_man');
            $table->foreign('id_man')->references('id_man')->on('Managers');

            $table->unsignedBigInteger('id_for');
            $table->foreign('id_for')->references('id_for')->on('Formations');

            $table->unsignedBigInteger('id_typ_eta');
            $table->foreign('id_typ_eta')->references('id_typ_eta')->on('Type_Etablissements');

            $table->unsignedBigInteger('id_dip');
            $table->foreign('id_dip')->references('id_dip')->on('Diplomes');

            $table->unsignedBigInteger('id_niv');
            $table->foreign('id_niv')->references('id_niv')->on('Niveaux');
             
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
