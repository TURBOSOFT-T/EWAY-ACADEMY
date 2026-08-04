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
        Schema::create('oex_exam_masters', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('exam_id')->nullable();
            $table->string('questions')->nullable();
            $table->string('ans')->nullable();
            $table->string('options')->nullable();


            $table->string('title')->nullable();

            $table->string('exam_date')->nullable();
            $table->string('exam_duration')->nullable();
            $table->string('status')->nullable();
            $table->foreign('exam_id')->references('id')->on('examens')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oex_exam_masters');
    }
};
