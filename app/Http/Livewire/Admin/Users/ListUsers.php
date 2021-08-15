<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\Counter;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;
use PDF;

class ListUsers extends Component
{
    public $editMode = false,$user,$userIdBeingRemoved;
    public $state = ['is_admin' => 0,'is_active' => 1];
    public $selectPageRows = false, $selectedRows = [];

    protected $listeners = ['deleteConfirmed' => 'deleteUser','updateInfo' => 'updateUser'];
    use WithPagination;
    public function render()
    {
        $counters = Counter::select('id','counter_number')->get();
        $users = $this->users->paginate(5);
        return view('livewire.admin.users.list-users',compact('users','counters'));
    }

    public function getUsersProperty() 
    {
    //    return Service::when($this->status, function($query,$status){
    //        return $query->where('status',$status);
    //    });
       return User::select('id','name','email','is_active','created_at','is_admin','counter_id');

       
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
    public function updatedSelectPageRows($value)
    {
           if($value){
                $this->selectedRows =  $this->users->pluck('id')->map(function($id){
                    return (string) $id;
                });
           } else {
               $this->reset(['selectedRows','selectPageRows']);
           }

    }

    public function markInactive() {

        User::whereIn('id', $this->selectedRows)->update(['is_active' => false]);
		$this->dispatchBrowserEvent('updated', ['message' => 'Selected counter(s) marked as Inactive.']);
		$this->reset(['selectPageRows', 'selectedRows']);

    }
    
    public function markActive() {

        User::whereIn('id', $this->selectedRows)->update(['is_active' => true]);
		$this->dispatchBrowserEvent('updated', ['message' => 'Selected counter(s) marked as Inactive.']);
		$this->reset(['selectPageRows', 'selectedRows']);

    }

    public function deleteSelectedRows() {

        try{
            User::whereIn('id',$this->selectedRows)->delete();
            $this->dispatchBrowserEvent('deleted',['message' => 'All selected User successfully deleted!']);
            $this->reset(['selectPageRows','selectedRows']);
        }catch(Exception $ex){
            $this->dispatchBrowserEvent('error',['message'=>'Sorry! '. $ex->getMessage()]);
        }
       

    }

    public function createPDF()
    {
        $users = $this->users;

        $users = $users->whereIn('id',$this->selectedRows)->get();
        // $projects = Project::join('project_images','projects.id','=','project_images.project_id');
        view()->share('users',$users);
        
        $pdf = PDF::loadView('pdf.users-pdf',  
        compact('users'))
        ->setPaper('a4');
       $pdf->setOption('header-html', view('pdf.pdf-header'));
       if($users){
        return $pdf->stream('users.pdf');
    }
    }
}
