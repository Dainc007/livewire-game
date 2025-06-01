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
        Schema::create('game_resources', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->morphs('resourceable'); // This creates resourceable_id and resourceable_type
            $table->integer('value')->default(0);
            $table->timestamps();

            // Ensure a user can't have duplicate resources of the same type in a game
            $table->unique(['game_id', 'user_id', 'resourceable_id', 'resourceable_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_resources');
    }
};
