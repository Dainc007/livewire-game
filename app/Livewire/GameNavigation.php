<?php

namespace App\Livewire;

use Livewire\Component;

class GameNavigation extends Component
{
    public $gold = 0;
    public $culture = 0;
    public $knowledge = 0;
    public $wood = 0;
    public $stone = 0;
    public $population = 0;
    public $happiness = 100;

    public function render()
    {
        return view('livewire.game-navigation');
    }
} 