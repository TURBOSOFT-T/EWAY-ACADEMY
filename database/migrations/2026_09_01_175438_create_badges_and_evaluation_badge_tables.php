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
        // Table principale des badges
        Schema::create('badges', function (Blueprint $table) {
            $table->id();
            $table->string('name');             // Ex: Pédagogue, Ponctuel, Patient
            $table->string('slug')->unique();    // Ex: pedagogue, ponctuel
            $table->string('icon')->nullable();  // Nom de l'icône (FontAwesome / Heroicons)
            $table->string('color')->nullable(); // Code couleur Hex ou classe Tailwind (ex: #10B981, bg-emerald-500)
            $table->timestamps();
        });

        // Table pivot entre teacher_evaluations et badges
        Schema::create('evaluation_badge', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_evaluation_id')->constrained('teacher_evaluations')->onDelete('cascade');
            $table->foreignId('badge_id')->constrained('badges')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluation_badge');
        Schema::dropIfExists('badges');
    }
};