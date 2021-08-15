<div>

    <div class="card rounded">
        <div class="card-header  d-flex align-items-center justify-content-between"><span class="">Average Status</span> 
            <div class="float-right">
                <select class="form-control  d-flex align-items-center" wire:model="departmentId">
                    <option> All </option>
                    @foreach ($departments as $department)
                    <option value="{{$department->id}}">{{$department->department_name}}</option>
                    @endforeach
                </select>
            </div>
       
        </div>
        <div class="table-responsive">
        <table class="table table-borderless">
            <thead>
            <tr>
                <th scope="col">Service</th>
                <th scope="col">Avg Waiting</th>
                <th scope="col">Avg Processing</th>
                {{-- <th scope="col">Active Counters</th> --}}
            </tr>
            </thead>
            <tbody>
                @foreach ($services as $service)
                    <tr>
                        <td>{{$service->name}}</td>  
                        <td>{{number_format($service->averageWaiting,0)}} <small>minute(s)</small></td>
                        <td>{{number_format($service->averageProcessing,0)}} <small>minute(s)</small></td>
                        {{-- <td class="text-danger">High</td> --}}
                      </tr>
                @endforeach
           
            </tbody>
        </table>
        </div>
    </div>


</div>
