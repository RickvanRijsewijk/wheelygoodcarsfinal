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
                $searchTerm = strtolower($this->searchTerm);
                $results = Car::where('brand', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('model', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('license_plate', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('production_year', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('color', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('tags', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('price', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('mileage', 'LIKE', "%{$searchTerm}%")
                    ->get();
            }
            return view('livewire.search', compact('results'));
        }
}
