<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('oex_question_masters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exam_id')->nullable();
             $table->string('descriptions')->nullable(); // exemple
            
            $table->text('questions')->nullable();
            $table->text('ans')->nullable();
            $table->text('options')->nullable();
             $table->integer('points')->default(1);
            $table->boolean('status')->default(1);
            $table->string('description')->nullable();
            
             $table->enum('question_limit', ['20','40','60','80','100','49'])
                  ->default('20');
                  $table->foreign('exam_id')->references('id')->on('examens')->onDelete('cascade');
                  
            $table->timestamps();

      
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('oex_question_masters');
    }
};
