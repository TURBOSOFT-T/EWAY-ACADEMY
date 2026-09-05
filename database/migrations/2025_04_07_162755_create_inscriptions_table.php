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
         $table->enum('type', ['Pack', 'Formation', 'Event'])->default('Pack');
                 

            $table->text("note")->nullable()->default(null);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('event_id')->nullable();
            $table->unsignedBigInteger('formation_id')->nullable();
            $table->unsignedBigInteger('pack_formation_id')->nullable();
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


            
      
     
     

         
        
           
             $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
               $table->foreign('formation_id')->references('id')->on('formations')->cascadeOnDelete();;
               $table->foreign('pack_formation_id')->references('id')->on('pack_formations')->cascadeOnDelete();;
                 $table->foreign('event_id')->references('id')->on('events')->cascadeOnDelete();;
                  $table->unique(['user_id', 'pack_formation_id'], 'user_pack_unique');
            $table->unique(['user_id', 'formation_id'], 'user_formation_unique');
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
