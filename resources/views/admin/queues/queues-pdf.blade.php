<!DOCTYPE html>
<html>
<head>
    <style>
        div.page_break + div.page_break{
        page-break-before: always;
    }

table {
  border-collapse: collapse;
  width: 100%;
  font-family: Arial, Helvetica, sans-serif;
  margin-top: -150px;
}
thead{
    height: 219px;
    border: 0.1em solid #ccc;
}
th, td {
  text-align: left;
  padding: 10px;
}

tr:nth-child(even) {background-color: #f2f2f2;}

.logo {
    margin-bottom: 25px;
    margin-left: 0;
    position: relative;
}
h3{
    font-size: 15px !important;
    position: relative;
    top: -20% !important;
   left: 35% !important;
   font-weight: 100;
   font-family: Arial, Helvetica, sans-serif;
   color: rgb(102, 102, 102);
   opacity: 0.6;
}
h2{
    font-size: 20px !important;
    position: relative;
    top: -17% !important;
   left: 25% !important;

}
h4{
    font-size: 18px !important;
    position: relative;
    top: -17% !important;
   left: 40% !important;
   font-weight: 100;
   font-family: Arial, Helvetica, sans-serif;
}
</style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.2/css/bootstrap.min.css" />
    <title>QMS | Queues</title>
</head>
<body>

    @foreach ($results as $queues)
    <div class="header-container page_break">
            <div class="logo ">
                <img style="width: 150px;   margin-left: -10px;" src="{{ asset("storage/images/sf-logo.png")}}"/>
            </div>
            <div class="header-text ">
                <h2 >Municipality of San Fernando, Pampanga</h2>
                <h3 >Queueing Management System </h3>
                <h4 class="title" >List of Queues</h4>
            </div>
    </div>
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
                <td class="font-weight-semibold"> 
                <span class="badge {{ $queue->updated_at->diffInMinutes($queue->created_at) > 30 ? "badge-danger" : "badge-success" }}">{{'Called '.$queue->updated_at->diffForHumans($queue->created_at)}}</span></td>
                
                @else
                <td><span class="badge badge-warning">Waiting</span></td>
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
     

        

      </table>
      @endforeach

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.2/js/bootstrap.min.js" ></script>
  
</body>
</html>