<?php

namespace App\Http\Livewire\Admin\Departments;

use App\Models\Department;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class ListDepartments extends Component
{
    public $department,$departmentIdBeingRemoved,$departmentIdBeingUpdate; //when edit clicked, value of the model will be stored here
    public $status ='3',$editMode = false;
    public $state = [];

    protected $listeners = ['deleteConfirmed' => 'deleteDepartment','updateInfo' => 'updateDepartment'];
    use WithPagination;
    public function render()
    {
        $status =$this->status;
        if($status !="3"){
            $departments = Department::where('is_active','=', $status)
            ->paginate(5);
        }else {
            $departments = Department::paginate(5);
        }
         
        return view('livewire.admin.departments.list-departments',compact('departments'));
    }

    public function addNewDepartment() {
        $this->reset();
        $this->editMode=false;

    }

    public function createDepartment() {
        $this->state['is_active'] = true;
        $validatedData =  Validator::make($this->state,[
            'department_name' => 'required',
            'is_active' => 'required|in:1,0',
        ])->validate();
        $validatedData['is_active'] = true;
        Department::create($validatedData);
        // session()->flash('message','User added successfully');
        $this->dispatchBrowserEvent('after-insert-modal', ['message' => 'New Department successfully added!']);

        $this->state['department_name'] = '';
    }

    public function edit(Department $department)
    {
        $this->reset();

        $this->editMode = true;
        // $this->state['name'] = $user->name;
        // $this->state['email'] = $user->email;
        $this->department = $department;
        $this->state = $department->toArray();
        $this->dispatchBrowserEvent('show-form');
    }

    public function updateDepartment() 
    {
        $validatedData =  Validator::make($this->state,[
            'department_name' => 'required',
            'is_active' => 'required',
        ])->validate();

        
        $this->department->update($validatedData);
        // session()->flash('message','User added successfully');
        $this->dispatchBrowserEvent('after-insert-modal', ['message' => 'Department updated successfully!']);
        $this->editMode = false;
        $this->state = [];
    }

    public function confirmDepartmentRemoval($departmentId)
    {
        $this->departmentIdBeingRemoved = $departmentId;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function confirmDepartmentUpdate()
    {
        $this->dispatchBrowserEvent('show-update-modal');
    }
    
    
    public function deleteDepartment() {
        $department =  Department::findOrFail($this->departmentIdBeingRemoved);
        $department->delete();
        $this->dispatchBrowserEvent('deleted', ['message' => 'Department deleted successfully!']);
    }
}
