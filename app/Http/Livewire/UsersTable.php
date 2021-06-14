<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersTable extends Component
{
    use WithPagination;

    public function render()
    {
        $users = User::join('counters','users.counter_id','=','counters.id')
        ->select('users.id', 'users.name', 'users.email','users.is_admin','counters.counter_name','users.is_active')
        ->paginate(5);

        return view('livewire.users-table', compact('users'));
    }
}
