<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('inscriptions', function (Blueprint $table) {
            // Empêche un même user d'avoir le même pack ou la même formation en double
            $table->unique(['user_id', 'pack_formation_id'], 'user_pack_unique');
            $table->unique(['user_id', 'formation_id'], 'user_formation_unique');
        });
    }

    public function down(): void
    {
        Schema::table('inscriptions', function (Blueprint $table) {
            $table->dropUnique('user_pack_unique');
            $table->dropUnique('user_formation_unique');
        });
    }
};