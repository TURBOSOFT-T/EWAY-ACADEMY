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
        Schema::create('online_classes', function (Blueprint $table) {
            $table->id();

        //    $table->foreignId('formation_id')->references('id')->on('formations')->onDelete('cascade');
            $table->unsignedBigInteger('formation_id')->nullable()->default(null);
            $table->unsignedBigInteger('event_id')->nullable()->default(null);
            $table->enum("type",["formation","event","certification"])->default("event");
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('meeting_id');
            $table->string('topic');
            $table->dateTime('start_at');
            $table->integer('duration')->comment('minutes');
            $table->string('password')->comment('meeting password');
            $table->text('start_url');
            $table->text('join_url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('online_classes');
    }
};
