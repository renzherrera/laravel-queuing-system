<?php

namespace App\Http\Livewire;

use App\Models\Department;
use Livewire\Component;
use Livewire\WithPagination;

class DepartmentsTable extends Component
{
    use WithPagination;

    public $department;
    public function render()
    {
        $departments = Department::paginate(5);
        return view('livewire.departments-table', compact('departments'));
    }
}
