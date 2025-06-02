<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\FieldType;
use App\Models\Field;
use App\Models\Game;

final class MapGenerationService
{
    public function generateMapForGame(Game $game): array
    {
        // Check if fields already exist for this game
        if ($game->fields()->exists()) {
            return $this->loadExistingMap($game);
        }

        // Generate new fields
        return $this->createNewMap($game);
    }

    public function regenerateMapForGame(Game $game): array
    {
        // Delete existing fields
        $game->fields()->delete();

        // Create new map
        return $this->createNewMap($game);
    }

    private function createNewMap(Game $game): array
    {
        $fieldId = 1;
        $map = [];

        for ($x = 0; $x < 30; $x++) {
            $map[$x] = [];
            for ($y = 0; $y < 16; $y++) {
                $fieldType = FieldType::cases()[array_rand(FieldType::cases())];

                $field = new Field();
                $field->game_id = $game->id;
                $field->field_id = $fieldId;
                $field->field_type = $fieldType->value;
                $field->save();

                $map[$x][$y] = [
                    'id' => $field->id,
                    'type' => $field->field_type,
                    'classes' => $field->getCssClasses(),
                    'icon' => $field->getIcon(),
                ];

                $fieldId++;
            }
        }

        return $map;
    }

    private function loadExistingMap(Game $game): array
    {
        $fields = $game
            ->fields()
            ->orderBy('field_id')
            ->get();
        $map = [];
        $fieldIndex = 0;

        for ($x = 0; $x < 30; $x++) {
            $map[$x] = [];
            for ($y = 0; $y < 16; $y++) {
                $field = $fields[$fieldIndex] ?? null;

                if ($field) {
                    $map[$x][$y] = [
                        'id' => $field->id,
                        'type' => $field->field_type,
                        'classes' => $field->getCssClasses(),
                        'icon' => $field->getIcon(),
                    ];
                }

                $fieldIndex++;
            }
        }

        return $map;
    }
}
