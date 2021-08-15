<?php

namespace App\Http\Livewire\Admin\Kiosk;

use App\Models\Department;
use Livewire\Component;

class KioskDepartment extends Component
{
    public function render()
    {
        $departments = Department::select('id','department_name','is_active')->get();
        return view('livewire.admin.kiosk.kiosk-department',compact('departments'))->layout('layouts.kiosk');
    }
}
