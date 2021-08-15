<!DOCTYPE html>
<html>
<head>
    <style>
        div.page_break + div.page_break{
        page-break-before: always;
    }

table {
  width: 100%;
  margin-top: 40px;
}
.table{
            table-layout: fixed !important;
    
}

h4{
  
   /* font-family: Arial, Helvetica, sans-serif; */
}
</style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.2/css/bootstrap.min.css" />
    <title>QMS | Users</title>
</head>
<body>

    {{-- @foreach ($results as $services) --}}
            
            {{-- <div class="header-text ">
                <h2 >{{settings('system_name')}}</h2>
                <h3 >{{settings('sub_name')}} </h3>
                <h4 class="title" >List of Services</h4>
            </div> --}}
            <div class="form-row" style="height: 10px">
                <h4 class="" style="position:fixed; left: 42%; z-index:99999">List of Users</h4>

            </div>

    <table class="table table-responsive-lg table-striped" >
                      
        <tbody>
            <thead>
                <tr>
                <th width="50px">Id</th>
                <th>Name</th>
                <th width="300px">Email</th>
                <th width="80px">Counter</th>
                <th>Role</th>
                <th>Status</th>
                </tr>
                </thead>
      
                @foreach ($users as $user )
                
                <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td class="text-center">{{$user->counters->counter_number}}</td>
                @if ($user->is_admin)
                <td>Admin</td>
                @else
                <td style="color: red">User</td>
              @endif
                @if ($user->is_active)
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
      {{-- @endforeach --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.2/js/bootstrap.min.js" ></script>
  
</body>
</html>