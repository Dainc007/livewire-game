<?php

declare(strict_types=1);

use App\Enums\UnitType;
use App\Models\Unit;
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
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('icon')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        $units = [];
        foreach (UnitType::getAllCases() as $unitType) {
            $units[] = [
                'name' => $unitType->value,
                'description' => $unitType->description(),
                'icon' => $unitType->icon(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if (! empty($units)) {
            Unit::insert($units);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};
