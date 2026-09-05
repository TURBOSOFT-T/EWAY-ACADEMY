<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contenu_inscriptions', function (Blueprint $table) {
            $table->id();

            //   $table->unsignedBigInteger('event_id')->nullable();
          //  $table->unsignedBigInteger('formation_id')->nullable();
          //  $table->unsignedBigInteger('pack_formation_id')->nullable();
        //    $table->unsignedBigInteger('commercial_id')->nullable();

            // Lien vers la table principale inscriptions
            $table->foreignId('inscription_id')
                  ->constrained('inscriptions')
                  ->onDelete('cascade');

            // Type de contenu souscrit : 'Pack' ou 'Formation'
            $table->enum('type', ['Pack', 'Formation']);

            // Foreign keys optionnelles selon le type souscrit
            $table->foreignId('pack_formation_id')
                  ->nullable()
                  ->constrained('pack_formations')
                  ->onDelete('cascade');

            $table->foreignId('formation_id')
                  ->nullable()
                  ->constrained('formations')
                  ->onDelete('cascade');

            // Prix auquel l'élément a été acheté (historique tarifaire)
            $table->decimal('prix', 10, 2)->default(0);

            $table->timestamps();

            // Index d'unicité pour empêcher les doublons dans une même inscription
            $table->unique(['inscription_id', 'pack_formation_id'], 'unique_inscription_pack');
            $table->unique(['inscription_id', 'formation_id'], 'unique_inscription_formation');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contenu_inscriptions');
    }
};