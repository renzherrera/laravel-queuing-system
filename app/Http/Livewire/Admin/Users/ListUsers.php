<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\Counter;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class ListUsers extends Component
{
    public $editMode = false,$user,$userIdBeingRemoved;
    public $state = ['is_admin' => 0,'is_active' => 1];
    protected $listeners = ['deleteConfirmed' => 'deleteUser','updateInfo' => 'updateUser'];
    use WithPagination;
    public function render()
    {
        $counters = Counter::select('id','counter_number')->get();
        $users = User::paginate(5);
        return view('livewire.admin.users.list-users',compact('users','counters'));
    }

    public function addNewUser() {
        $this->reset();
        $this->editMode=false;
        $this->dispatchBrowserEvent('show-user-modal');
    }



    public function createUser() {
        // $this->state['is_active'] = true;
        $validatedData =  Validator::make($this->state,[
            'name' => 'required',
            'email' => 'email|required',
            'counter_id' => 'nullable',
            'is_active' => 'required|in:1,0',
            'is_admin' => 'required|in:1,0',
        ])->validate();
        $validatedData['password'] = '12345678';
        User::create($validatedData);
        $this->dispatchBrowserEvent('hide-user-modal', ['message' => 'New Service successfully added!']);
        $this->state = [];
    }

    public function edit(User $user)
    {
        $this->reset();

        $this->editMode = true;
        // $this->state['name'] = $user->name;
        // $this->state['email'] = $user->email;
        $this->user = $user;
        $this->state = $user->toArray();
        $this->dispatchBrowserEvent('show-user-modal');
    }

    public function confirmUserUpdate()
    {
        $this->dispatchBrowserEvent('show-update-modal');
    }
    public function updateUser() 
    {
        $validatedData =  Validator::make($this->state,[
            'name' => 'required',
            'email' => 'email|required',
            'counter_id' => 'nullable',
            'is_active' => 'required|in:1,0',
            'is_admin' => 'required|in:1,0',
        ])->validate();
        
        $this->user->update($validatedData);
        $this->dispatchBrowserEvent('hide-user-modal', ['message' => 'User updated successfully!']);
        $this->editMode = false;
        $this->state = [];
    }

    public function confirmUserRemoval($userId)
    {
        $this->userIdBeingRemoved = $userId;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    
    public function deleteUser() {
        $service =  User::findOrFail($this->userIdBeingRemoved);
        $service->delete();
        $this->dispatchBrowserEvent('deleted', ['message' => 'User deleted successfully!']);
    }
}
