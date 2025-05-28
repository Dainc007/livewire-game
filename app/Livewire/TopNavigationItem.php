<?php

namespace App\Livewire;

use App\Models\Good;
use Livewire\Component;

class TopNavigationItem extends Component
{
    public Good $good;

    public function render()
    {
        return view('livewire.top-navigation-item');
    }
}
