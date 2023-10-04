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
        Schema::create('session_rankings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('session_player_id')->constrained();
            $table->foreignId('game_id')->constrained();
            $table->integer('session_rank');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('session_rankings');
    }
};
