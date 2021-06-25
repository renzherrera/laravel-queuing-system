
<div>
    <a  class="btn btn-xl btn-info mb-2 ml-1" href="{{route('admin.services.create')}}">Create New Service</a>
    <a  class="btn btn-xl btn-warning mb-2 ml-1" href="{{route('admin.services.create')}}">Transaction Reports</a>

    <form action="{{route('admin.services.pdf',$departmentId)}}">
    <div class="row ">
        <div class="col-md-5">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Filter by: Department</label>
                <select class="form-control" id="departmentId" wire:model ="departmentId" name="departmentId">
                  <option value="x">-- Select Department</option>
                  @foreach ($departments as $department)
                  <option value="{{$department->id}}">{{$department->department_name}}</option>
                      
                  @endforeach
                </select>
              </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Filter by: Status</label>
                <select class="form-control" id="status" wire:model="status" name="status">
                  <option value="x">-- Select status</option>
                  <option value="1">Active</option>
                  <option value="0">Inactive</option>
                </select>
              </div>
        </div>
        <div class="col-md-2 " >
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

