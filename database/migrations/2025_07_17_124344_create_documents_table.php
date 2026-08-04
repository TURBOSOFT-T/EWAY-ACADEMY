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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('formation_id')->nullable()->default(null);
            $table->unsignedBigInteger('certification_id')->nullable()->default(null);
            $table->unsignedBigInteger('event_id')->nullable()->default(null);
            $table->enum("type", ["formation", "event", "certification"])->default("event");
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('titre')->nullable();
            $table->boolean('active')->default(true);
            $table->string('file')->nullable();
            $table->string('file_path')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();


            // On recrée avec cascade
            $table->foreign('formation_id')
                ->references('id')->on('formations')
                ->cascadeOnDelete();

            $table->foreign('certification_id')
                ->references('id')->on('certifications')
                ->cascadeOnDelete();

            $table->foreign('event_id')
                ->references('id')->on('events')
                ->cascadeOnDelete();

           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
