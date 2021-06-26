
<div>
    <form action="{{route('admin.queues.pdf',$status)}}">

    <div class="row ">
        <div class="col-md-3">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Filter by: Service</label>
                <select class="form-control" id="service" name="service" wire:model="service">
                  <option value="x">-- Select Service</option>
                  @foreach ($services as $serviceItem)
                  <option value="{{$serviceItem->id}}">{{$serviceItem->name}}</option>
                  @endforeach
                </select>
              </div>
        </div>
        
        <div class="col-md-4">
            <div class="form-group">
                <label for="exampleFormControlSelect1">From</label>
                <input class="form-control" id="date-input" type="date" name="fromDate" id="fromDate" wire:model="fromDate" placeholder="date">
              </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="exampleFormControlSelect1">To</label>
                <input class="form-control" id="date-input" type="date" name="toDate" wire:model="toDate" placeholder="date">
              </div>
        </div>
        <div class="col-md-1 " >
            <div class="form-group">
                <label for="">Generate</label>

                <button type="submit" class="btn btn-md btn-primary  my-auto form-control" >PDF</button>

            </div>

        </div>
    </div>
    </form>


    <table class="table table-responsive-lg table-striped" >
                      
        <tbody>
            <thead>
                <tr>
                <th>Queue Id</th>
                <th>Service</th>
                <th>Ticket #</th>
                <th>Time</th>
                <th>Date</th>
                <th>Status</th>
                </tr>
                </thead>
            @foreach ($queues as $queue )
                
        <tr>
        <td>{{$queue->queue_id}}</td>
        <td>{{$queue->getServiceRelation->name}}</td>
        <td>{{$queue->getServiceRelation->prefix .' - '.$queue->ticket_number}}</td>
    
       
        <td>{{$queue->created_at->format('h:i:s A')}}</td>
        <td>{{$queue->created_at->format('m-d-Y')}}</td>
        @if ($queue->called == true)
        <td class="font-weight-semibold">&nbsp;<span class="badge badge-info">{{'Called ' .$queue->updated_at->diffForHumans($queue->created_at)}}</span></td>
        
        @else
        <td><span class="badge badge-warning">Not Called</span></td>
        {{-- <td><span class="badge badge-info">{{$averageCompletionTime}}</span></td> --}}


        @endif
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

