<?php

namespace App\Livewire;

use App\Models\Car;
use Livewire\Component;

class Search extends Component
{
    public $searchTerm = '';

    public function render(): \Illuminate\View\View
    {
        $results = [];
        if (strlen($this->searchTerm) > 2) {
            $results = Car::where('model', 'like', '%' . $this->searchTerm . '%')->get();
        }

        return view('livewire.search', compact('results'));
    }
}
