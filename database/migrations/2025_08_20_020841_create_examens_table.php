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
        Schema::create('examens', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('category')->nullable();
            $table->string('exam_date')->nullable();
            $table->string('exam_duration')->nullable();
            $table->string('status')->nullable();
             $table->enum('question_limit', ['20','40','60','80','100','49'])
                  ->default('20');
                   $table->enum('total_points', ['20','40','60','80','100'])->default('100');
              
            $table->unsignedBigInteger('formation_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('formation_id')
                ->references('id')->on('formations')
                ->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examens');
    }
};
