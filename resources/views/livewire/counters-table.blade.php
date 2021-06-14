
<div>
    <style>
        nav svg{
            height: 20px;
        }
      </style>
    <table class="table table-responsive-lg table-striped" >
                      
        <tbody>
            <thead>
                <tr>
                <th>Name of Counter</th>
                <th>Assigned Service</th>
                <th>Status</th>
                <th>Actions</th>
                </tr>
                </thead>
            @foreach ($counters as $counter )
                
        <tr>
        <td>{{$counter->counter_name}}</td>
        
        <td>{{$counter->name}}</td> {{-- COUNTER->NAME is the service name --}}
        @if ($counter->is_active)
        <td><span class="badge badge-success">Active</span></td>
        @else  
        <td><span class="badge badge-secondary">Inactive</span></td>

        @endif
        <td>
            <a class="btn btn-sm btn-primary" href="{{route('admin.counters.edit',[$counter])}}">{{__('Edit')}}</a>
            <form style="display: inline-block" action="{{route('admin.counters.destroy',[$counter])}}" method="POST">
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
        {{ $counters->links('pagination')}}

        </div>

</div>
