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
        Schema::create('videos', function (Blueprint $table) {
          $table->id();
            $table->string('titre')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('views')->default(0);
            $table->longText('video')->nullable(); // ✅ suppression de ->change()
            $table->boolean('is_external')->default(false); // ✅ suppression de ->after('video')
            $table->boolean('is_file_upload')->default(true);
            $table->string('auteur')->nullable();
            $table->string('path')->nullable();
            $table->unsignedBigInteger('categorie_id')->nullable();
            $table->string('image_url')->nullable();
            $table->string('image_public_id')->nullable();
            $table->string('video_public_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('image')->nullable();
              $table->foreign('categorie_id')->references('id')->on('categories')->cascadeOnDelete();;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
