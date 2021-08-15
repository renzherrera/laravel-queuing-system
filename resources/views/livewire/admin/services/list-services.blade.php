
<div>
  {{-- <x-page-loading></x-page-loading> --}}

    <title>Services List | {{ settings('system_name') }}</title>
        <div class="c-subheader px-3">

            <ol class="breadcrumb border-0 m-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item">Services</li>

            
            </ol>
        </div>

        <div class="container-fluid">
            <div class="fade-in">
                <div class="row mt-4">
                    <div class="col-md-12">
                        <h4>List of Services</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class=" d-flex align-items-end justify-content-end">
                            
                            <div class="form-group ">
                                @if ($selectedRows)
                        
                            <div class="btn-group ml-2 mr-2 float-left">
                                <button type="button" class="btn btn-secondary">
                                Bulk Action
                                <small class="ml-1 badge badge-light ">SELECTED <span class="badge badge-pill badge-primary">{{count($selectedRows)}}</span></small>
                                </button>
                                <button type="button" class="btn btn-secondary dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu" style="">
                                <a class="dropdown-item" wire:click.prevent = "deleteSelectedRows" href="#">Delete Selected</a>
                                <a class="dropdown-item" wire:click.prevent = "markActive" href="#">Mark as Active</a>
                                <a class="dropdown-item" wire:click.prevent = "markInactive" href="#">Mark as Inactive</a>
                                <a class="dropdown-item" wire:click.prevent = "createPDF" href="#">Export</a>
                                </div>
                            </div>
                            @endif
                                <button  wire:click.prevent= "addNewService" class="btn btn-md btn-primary" type="button"> New Service</button>
                            </div>
                        </div>
                        {{-- <form action="{{route('admin.departments.pdf',$status)}}">
                            <div class="row d-flex justify-content-between">
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
                                <div class="col-md-6 d-flex align-items-end justify-content-end">
                                    <div class="form-group ">
                                        <button  wire:click ="addNewDepartment" class="btn btn-md btn-primary" type="button" data-toggle="modal" data-target="#departmentModal"> Create Department</button>
                                    </div>
                                </div>
                            </div>
                        

                        </form> --}}
                        <div class="card">
                            {{-- <div class="card-header"><i class="fa fa-align-justify"></i><h4>{{__('List of Departments')}}</h4></div> --}}

                                <table class="table table-responsive-sm table-hover table-outline mb-0">
                                    <thead class="thead-white">
                                    <tr>
                                    {{-- <th class="text-center">
                                    <svg class="c-icon">
                                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-people"></use>
                                    </svg>
                                    </th> --}}
                                    <th class="">
                                        <div class="icheck-primary d-inline ml-2">
                                          <input class="" type="checkbox" value="" name="todo2" id="todoCheck2" wire:model="selectPageRows">
                                          <label for="todoCheck2"></label>
                                        </div>
                                    </th>
                                    <th>#</th>
                                    <th class="text-center">Service Name</th>
                                    <th class="text-center">Prefix & Default # </th>
                                    <th class="text-center">Department</th>
                                    <th class="text-center">Avg Waiting Time</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                    {{-- <th>Usage</th>
                                    <th class="text-center">Payment Method</th>
                                    <th>Activity</th> --}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($services as $service)
                                    <tr>
                                        {{-- <td class="text-center">
                                            <div class="c-avatar"><img class="c-avatar-img" src="assets/img/avatars/1.jpg" alt="user@email.com"><span class="c-avatar-status bg-success"></span></div>
                                        </td> --}}

                                    <th style="width:10px;" scope="row">
                                        <div class="icheck-primary d-inline ">
                                        <input type="checkbox" wire:model = "selectedRows" value="{{ $service->id }}" name="todo2" id="{{$service->id}}">
                                        <label for="{{$service->id}}"></label>
                                        </div>
                                    </th>

                                    <td>
                                    <div>{{$service->id}}</div>
                                    {{-- <div class="small text-muted">Created: {{$counter->created_at->format('F d, Y')}}</div> --}}
                                    </td>
                                    <td class="text-center">{{$service->name}}</td>
                                    <td class="text-center">{{$service->prefix . ' - ' . $service->default_number  }}</td>
                                    <td class="text-center">{{$service->department_name}}</td>
                                    <td class="text-center">{{$service->averageWaiting}}</td>

                                    @if ($service->is_active)
                                    <td class="text-center"><span class="badge badge-success">Active</span></td>
                                    @else  
                                    <td class="text-center"><span class="badge badge-secondary">Inactive</span></td>
                                    @endif
                                    <td class="text-center">
                                        <button wire:click.prevent="edit({{ $service }})" class="btn btn-sm btn-light" type="button">
                                            <svg class="c-icon text-dark">
                                            <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-pencil')}}"></use>
                                            </svg>
                                        </button>
                                        <button  wire:click.prevent="confirmServiceRemoval({{ $service->id }})"  class="btn btn-sm btn-light" type="button">
                                            <svg class="c-icon text-danger">
                                            <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-trash')}}"></use>
                                            </svg>
                                        </button>
                                       
                                    </td>
                                    {{-- <td class="text-center">
                                    <svg class="c-icon c-icon-xl">
                                    <use xlink:href="vendors/@coreui/icons/svg/brand.svg#cib-cc-mastercard"></use>
                                    </svg>
                                    </td>
                                    <td>
                                    <div class="small text-muted">Last login</div><strong>10 sec ago</strong>
                                    </td> --}}
                                    </tr>
                                @endforeach
                                    </tbody>
                                </table>
                            
                            
                        </div>
                        {{ $services->links('pagination')}}
                     </div>
                
                    </div>
                </div>
            </div>


        <!------Modal ------>

        <div class="modal fade" id="serviceModal" tabindex="-1" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form wire:submit.prevent = "{{$editMode ? 'confirmServiceUpdate' : 'createService'}}" >
                        @csrf
                        <div class="modal-header">
                            <h4 class="modal-title">{{$editMode ? __('Edit Service') : __('New Service')}}</h4>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                        
                                            <div class="form-group">
                                                <label for="name">{{__('Service Name')}}</label>
                                                <input wire:model.defer="state.name" class="form-control @error('name') is-invalid @enderror" name="name" type="text" placeholder="{{__('Service Name')}}">
                                                @error('name')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                                
                                            </div>
                                            <div class="form-group">
                                                <label for="prefix">{{__('Ticket Prefix')}}</label>
                                                <input wire:model.defer="state.prefix" class="form-control @error('prefix') is-invalid @enderror" name="prefix" type="text" placeholder="{{__('Prefix')}}">
                                                @error('prefix')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div> 
                                            <div class="form-group">
                                                <label for="default_number">{{__('Default Number')}}</label>
                                                <input wire:model.defer="state.default_number" class="form-control @error('default_number') is-invalid @enderror" name="default_number" type="text" placeholder="{{__('Default Ticket #')}}">
                                                @error('default_number')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div> 
                                            <div class="form-group">
                                                <label for="department_id">{{__('Department')}}</label>
                                                <select wire:model.defer="state.department_id" class="form-control @error('department_id') is-invalid @enderror" name="department_id" type="text" >
                                                <option value="">--- Select Department --</option>
                                            
                                                @foreach ($departments as $department)
                                                <option value="{{$department->id}}">{{$department->department_name}}</option>
                                                @endforeach
                                                </select>
                                                @error('service_id')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div> 

                                            <div class="form-group">
                                                <label for="status">{{__('Status')}}</label>
                                                <select wire:model.defer="state.is_active" class="form-control @error('is_active') is-invalid @enderror" name="is_active" type="text" placeholder="{{__('Deparment Status')}}">
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                                @error('is_active')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div> 
                                  

                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                              <x-button type="submit">{{!$editMode ? 'Save Service' : 'Save Changes'}}</x-button>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
        <x-confirmation-alert> </x-confirmation-alert>
            

</div> <!--End of div for livewire component-->