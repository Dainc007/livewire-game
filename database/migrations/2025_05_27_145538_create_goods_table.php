<?php

declare(strict_types=1);

use App\Enums\GoodType;
use App\Models\Good;
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
        Schema::create('goods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('icon')->nullable();
            $table->timestamps();
        });

        $goods = [];
        foreach (GoodType::getAllCases() as $goodType) {

            $goods[] = [
                'name' => $goodType->value,
                'description' => $goodType->description(),
                'icon' => $goodType->icon(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if (! empty($goods)) {
            Good::insert($goods);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goods');
    }
};
