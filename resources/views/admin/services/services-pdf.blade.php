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
    margin-left: 2%;
    position: relative;
}
h3{
    font-size: 15px !important;
    position: relative;
    top: -18% !important;
   left: 35% !important;
   font-weight: 100;
   font-family: Arial, Helvetica, sans-serif;
   color: rgb(102, 102, 102);
   opacity: 0.6;
}
h2{
    font-size: 20px !important;
    position: relative;
    top: -15% !important;
   left: 25% !important;

}
h4{
    font-size: 18px !important;
    position: relative;
    top: -15% !important;
   left: 40% !important;
   font-weight: 100;
   font-family: Arial, Helvetica, sans-serif;
}
</style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.2/css/bootstrap.min.css" />
    <title>QMS | Services</title>
</head>
<body>

    @foreach ($results as $services)
    <div class="header-container page_break">
            <div class="logo ">
                <img style="width: 150px;   margin-left: -10px;" src="{{ asset("storage/logo/" . $settings->logo)}}"/>
            </div>
            <div class="header-text ">
                <h2 >{{$settings->system_name}}</h2>
                <h3 >{{$settings->sub_name}} </h3>
                <h4 class="title" >List of Services</h4>
            </div>
    </div>
    <table class="table table-responsive-lg table-striped" >
                      
        <tbody>
            <thead>
                <tr>
                <th>Id</th>
                <th>Service</th>
                <th>Department</th>
                <th>Status</th>
                </tr>
                </thead>
      
                @foreach ($services as $service )
                
                <tr>
                <td>{{$service->id}}</td>
                <td>{{$service->name}}</td>
                <td>{{$service->department_name}}</td>
                @if ($service->is_active)
                  <td>Active</td>
                  @else
                  <td style="color: red">Inactive</td>
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