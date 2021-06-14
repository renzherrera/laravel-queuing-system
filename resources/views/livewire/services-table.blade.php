
<div>
    <table class="table table-responsive-lg table-striped" >
                      
        <tbody>
            <thead>
                <tr>
                <th>Name of Services</th>
                <th>Department</th>
                <th>Prefix</th>
                <th>Default Number</th>
                <th>Status</th>
                <th>Actions</th>
                </tr>
                </thead>
            @foreach ($services as $service )
                
        <tr>
        <td>{{$service->name}}</td>
        <td>{{$service->department_name}}</td>
        <td>{{$service->prefix}}</td>
        <td>{{$service->default_number}}</td>
        @if ($service->is_active)
        <td><span class="badge badge-success">Active</span></td>
        @else  
        <td><span class="badge badge-secondary">Inactive</span></td>

        @endif
        <td>
            <a class="btn btn-sm btn-primary" href="{{route('admin.services.edit',[$service])}}">{{__('Edit')}}</a>
            <form style="display: inline-block" action="{{route('admin.services.destroy',[$service])}}" method="POST">
                @csrf
                @method('DELETE')
            <button onclick="return confirm('{{__('Are you sure you want to delete this task?')}}')" class="btn btn-sm btn-danger" type="submit"> Delete</button>
            </form>
        </td>
     
        </tr>
        @endforeach
        
        </tbody>

        </table>
        {{-- PAGINATION  --}}
        <div class="card-footer">
            {{ $services->links('pagination')}}
        </div>
</div>
