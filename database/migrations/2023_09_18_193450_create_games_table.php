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
            $table->string('game_description');
            $table->string('game_image');
            $table->string('game_url');
            $table->integer('game_min_players');
            $table->integer('game_max_players');
            $table->integer('game_min_playtime');
            $table->integer('game_max_playtime');
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
