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
        Schema::create('teacher_profiles', function (Blueprint $table) {
            $table->id();

            // Clé étrangère liée à la table users
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade'); // Supprime le profil si l'utilisateur est supprimé
            
            // Informations professionnelles
            $table->text('bio')->nullable();
            $table->string('grade')->nullable(); // Ex: Professeur Certifié, Maître de Conférences, Docteur
            $table->integer('experience_years')->default(0); // Nombre d'années d'expérience
            $table->string('highest_degree')->nullable(); // Ex: Master 2, Doctorat, PhD
            $table->json('certifications')->nullable(); // Stocke la liste des certifications sous forme JSON ou texte
            $table->string('speciality')->nullable(); // Ex: Informatique, Mathématiques, Génie Logiciel
            $table->string('cv_path')->nullable(); // Chemin du fichier CV si téléversé
            $table->json('social_links')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_profiles');
    }
};
