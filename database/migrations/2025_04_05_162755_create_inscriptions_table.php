<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inscriptions', function (Blueprint $table) {
            $table->id();


            $table->enum("statut", ['créé', 'attente', 'traitement', 'payée', 'planification', 'retournée'])->default('attente');

            $table->enum("mode", ["espèce", "paypal", "carte de credit"])->default("espèce");
            $table->enum("etat", ["attente", "confirmé", "annulé"])->default("attente");
            $table->enum("type",["Formation","Event"])->default("Event");

            $table->text("note")->nullable()->default(null);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('event_id')->nullable();
            $table->unsignedBigInteger('formation_id')->nullable();
                $table->unsignedBigInteger('commercial_id')->nullable();
            $table->string('nom')->nullable();
            $table->string('prenom')->nullable();
            $table->string('email', 255)->nullable();
            $table->string('telephone')->nullable()->default(null);
            $table->string('whatsapp')->nullable()->default(null);
            $table->string('addresse')->nullable()->default(null);
            $table->string('ville')->nullable()->default(null);
            $table->string('message')->nullable()->default(null);

             $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('state_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();


            
            // Traduction
            $table->enum('langue_source', [
                'arabe',
                'anglais',
                'mandarin',
                'espagnol',
                'français'
            ])->nullable();

            $table->enum('langue_destination', [
                'arabe',
                'anglais',
                'mandarin',
                'espagnol',
                'français'
            ])->nullable();


            // Préparation aux tests
            $table->enum('test_officiel', [

                'TCF',
                'TEF',
                'TECFEE',
                'Examen universel de français',
                'SEL',
                'Bright'

            ])->nullable();


            // Cours de français
            $table->enum('type_cours', [

                'cours pour adulte',
                'cours pour enfants',
                'cours pour entreprises et professionnel'

            ])->nullable();


            $table->enum('diplome_plus_eleve', [
                'diplôme de fin d’études secondaire',
                'diplôme universitaire 2 ans',
                'diplôme universitaire 3 ans',
                'diplôme universitaire 4 ans / 5 ans'
            ])->nullable();

            // Domaine d’étude
            $table->string('domaine_etude')->nullable();

            // Spécialité
            $table->string('specialite')->nullable();

            // Projet d’études
            $table->text('projet_etudes')->nullable();

            // Domaine visé
            $table->string('domaine_etudes_visees')->nullable();

            // Spécialité visée
            $table->string('specialite_visee')->nullable();

            // Motivation
            $table->text('motivation_etudes_canada')->nullable();

             $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
               $table->foreign('formation_id')->references('id')->on('formations')->cascadeOnDelete();;
                 $table->foreign('event_id')->references('id')->on('events')->cascadeOnDelete();;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscriptions');
    }
};
