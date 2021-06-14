<?php

namespace App\Http\Livewire;

use App\Models\Service;
use Livewire\Component;
use Livewire\WithPagination;


class ServicesTable extends Component
{
    use WithPagination;

    public function render()
    {
        $services = Service::join('departments','services.department_id','=','departments.id')
        ->select('services.id', 'services.name', 'departments.department_name','services.prefix','services.default_number','services.is_active')
        ->paginate(5);

        return view('livewire.services-table', compact('services'));
    }
}
