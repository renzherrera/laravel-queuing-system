
<div>

    <table class="table table-responsive-lg table-striped" >
                      
        <tbody>
            <thead>
                <tr>
                <th>Queue Id</th>
                <th>Service</th>
                <th>Ticket #</th>
                <th>Status</th>
                <th>Registered Time</th>
                <th>Date</th>
                </tr>
                </thead>
            @foreach ($queues as $queue )
                
        <tr>
        <td>{{$queue->queue_id}}</td>
        <td>{{$queue->getServiceRelation->name}}</td>
        <td>{{$queue->getServiceRelation->prefix .' - '.$queue->ticket_number}}</td>
    
        @if ($queue->called == true)
        <td class="font-weight-semibold">Called &nbsp;<span class="badge badge-info">{{$queue->updated_at->diffForHumans($queue->created_at)}}</span></td>
        
        @else
        <td><span class="badge badge-warning">Waiting</span></td>
        {{-- <td><span class="badge badge-info">{{$averageCompletionTime}}</span></td> --}}


        @endif
        <td>{{$queue->created_at->format('h:i:s A')}}</td>
        <td>{{$queue->created_at->format('m-d-Y')}}</td>
        {{-- <td>{{$queue->updated_at}}</td> --}}
        {{-- <td>
            <a class="btn btn-sm btn-primary" href="{{route('admin.services.edit',[$service])}}">{{__('Edit')}}</a>


            <form id="" style="display: inline-block" action="{{route('admin.services.destroy',[$service])}}" method="POST">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('{{__('Counter designated from this service will be deleted also, Are you sure you want to delete this service?')}}')" class="btn btn-sm btn-danger" type="submit"> Delete</button>

            </form>
           
        </td> --}}
     
        </tr>
        @endforeach
        
        </tbody>

        </table>
        {{-- PAGINATION  --}}
        <div class="card-footer">
            {{ $queues->links('pagination')}}
        </div>

           


           

        
</div>

