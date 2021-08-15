<?php

namespace App\Http\Livewire\Admin\Departments;

use App\Models\Department;
use Exception;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;
use PDF;
class ListDepartments extends Component
{
    public $department,$departmentIdBeingRemoved,$departmentIdBeingUpdate; //when edit clicked, value of the model will be stored here
    public $status,$editMode = false;
    public $state = [];
    public $selectPageRows = false, $selectedRows = [] ;

    protected $listeners = ['deleteConfirmed' => 'deleteDepartment','updateInfo' => 'updateDepartment'];
    use WithPagination;
    public function render()
    {
            $departments = $this->departments->paginate(5);
         
        return view('livewire.admin.departments.list-departments',compact('departments'));
    }

    public function getDepartmentsProperty() 
    {
       return Department::when($this->status, function($query,$status){
           return $query->where('is_active','=',$status == "true" ? true : false);
       });
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

    public function updatedSelectPageRows($value)
    {
           if($value){
                $this->selectedRows =  $this->departments->pluck('id')->map(function($id){
                    return (string) $id;
                });
           } else {
               $this->reset(['selectedRows','selectPageRows']);
           }

    }

    public function markInactive() {

        Department::whereIn('id', $this->selectedRows)->update(['is_active' => false]);
		$this->dispatchBrowserEvent('updated', ['message' => 'All selected Department(s) marked as Inactive.']);
		$this->reset(['selectPageRows', 'selectedRows']);

    }
    
    public function markActive() {

        Department::whereIn('id', $this->selectedRows)->update(['is_active' => true]);
		$this->dispatchBrowserEvent('updated', ['message' => 'All selected Department(s) marked as Inactive.']);
		$this->reset(['selectPageRows', 'selectedRows']);

    }

    public function deleteSelectedRows() {

        try{
            Department::whereIn('id',$this->selectedRows)->delete();
            $this->dispatchBrowserEvent('deleted',['message' => 'Selected Department successfully deleted!']);
            $this->reset(['selectPageRows','selectedRows']);
        }catch(Exception $ex){
            $this->dispatchBrowserEvent('error',['message'=>'Sorry! '. $ex->getMessage()]);
        }
       

    }
    public function createPDF()
    {
        $departments = $this->departments;

        $departments = $departments->whereIn('id',$this->selectedRows)->orderBy('department_name','asc')->get();
        // $projects = Project::join('project_images','projects.id','=','project_images.project_id');
        view()->share('departments',$departments);
        
        $pdf = PDF::loadView('pdf.departments-pdf',  
        compact('departments'))
        ->setPaper('a4');
        // ->setOrientation('landscape');
       $pdf->setOption('header-html', view('pdf.pdf-header'));
       if($departments){
        return $pdf->stream('departments.pdf');
    }
    }

}
