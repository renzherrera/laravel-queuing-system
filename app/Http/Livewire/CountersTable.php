<?php

namespace App\Http\Livewire;

use App\Models\Counter;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class CountersTable extends Component
{
    use WithPagination;
    public function render()
    {

        // $counters = Counter::join('services','counters.service_id','=','services.id')
        // ->select('counters.id', 'counters.counter_name', 'services.name','counters.is_active')
        // ->paginate(5);

        $counters = Counter::with('services')
        ->paginate(5);

        $userCounter = User::withCount('counters')->get();
        return view('livewire.counters-table', compact('counters','userCounter'));
    }
}
