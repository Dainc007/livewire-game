<?php

namespace App\Livewire;

use Livewire\Component;

class GameBoard extends Component
{
    public $columns = 30;
    public $rows = 16;
    public $map = [];

    public function mount()
    {
        $this->generateHexagonData();
    }

    public function generateHexagonData()
    {
        $this->map = [];
        $stateIndex = 0;

        for ($col = 0; $col < $this->columns; $col++) {
            $columnData = [];
            $maxRowsInColumn = $this->rows;

            for ($row = 0; $row < $maxRowsInColumn; $row++) {
                $type = $this->determineHexagonType($col, $row);

                $hexagon = [
                    'id' => "hex-{$col}-{$row}",
                    'type' => $type,
                    'icon' => null
                ];

                if ($type === 'anima') {
                    $hexagon['icon'] = '';
                }

                $columnData[] = $hexagon;
            }

            $this->map[] = $columnData;
        }
    }

    private function determineHexagonType()
    {
        return 'anima';
    }
}
