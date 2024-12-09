<?php
namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Car;

class CarCounter extends Component
{
    public $count;

    protected $listeners = ['carUpdated' => 'updateCount'];

    public function mount()
    {
        $this->updateCount();
    }

    public function updateCount()
    {
        $this->count = Car::where('status', 'Te koop')->count();
    }

    public function render()
    {
        return view('livewire.car-counter');
    }
}
