<div>
    <table class="table table-responsive-lg table-striped" >
                      
        <tbody>
            <thead>
                <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Assigned Counter</th>
                <th>Status</th>
                <th>Actions</th>
                </tr>
                </thead>
            @foreach ($users as $user )
                
        <tr>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        @if ($user->is_admin)
        <td><span>Admin</span></td>
        @else  
        <td><span>Staff</span></td>

        @endif
        <td>{{$user->counter_name}}</td>

        @if ($user->is_active)
        <td><span class="badge badge-success">Active</span></td>
        @else  
        <td><span class="badge badge-secondary">Inactive</span></td>

        @endif
        <td>
            <a class="btn btn-sm btn-primary" href="{{route('admin.users.edit',[$user])}}">{{__('Edit')}}</a>
            <form style="display: inline-block" action="{{route('admin.users.destroy',[$user])}}" method="POST">
                @csrf
                @method('DELETE')
            <button onclick="return confirm('{{__('Are you sure you want to delete this task?')}}')" class="btn btn-sm btn-danger" type="submit"> Delete</button>
            </form>
        </td>
     
        </tr>
        @endforeach
        
        </tbody>
        </table>
        <div class="card-footer">
            {{ $users->links('pagination')}}
    
            </div>
</div>
