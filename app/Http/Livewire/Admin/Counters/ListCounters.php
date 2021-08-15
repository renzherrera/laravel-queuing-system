<?php

namespace App\Http\Livewire\Admin\Counters;

use App\Models\Counter;
use App\Models\Service;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class ListCounters extends Component
{
    use WithPagination;

    public $counter; //if edit click this will be filled from the paramter
    public $editMode = false;
    public $counterNumber,$counterIdBeingRemoved;
    public $selectPageRows = false, $selectedRows = [] ,$status;

    public $state = ['status' => 'active'];
    protected $listeners = ['deleteConfirmed' => 'deleteCounter','updateInfo' => 'updateCounter'];

    public function mount()
    {
        $this->counterNumber = Counter::max('counter_number');
        $this->state['counter_number'] = $this->counterNumber + 1;
    }

 
    public function render()
    {
        $services = Service::all(['id', 'name']);
        // $counters = Counter::with('services')
        // ->orderBy('id','desc')
        // ->paginate(5);
        $counters = $this->counters->paginate(5);
        $counterNumber = $this->counterNumber;
        return view('livewire.admin.counters.list-counters',compact('counters','services','counterNumber'));
    }

    public function getCountersProperty() 
    {
       return Counter::when($this->status, function($query,$status){
           return $query->where('status',$status);
       });
    }

    public function hydrate() {
        $this->counterNumber = Counter::max('counter_number');
        $this->state['counter_number'] = $this->counterNumber + 1;
    }
    // button modal toggler
    public function addNewCounter() {
        $this->editMode=false;
        $this->state['service_id'] = '';
        $this->state['is_active'] = 1;


    }

    public function createCounter() 
    {
        $validatedData =  Validator::make($this->state,[
            'counter_number' => 'required',
            'service_id' => 'required',
            'is_active' => 'required|in:1,0',
        ])->validate();
        $validatedData['counter_name'] = 'clear';
        Counter::create($validatedData);
        // session()->flash('message','User added successfully');
        $this->dispatchBrowserEvent('hide-counter-modal', ['message' => 'New Counter successfully added!']);
        $this->state = [];

        // $this->state['department_name'] = '';
    }

    
    public function edit (Counter $counter)
    {
        $this->reset();

        $this->editMode = true;
        // $this->state['name'] = $user->name;
        // $this->state['email'] = $user->email;
        $this->counter = $counter;
        $this->state = $counter->toArray();
        $this->dispatchBrowserEvent('show-counter-modal');
    }

    public function confirmCounterUpdate()
    {
        $this->dispatchBrowserEvent('show-update-modal');
    }

    public function updateCounter() 
    {
        $validatedData =  Validator::make($this->state,[
            'counter_number' => 'required',
            'service_id' => 'required',
            'is_active' => 'required|in:1,0',
        ])->validate();

        $validatedData['counter_name'] = 'clear';
        
        $this->counter->update($validatedData);
        // session()->flash('message','User added successfully');
        $this->dispatchBrowserEvent('hide-counter-modal', ['message' => 'Department updated successfully!']);
        $this->editMode = false;
        $this->state = [];
    }

    public function confirmCounterRemoval($counterId)
    {
        $this->counterIdBeingRemoved = $counterId;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function deleteCounter() {
        $counter =  Counter::findOrFail($this->counterIdBeingRemoved);
        $counter->delete();
        $this->dispatchBrowserEvent('deleted', ['message' => 'Counter deleted successfully!']);
    }

    public function updatedSelectPageRows($value)
    {
           if($value){
                $this->selectedRows =  $this->counters->pluck('id')->map(function($id){
                    return (string) $id;
                });
           } else {
               $this->reset(['selectedRows','selectPageRows']);
           }

    }

    public function deleteSelectedRows() {

        try{
            Counter::whereIn('id',$this->selectedRows)->delete();
            $this->dispatchBrowserEvent('deleted',['message' => 'Selected Counter successfully deleted!']);
            $this->reset(['selectPageRows','selectedRows']);
        }catch(Exception $ex){
            $this->dispatchBrowserEvent('error',['message'=>'Sorry! '. $ex->getMessage()]);
        }
       

    }

    public function markInactive() {

        Counter::whereIn('id', $this->selectedRows)->update(['status' => 'inactive']);
		$this->dispatchBrowserEvent('updated', ['message' => 'Selected counter(s) marked as Inactive.']);
		$this->reset(['selectPageRows', 'selectedRows']);

    }
    
    public function markActive() {

        Counter::whereIn('id', $this->selectedRows)->update(['status' => 'active']);
		$this->dispatchBrowserEvent('updated', ['message' => 'Selected counter(s) marked as Inactive.']);
		$this->reset(['selectPageRows', 'selectedRows']);

    }


}
