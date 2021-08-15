<?php

namespace App\Http\Livewire\Admin\Services;

use App\Models\Department;
use App\Models\Service;
use Exception;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class ListServices extends Component
{
    public $status, $departmentId = "x",$service,$serviceIdBeingRemoved;
    public $editMode = false;
    public $state = ['is_active' => 1];
    public $selectPageRows = false, $selectedRows = [];
    public $servicesCount;
    use WithPagination;
    protected $listeners = ['deleteConfirmed' => 'deleteService','updateInfo' => 'updateService'];

    public function mount () 
    {
        $this->servicesCount = Service::max('default_number');
        $this->state['default_number'] = $this->servicesCount + 100;
    }
    public function render()
    {
        $departmentId = $this->departmentId;
        $status = $this->status;
        $departments = Department::select('id','department_name')->get();

        $services = Service::join('departments','services.department_id','=','departments.id')
        ->select('services.id', 'services.name', 'departments.department_name','services.prefix','services.default_number','services.is_active');

       
        // if($status && $status !="x"){
        //     $services = $services->where('services.is_active',$status);
        // }elseif(!$status){
        //     $services = $services->where('services.is_active',false);

        // }
        // if($departmentId && $departmentId !="x"){
        //     $services = $services->where('department_id','=',$departmentId);
        // }
        $services = $this->services->orderBy('services.id','asc')->paginate(5);

        return view('livewire.admin.services.list-services' , compact('services','departments'));
    }

    public function getServicesProperty() 
    {
    //    return Service::when($this->status, function($query,$status){
    //        return $query->where('status',$status);
    //    });
       return Service::join('departments','services.department_id','=','departments.id')
        ->select('services.id', 'services.name', 'departments.department_name','services.prefix','services.default_number','services.is_active');

       
    }

    public function addNewService() {
        $this->editMode=false;
        $this->reset();
        $this->servicesCount = Service::max('default_number');
        $this->state['default_number'] = $this->servicesCount + 1000;
        $this->dispatchBrowserEvent('show-service-modal');
    }

    public function createService() {
        // $this->state['is_active'] = true;
        $validatedData =  Validator::make($this->state,[
            'name' => 'required',
            'department_id' => 'required',
            'prefix' => 'required',
            'default_number' => 'required',
            'is_active' => 'required|in:1,0',
        ])->validate();
        // $validatedData['is_active'] = true;
        Service::create($validatedData);
        $this->dispatchBrowserEvent('hide-service-modal', ['message' => 'New Service successfully added!']);
        $this->state = [];
    }

    public function edit(Service $service)
    {
        $this->reset();

        $this->editMode = true;
        // $this->state['name'] = $user->name;
        // $this->state['email'] = $user->email;
        $this->service = $service;
        $this->state = $service->toArray();
        $this->dispatchBrowserEvent('show-service-modal');
    }

    public function confirmServiceUpdate()
    {
        $this->dispatchBrowserEvent('show-update-modal');
    }
    public function updateService() 
    {
        $validatedData =  Validator::make($this->state,[
            'name' => 'required',
            'department_id' => 'required',
            'prefix' => 'required',
            'default_number' => 'required',
            'is_active' => 'required|in:1,0',
        ])->validate();

        
        $this->service->update($validatedData);
        // session()->flash('message','User added successfully');
        $this->dispatchBrowserEvent('hide-service-modal', ['message' => 'Service updated successfully!']);
        $this->editMode = false;
        $this->state = [];
    }

    public function confirmServiceRemoval($serviceId)
    {
        $this->serviceIdBeingRemoved = $serviceId;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    
    public function deleteService() {
        $service =  Service::findOrFail($this->serviceIdBeingRemoved);
        $service->delete();
        $this->dispatchBrowserEvent('deleted', ['message' => 'Service deleted successfully!']);
    }

    public function updatedSelectPageRows($value)
    {
           if($value){
                $this->selectedRows =  $this->services->pluck('id')->map(function($id){
                    return (string) $id;
                });
           } else {
               $this->reset(['selectedRows','selectPageRows']);
           }

    }

    public function deleteSelectedRows() {

        try{
            Service::whereIn('id',$this->selectedRows)->delete();
            $this->dispatchBrowserEvent('deleted',['message' => 'All selected Service successfully deleted!']);
            $this->reset(['selectPageRows','selectedRows']);
        }catch(Exception $ex){
            $this->dispatchBrowserEvent('error',['message'=>'Sorry! '. $ex->getMessage()]);
        }
       

    }
    public function markInactive() {

        Service::whereIn('id', $this->selectedRows)->update(['is_active' => false]);
		$this->dispatchBrowserEvent('updated', ['message' => 'Selected counter(s) marked as Inactive.']);
		$this->reset(['selectPageRows', 'selectedRows']);

    }
    
    public function markActive() {

        Service::whereIn('id', $this->selectedRows)->update(['is_active' => true]);
		$this->dispatchBrowserEvent('updated', ['message' => 'Selected counter(s) marked as Inactive.']);
		$this->reset(['selectPageRows', 'selectedRows']);

    }
}
