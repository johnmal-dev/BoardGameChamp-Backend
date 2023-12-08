<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('game_name');
            $table->string('game_description')->nullable();
            $table->string('game_image')->nullable();
            $table->string('game_url')->nullable();
            $table->integer('game_min_players')->nullable();
            $table->integer('game_max_players')->nullable();
            $table->integer('game_min_playtime')->nullable();
            $table->integer('game_max_playtime')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
