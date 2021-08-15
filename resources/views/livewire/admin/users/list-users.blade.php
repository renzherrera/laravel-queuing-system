
<div>
    <title>Users List | {{ settings('system_name') }}</title>
        <div class="c-subheader px-3">

            <ol class="breadcrumb border-0 m-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item">Users</li>

            
            </ol>
        </div>

        <div class="container-fluid">
            <div class="fade-in">
                <div class="row mt-4">
                    <div class="col-md-12">
                        <h4>List of Users   </h4>
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
                                    {{-- <a class="dropdown-item" wire:click.prevent = "export" href="#">Export</a> --}}
                                    </div>
                                </div>
                                @endif

                                <button  wire:click.prevent= "addNewUser" class="btn btn-md btn-primary" type="button">New User</button>
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
                                    <thead >
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
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th >Assigned Counter</th>
                                    <th class="text-center">Role</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                    {{-- <th>Usage</th>
                                    <th class="text-center">Payment Method</th>
                                    <th>Activity</th> --}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($users as $user)
                                    <tr>
                                        {{-- <td class="text-center">
                                            <div class="c-avatar"><img class="c-avatar-img" src="assets/img/avatars/1.jpg" alt="user@email.com"><span class="c-avatar-status bg-success"></span></div>
                                        </td> --}}
                                    <th style="width:10px;" scope="row">
                                        <div class="icheck-primary d-inline ">
                                        <input type="checkbox" wire:model = "selectedRows" value="{{ $user->id }}" name="todo2" id="{{$user->id}}">
                                        <label for="{{$user->id}}"></label>
                                        </div>
                                    </th>
                                    <td> <div>{{$user->id}}</div></td>
                                    <td><div>{{$user->name}}</div></td>
                                    <td>
                                    <div>{{$user->email}}</div>
                                    <div class="small text-muted">Created: {{$user->created_at->format('F d, Y')}}</div>
                                    </td>
                                    <td>{{$user->counters ? 'Counter '.  $user->counters->counter_number : 'No Counter Assigned'}}</td>
                                 
                                    @if ($user->is_admin)
                                    <td class="text-center"><span class="badge badge-primary">Administrator</span></td>
                                    @else  
                                    <td class="text-center"><span class="badge badge-warning">User</span></td>
                                    @endif
                                    @if ($user->is_active)
                                    <td class="text-center"><span class="badge badge-success">Active</span></td>
                                    @else  
                                    <td class="text-center"><span class="badge badge-secondary">Inactive</span></td>
                                    @endif
                                    <td class="text-center">
                                        <button wire:click.prevent="edit({{ $user }})" class="btn btn-sm btn-light" type="button">
                                            <svg class="c-icon text-dark">
                                            <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-pencil')}}"></use>
                                            </svg>
                                        </button>
                                        <button  wire:click.prevent="confirmUserRemoval({{ $user->id }})"  class="btn btn-sm btn-light" type="button">
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
                        {{ $users->links('pagination')}}
                    
                     </div>
                
                    </div>
                </div>
            </div>


        <!------Modal ------>

        <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form wire:submit.prevent = "{{$editMode ? 'confirmUserUpdate' : 'createUser'}}" >
                        @csrf
                        <div class="modal-header">
                            <h4 class="modal-title">{{$editMode ? __('Edit User') : __('New User')}}</h4>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            
                                            <div class="form-group">
                                                <label for="name">{{__('Name')}}</label>
                                                <input wire:model.defer="state.name" class="form-control @error('name') is-invalid @enderror" name="name" type="text" placeholder="{{__('Name')}}">
                                                @error('name')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div> 
                                            
                                            <div class="form-group">
                                                <label for="email">{{__('Email')}}</label>
                                                <input wire:model.defer="state.email" class="form-control @error('email') is-invalid @enderror" name="email" type="email" placeholder="{{__('Email Address')}}">
                                                @error('email')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div> 
                                            
                                            <div class="form-group">
                                                <label for="counter_id">{{__('Assigned Counter')}}</label>
                                                <select wire:model.defer="state.counter_id" class="form-control @error('counter_id') is-invalid @enderror" name="counter_id" type="text" placeholder="{{__('Assigned Counter')}}">
                                                  @foreach ($counters as $counter)
                                                    <option value="{{$counter->id}}">Counter {{$counter->counter_number}}</option>
                                                  @endforeach
                                                </select>
                                                @error('counter_id')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div> 
                                            
                                            <div class="form-group">
                                                <label for="status">{{__('Role')}}</label>
                                                <select wire:model.defer="state.is_admin" class="form-control @error('is_admin') is-invalid @enderror" name="is_admin" type="text" placeholder="{{__('User Role')}}">
                                                    <option value="0">User</option>
                                                    <option value="1">Administrator</option>
                                                </select>
                                                @error('is_admin')
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
                              <x-button type="submit">{{!$editMode ? 'Create Department' : 'Save Changes'}}</x-button>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
        <x-confirmation-alert> </x-confirmation-alert>
            

</div> <!--End of div for livewire component-->