
<div>
    <div class="row ">
        <div class="col-md-5">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Filter by: Department</label>
                <select class="form-control" id="exampleFormControlSelect1">
                  <option>-- Select Department</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                </select>
              </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Filter by: Status</label>
                <select class="form-control" id="exampleFormControlSelect1">
                  <option>-- Select category</option>
                  <option value="1">Active</option>
                  <option value="0">Inactive</option>
                </select>
              </div>
        </div>
        <div class="col-md-2 " >
            <div class="form-group">
                <label for="">Generate</label>

                <a href="{{route('admin.departments.pdf')}}" class="btn btn-md btn-primary  my-auto form-control" >PDF</a>
            </div>

        </div>
    </div>

    

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


            <form id="" style="display: inline-block" action="{{route('admin.services.destroy',[$service])}}" method="POST">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('{{__('Counter designated from this service will be deleted also, Are you sure you want to delete this service?')}}')" class="btn btn-sm btn-danger" type="submit"> Delete</button>

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

