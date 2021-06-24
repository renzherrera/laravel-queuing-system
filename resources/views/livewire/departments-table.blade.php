
<div>
    <form action="{{route('admin.departments.pdf',$status)}}">
    <div class="row ">
        <div class="col-md-5">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Filter by: Status</label>
                <select class="form-control"  wire:model="status" name="status" id="status">
                  <option value="3">-- Select category</option>
                  <option value="1">Active</option>
                  <option value="0">Inactive</option>
                </select>
              </div>
        </div>
        <div class="col-md-1" >
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
                <th>Name of Department</th>
                <th>Status</th>
                <th>Actions</th>
                </tr>
                </thead>
            @foreach ($departments as $department )
                
        <tr>
        <td>{{$department->department_name}}</td>
        @if ($department->is_active)
        <td><span class="badge badge-success">Active</span></td>
        @else  
        <td><span class="badge badge-secondary">Inactive</span></td>

        @endif
        <td>
            <a class="btn btn-sm btn-primary" href="{{route('admin.departments.edit',[$department])}}">{{__('Edit')}}</a>
            <form style="display: inline-block" action="{{route('admin.departments.destroy',[$department])}}" method="POST">
                @csrf
                @method('DELETE')
            <button onclick="return confirm('{{__('Are you sure you want to delete this department?')}}')" class="btn btn-sm btn-danger" type="submit"> Delete</button>
            </form>
        </td>
     
        </tr>
        @endforeach
        
        </tbody>
        </table>
        <div class="card-footer">
            {{ $departments->links('pagination')}}
    
            </div>
</div>
