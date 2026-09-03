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
        Schema::create('teacher_evaluations', function (Blueprint $table) {
            $table->id();
            
            // Clés étrangères vers la table users
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('teacher_id')->constrained('users')->onDelete('cascade');
            
            // Évaluation
            $table->unsignedTinyInteger('rating'); // Note de 1 à 5
            $table->text('comment')->nullable();
            
            // Modération / Validation
            $table->boolean('is_approved')->default(true);
            $table->boolean('is_anonymous')->default(false);

            $table->timestamps();

            // Index pour optimiser la recherche des avis d'un enseignant
            $table->index(['teacher_id', 'is_approved']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_evaluations');
    }
};