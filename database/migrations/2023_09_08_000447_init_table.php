<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
            Schema::create('Managers', function (Blueprint $table) {
            $table->id('id_man');
            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->unique();
            $table->string('sexe');
            $table->text('addresse');
            
        });

        //
            Schema::create('Etudiants', function (Blueprint $table) {
            $table->id('id_etud');
            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->unique();
            $table->string('sexe');
            $table->date('date_naissance');
            $table->string('photo');
            $table->date('date_inscription');
            
            
        });

         //
            Schema::create('Documents', function (Blueprint $table) {
            $table->id('id_doc');
            $table->string('lycee');
            $table->string('universite');
            $table->string('master');
            $table->string('baccalaureat');
            $table->string('bts');
            $table->string('licence');
            $table->string('autre');
            
   
        });

        //
            Schema::create('Services', function (Blueprint $table) {
            $table->id('id_serv');
            $table->string('intituler');
            $table->date('date_debut');
            $table->date('date_cloture');   
   
        });

            Schema::create('Etablissements', function (Blueprint $table) {
            $table->id('id_etab');
            $table->string('intituler');
             
   
        });

            Schema::create('Frais', function (Blueprint $table) {
            $table->id('id_frais');
            $table->string('intituler');
            $table->date('date');
             
        });

        //les relations ...
        Schema::create('SeConnecter', function (Blueprint $table) {
            $table->unsignedBigInteger('id_users');
            $table->unsignedBigInteger('id_man');
            $table->string('status');

            $table->foreign('id_users')->references('id_users')->on('Users');
            $table->foreign('id_man')->references('id_man')->on('Managers');
             
        });

        Schema::create('Consulter', function (Blueprint $table) {
            $table->unsignedBigInteger('id_doc');
            $table->unsignedBigInteger('id_man');
            $table->date('date');
            $table->string('intituler');

            $table->foreign('id_doc')->references('id_doc')->on('Documents');
            $table->foreign('id_man')->references('id_man')->on('Managers');
             
        });

            Schema::create('Voir', function (Blueprint $table) {
            $table->unsignedBigInteger('id_etud');
            $table->unsignedBigInteger('id_man');
            $table->date('date');
            $table->string('intituler');

            $table->foreign('id_etud')->references('id_etud')->on('Etudiants');
            $table->foreign('id_man')->references('id_man')->on('Managers');
             
        });

            Schema::create('Deposer', function (Blueprint $table) {
            $table->unsignedBigInteger('id_doc');
            $table->unsignedBigInteger('id_etud');
            $table->date('date_depot');
            $table->string('status');
            $table->string('intituler');

            $table->foreign('id_etud')->references('id_etud')->on('Etudiants');
            $table->foreign('id_doc')->references('id_doc')->on('Documents');
             
        });

            Schema::create('Verifier', function (Blueprint $table) {
            $table->unsignedBigInteger('id_serv');
            $table->unsignedBigInteger('id_man');
            $table->date('date_verification');
            $table->string('intituler');

            $table->foreign('id_serv')->references('id_serv')->on('Services');
            $table->foreign('id_man')->references('id_man')->on('Managers');
             
        });

            Schema::create('Beneficier', function (Blueprint $table) {
            $table->unsignedBigInteger('id_serv');
            $table->unsignedBigInteger('id_etud');

            $table->foreign('id_serv')->references('id_serv')->on('Services');
            $table->foreign('id_etud')->references('id_etud')->on('Etudiants');
             
        });

        Schema::create('Choisir', function (Blueprint $table) {
            $table->unsignedBigInteger('id_etab');
            $table->unsignedBigInteger('id_etud');

            $table->foreign('id_etab')->references('id_etab')->on('Etablissements');
            $table->foreign('id_etud')->references('id_etud')->on('Etudiants');
             
        });

            Schema::create('Editer', function (Blueprint $table) {
            $table->unsignedBigInteger('id_serv');
            $table->unsignedBigInteger('id_man');

            $table->foreign('id_serv')->references('id_serv')->on('Services');
            $table->foreign('id_man')->references('id_man')->on('Managers');
             
        });

            Schema::create('Payer', function (Blueprint $table) {
            $table->unsignedBigInteger('id_frais');
            $table->unsignedBigInteger('id_etud');

            $table->foreign('id_etud')->references('id_etud')->on('Etudiants');
            $table->foreign('id_frais')->references('id_frais')->on('Frais');
             
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
         Schema::dropIfExists('Documents');
         Schema::dropIfExists('Services');
         Schema::dropIfExists('Etablissements');

         Schema::dropIfExists('Frais');
         Schema::dropIfExists('Voir');
         Schema::dropIfExists('Deposer');

         Schema::dropIfExists('Payer');
         Schema::dropIfExists('Editer');
         Schema::dropIfExists('Choisir');

         Schema::dropIfExists('Beneficier');
         Schema::dropIfExists('Verifier');
    }
}
