<?php

declare(strict_types=1);

use App\Enums\BuildingType;
use App\Models\Building;
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
        Schema::create('buildings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->string('description')->nullable();
            $table->string('icon')->nullable();
            $table->integer('cost')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        $buildings = [];
        foreach (BuildingType::getAllCases() as $buildingType) {
            $buildings[] = [
                'name' => $buildingType->value,
                'type' => $buildingType->value,
                'description' => $buildingType->description(),
                'icon' => $buildingType->icon(),
                'cost' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if (! empty($buildings)) {
            Building::insert($buildings);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buildings');
    }
};
