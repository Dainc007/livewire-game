<?php

declare(strict_types=1);

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
            $table->foreignId('field_id')->nullable()->constrained()->cascadeOnDelete();

            $table->morphs('resourceable');
            $table->integer('value')->default(0);

            $table->timestamp('construction_started_at')->nullable();
            $table->timestamp('construction_completed_at')->nullable();

            $table->timestamps();

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
