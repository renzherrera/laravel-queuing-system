<?php

namespace App\Http\Livewire\Admin\Counters;

use App\Models\Counter;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class ListCounters extends Component
{
    use WithPagination;

    public $counter; //if edit click this will be filled from the paramter
    public $editMode = false;
    public $counterNumber,$counterIdBeingRemoved;
    public $state = [];
    protected $listeners = ['deleteConfirmed' => 'deleteCounter','updateInfo' => 'updateCounter'];

    public function mount()
    {
        $this->counterNumber = Counter::max('counter_number');
        $this->state['counter_number'] = $this->counterNumber + 1;
    }

 
    public function render()
    {
        $services = Service::all(['id', 'name']);
        $counters = Counter::with('services')
        ->orderBy('id','desc')
        ->paginate(5);

        $counterNumber = $this->counterNumber;
        return view('livewire.admin.counters.list-counters',compact('counters','services','counterNumber'));
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

}
