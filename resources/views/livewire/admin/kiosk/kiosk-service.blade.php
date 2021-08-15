<div>

    
    <style>
        .container {
            margin: 0 auto;
            font-size: 0;
        }
        .grid-item{
            width:250px;
            height: 70px;
            margin:4px;
        }  
    </style>
    <style>
        @media print
       {
           body * {
       visibility: hidden;
        }
   
     #not-print * {
       display: none;
     }
   
     #to-print, #to-print * {
       visibility: visible;
     }
   
     #to-print {
       display: block !important;
       position: absolute;
       left: 0 !important;
       top: 0 !important;
       width: 100%;
       height: 100%;
     }
       }
     .btn-queue{
         font-size: 35px;
         padding: 10px 55px !important;
     }
       .btn-title{
           text-align: center
       }
   
       .print-div{
           width: 100%;
           text-align: center;
           color: rgb(0, 0, 0);
           align-items: center;
           justify-content: center;
       }
   
       .ticket-number{
           font-size: 70px;
           font-weight: bold;
   
       }
       .title{
           font-size: 45px;
           font-weight: 100;
           margin-top: 20px;
           letter-spacing: 2px;
       }
       .more-details{
           align-items: center;
           width: 50%;
           position: relative;
           text-transform: uppercase;
           left: 26%;
           letter-spacing: 1px;
           font-size: 19px !important;
       }
       h1{
           margin-top: 10px;
       }
       h4{
           margin-top: -20px;
       }
       
     .sweet-alert{
       padding: 0 !important;
     }
      </style>
    {{-- <div class="form-group ">
        <button class="btn btn-md btn-primary" type="button" data-toggle="modal" data-target="#counternModal"> Add New Counter</button>
    </div> --}}
    <div class="fade-in">
        <div class="wrapper d-flex align-items-center" style="height: 100vh;">
                <div class="m-5 p-5" style="width:100%">
                    <div class="col-md-12">
                        <h2><span class="text-muted">{{$department->department_name}}</span>  
                            <svg class="c-icon ">
                            <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-chevron-right')}}"></use>
                            </svg>&nbsp; Select Services</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis est necessitatibus, pariatur sed earum expedita?</p>
                    </div>
                
                    <div class="container mt-5 p-4">
                    
                        <div class="col-md-12 ">
                        {{-- <a class="grid-item btn btn-lg btn-pill btn-primary"  href="{{route('admin.displays.services',$department->id)}}">{{$department->department_name}}</a> --}}
                            @foreach ($services as $service)
                            @if ($service->is_active)
                            <a wire:click.prevent="getTicketDetails({{$service}})">
                            <button class="grid-item btn btn-lg btn-pill btn-info" type="button">{{$service->name}}</button>
                            </a>
                            @endif
                            @endforeach
                        
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{route('kiosk.departments')}}">
                            <button class="btn btn-md btn-outline-dark px-4" type="button">
                                <svg class="c-icon mr-3">
                                <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-arrow-circle-left')}}"></use>
                                </svg>&nbsp;Back
                            </button>
                        </a>
                    </div>
                </div>
        </div>
        

        <div class="modal fade" id="kioskModal"  data-backdrop="static" tabindex="-1" aria-labelledby="myModalLabel"  aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                        {{-- <div class="modal-header">
                            <h4 class="modal-title">Confirm</h4>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div> --}}
                        <div class="modal-body print-div " id="to-print">
                            <style>
                                .form-control {
                                    font-size: 20px;
                                    text-align: center;
                                }
                                h1{
                                    font-size:40px;
                                }
                            </style>
                            {{-- <h5>Confirm Ticket</h5> --}}
                                <p>{{settings('system_name')}}</p>
                                <div class="bg-primary text-white rounded py-4">
                                <h4 class="text-center">Ticket no.</h4>
                                @if (!$firstQueue)
                                <h1 class="text-center ">{{$servicePrefix}} - {{ $serviceDefault + 1}}</h1>
                                @else
                                <h1 class="text-center ">{{$servicePrefix}} - {{ $firstQueue->ticket_number + 1}}</h1> 
                                @endif
                                </div>
                                <hr>
                                <label for="" class="text-muted text-left">Department / Service</label>
                                <input class="form-control border-0 bg-white text-dark" type="text" value="{{$department->department_name . ' / ' . $serviceName}}" readonly>  
                                <label class="text-muted" for="">Date/Time Created:</label>
                                <input class="form-control border-0 bg-white text-dark " type="text" value="{{now()->format(' F d, Y / g:i:s A ')}}" readonly>  
                                <label class="text-muted" for="">Total Waiting</label>
                                <input class="form-control border-0 bg-white text-dark " type="text" value="{{$waitingQueue}}" readonly>  
                                {{-- <h3>Time Created: {{now()->format('g:i:s a')}}</h3>
                                <h3>Type: {{$service->name}}</h3>
                                <h3>On queued: {{$waitingQueue->count()}}</h3> --}}
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary btn-lg" type="button" data-dismiss="modal">Close</button>
                              <x-button wire:click.prevent="storeQueue" class="btn-lg px-4" onclick="printing()" >
                                <svg class="c-icon mr-2">
                                <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-print')}}"></use>
                                </svg>&nbsp;Get Ticket</x-button>
                        </div>
                </div>
            </div>
            
        </div>
        <script>

            function printing() {
                window.print();
            
              
            
            }
            
            </script>
    </div>
  <!-- Modal -->
 
  {{-- <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"> <h5>Delete User</h5></div>
            <div class="modal-body">
                <h4>Are you sure you want to delete this user?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-2"></i> Cancel</button>
                <button type="button" wire:click.prevent="deleteUser" class="btn btn-danger"><i class="fa fa-trash mr-2"></i>Delete User</button>
              </div>
        </div>
    </div>
    </div> --}}
</div>
    