   
   <div>
       <title>Call | {{settings('system_name')}}</title>
    <style>
        .call-header{
            font-size: 1.5rem;
            margin: 25px 0px 25px 0px;
        }
        .call-btn{
            padding:15px 25px 15px 25px;
            width: 75%;
            margin-top: 5%;
            margin-bottom: 10%;
            font-size: 15px;
        }
        .call-label{
            font-size: 1.2rem;
            width: 100%
        }
        .call-number-label{
            font-size: 4.5rem;
        }
        .ticket-label{
            font-size: 3.5rem;
            letter-spacing: 10px;
        
        }
        .col-md-4{
            width: 100% !important;
            padding: 0;
        }
        h3{
            font-size: 34px !important;
        }
        h2{
            font-size: 48px;
        }
        .card-top
        {
            height: 20vh;
        }
    </style>
        <div class="container-fluid" wire:poll.3000ms>
            <div class="row m-4" >
                <audio id="audio" src="{{ asset("storage/sounds/ding.mp3")}}"  ></audio>
                <input type="hidden" id="counter_id" value="{{auth()->user()->counters->counter_number}}">
                    <div class="col-xl-4 ">
                        <div class="card card-top" >
                            <div class="card-text  d-flex justify-content-center align-items-center m-3" >
                                <h4>COUNTER</h4>
                            </div>
                            <div class="card-text  d-flex justify-content-center align-items-center" >
                                <h2 class="text-success"><strong>{{auth()->user()->counters->counter_number ?? 'N/A'}}</strong></h2>
                            </div>
                        </div>
                     


                    </div>
                    <div class="col-xl-4">
                        <div class="card card-top" >
                            <div class="card-text  d-flex justify-content-center align-items-center m-3" >
                                <h4>Department</h4>
                            </div>
                            <div class="card-text  d-flex justify-content-center align-items-center" >
                                <h3 class="text-info"><strong>{{auth()->user()->counters->services->departments->department_name ?? 'N/A'}}</strong></h3>
                            </div>
                            <h4 class="text-center">{{auth()->user()->counters->services->name ?? 'N/A'}}</h4>
                            
                        </div>

                        
                    </div> <!--End if second column--->

                    <div class="col-xl-4">
                        <div class="card card-top " >
                            <div class=" d-flex justify-content-center align-items-center m-3" >
                                <h4>ACTIVE TICKET #</h4>
                            </div>
                            <div class="card-text  d-flex justify-content-center align-items-center" >
                                <strong>

                                    @if($activeTicket)
                                    <h1 class="ticket-label text-success" style="font-weight: 900" id="number">

                                    {{$activeTicket->queues->getServiceRelation->prefix .' - '. $activeTicket->queues->ticket_number}}
                                    </h1>
                                        <input type="hidden" id="ticket_number"  value="{{  $activeTicket->queues->getServiceRelation->prefix .' - '. $activeTicket->queues->ticket_number }}" readonly>
                                        <input type="hidden" id="prev_ticket_number"  value="{{ $activeTicket->queues->getServiceRelation->prefix .'-'. $activeTicket->queues->ticket_number  }}" readonly>
                                        <input type="hidden" name="queue_id" value="{{$activeTicket->queues->queue_id }}" readonly>

                                    @else
                                    <h1 class="ticket-label text-success" style="font-weight: 900" id="number"> N/A </h1>
                                    @endif

                                </strong>
                               
                            </div>
                            @if ($calls > 0)
                                <label for="password" class="col-md-12 col-form-label text-md-center text-warning">
                                    <h4>
                                            {{$calls}}
                                    call(s) attempt.
                                </h4></label>
                            @endif
                            
                        </div>
                        

                    </div>

            </div>

            <div class="row  mx-4 " style="margin-top: -20px;">
                    <!----button-->
                    <div class="col-md-4 col-sm-12 px-3">
                        <button wire:click.prevent ="standBy()" class="btn {{$standByMode ? 'btn-danger' : 'btn-dark'}}   d-flex justify-content-center align-items-center" style="width: 100%; height:10vh;" >
                                <h4 style="width: 100%">
                                    @if ($standByMode)
                                    <svg class="c-icon c-icon-xl mr-2" >
                                        <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-lock-unlocked')}}"></use>
                                    </svg>Switch to Queue mode
                                    @else
                                    <svg class="c-icon c-icon-xl mr-2" >
                                        <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-lock-locked')}}"></use>
                                    </svg>Switch to Stand-by Mode
                                    @endif
                                    </h4>
                        </button>
                    </div>

                    

                       <!----button-->
                   
                     <div class="col-md-2 col-sm-12 px-3">
                        <button @if($disableButton) disabled @endif
                        wire:click.prevent="noShow()" id="noShowBtn"  class="btn btn-secondary   d-flex justify-content-center align-items-center" style="width: 100%; height:10vh;"  > 
                                <h4><svg class="c-icon c-icon-xl">
                                    <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-x-circle')}}"></use>
                                  </svg>&nbsp;&nbsp;No Show</h4>
                        </button>
                     </div>

                     <div class="col-md-2 col-sm-12 px-3">
                        <button @if($disableButton) disabled @endif
                        wire:click.prevent="served()" class="  btn btn-success d-flex justify-content-center align-items-center" style="width: 100%; height:10vh;"  >
                           
                            <svg class="c-icon c-icon-xl">
                                <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-check')}}"></use>
                              </svg>&nbsp;&nbsp; <h4>Served</h4>

                        </button>
                     </div>

                     
                    <div class="col-md-2 col-sm-12 px-3">
                            <button wire:click.prevent="callAgain()"  id="callAgainBtn" @if($disableButton) disabled @endif 
                            class="  btn btn-facebook  d-flex justify-content-center align-items-center" style="width: 100%;height:10vh;"> 
                               <svg class="c-icon c-icon-xl mr-2">
                                    <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-reload')}}"></use>
                                  </svg> <h4>Call Again</h4>
                            </button>
                    </div>
                    <div  class="col-md-2 col-sm-12 px-3">
                        <button id="nextBtn"  wire:click.prevent="call()"  @if($nextDisableButton) disabled @endif
                        class=" btn btn-info  d-flex justify-content-center align-items-center" style="width: 100%; height:10vh;" >
                                <h4>Next Call &nbsp;&nbsp;<svg class="c-icon c-icon-xl">
                                    <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-chevron-double-right')}}"></use>
                                  </svg></h4>
                        </button>
                    </div>
                    
                </div>

            </div>

            <!--end Row--->


            <div class="row mx-5 my-4" >
                <div class="col-sm-12 col-lg-4">
                    <div class="card " style="max-height: 450px; min-height:450px;">
                        <div class="card-header bg-warning content-center">
                            <div class="text-white">
                                <h4 class="text-white m-2">Waiting</h4>
                                <h2 class="text-white">{{ $waitingQueues}}</h2>
                                <p>On Queues</p>
                            </div>
                            {{-- <svg class="c-icon c-icon-3xl text-white my-4">
                            <use xlink:href="vendors/@coreui/icons/svg/brand.svg#cib-facebook-f"></use>
                            </svg> --}}
                        </div>

                    <div class="pt-2 pb-2  col-sm-12">
                        <table class="table  table-responsive-sm table-striped table-outline mb-0" style="margin:auto">
                            <thead class="thead-light">
                            {{-- <tr>
                            <th>#</th>
                            </tr> --}}
                            </thead>
                            <tbody>
                            @foreach ($limitedWaiting as $queue)
                                <tr>
                                    <td> <div><strong>{{$queue->getServiceRelation->prefix . ' - ' . $queue->ticket_number}}</strong> </div></td>
                                    <td class="text-right">{{Carbon\Carbon::parse($queue->created_at)->diffForHumans()  }}</td>
                                </tr>
                            @endforeach
                            

                            
                            </tbody>
                        </table>
                        
                    </div>
                    <div class="card-footer">
                        <div class="btn btn-light" style="display: block">View All</div>
                    </div>
                    </div>
                   
                </div>
                
                
                <div class="col-sm-12 col-lg-4">
                    <div class="card " style="max-height: 450px; min-height:450px;">
                        <div class="card-header bg-primary content-center">
                            <div class="col m-2">
                                <div class="text-white">
                                    <h4 class="text-white m-2">Missed</h4>
                                    <h2 class="text-white">{{  $missed  }}</h2>
                                    <p>On Queues</p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-white">
                                    <h4 class="text-white m-2">Served</h4>
                                    <h2 class="text-white">{{  $queueServed  }}</h2>
                                    <p>On Queues</p>
                                </div>
                            </div>

                            {{-- <svg class="c-icon c-icon-3xl text-white my-4">
                            <use xlink:href="vendors/@coreui/icons/svg/brand.svg#cib-facebook-f"></use>
                            </svg> --}}
                        </div>

                    <div class="pt-2 pb-2  col-sm-12">
                        <table class=" table  table-responsive-sm table-striped table-outline mb-0" style="margin:auto">
                            <thead class="thead-light">
                            {{-- <tr>
                            <th>#</th>
                            </tr> --}}
                            </thead>
                            <tbody>
                                @foreach ($limitedCompletedQueue as $queue)
                                @if($queueCount)

                                <tr>
                                    <td>{{auth()->user()->counters->services->prefix . ' - ' .$queue->ticket_number}}</td>
                                    @if ($queue->missed != null && $queue->served ==null)
                                    <td class="text-danger float-right">Missed</td>
                                    @elseif ($queue->missed == null && $queue->served)
                                    <td class="text-primary float-right">Served</td>
                                    @else
                                    <td class="text-dark float-right">Pending</td>
                                    
                                    @endif
                                 

                                </tr>
                                @endif
                                @endforeach
                          
                        
                            </tbody>
                        </table>
                        
                    </div>
                    <div class="card-footer">
                        <div class="btn btn-light" style="display: block">View All (<strong> {{$completedQueue}} </strong>)</div>
                    </div>
                    </div>
                </div>


                <div class="col-sm-12 col-lg-4">
                    <div class="card " style="max-height: 450px; min-height:450px;">
                        <div class="card-header text-dark bg-gray-600 content-center">
                            <div class="text-white">
                                <h4 class="text-white m-2">Last Called</h4>
                                @if($lastCalled && $queueCount)
                                <h2 class="text-white">{{auth()->user()->counters->services->prefix.'-'. $lastCalled->queues->ticket_number }}</h2>
                                    @if ($lastCalled->queues->served==null)
                                    <p class=" badge badge-warning text-dark px-5 py-2">Missed</p>
                                    @elseif($lastCalled->queues->missed==null)
                                    <p class=" badge badge-info text-white px-5 py-2">Served</p>
                                    @else
                                    <p class="text-white badge badge-dark px-5 py-2">Pending</p>
                                    @endif
                                 @endif

                            </div>
                            {{-- <svg class="c-icon c-icon-3xl text-white my-4">
                            <use xlink:href="vendors/@coreui/icons/svg/brand.svg#cib-facebook-f"></use>
                            </svg> --}}
                        </div>

                        @php
                        if($lastCalled){
                           $calledTime = Carbon\Carbon::parse($lastCalled->queues->called);
                           $created_at = Carbon\Carbon::parse($lastCalled->queues->created_at);
                           $servedMissed = Carbon\Carbon::parse($lastCalled->queues->served == null ? $lastCalled->queues->missed : $lastCalled->queues->served);
                        }
                        @endphp
                    <div class="pt-2 pb-2  col-sm-12">
                        <table class=" table  table-responsive-sm  mb-0" style="margin:auto">
                            <thead class="thead-light">
                            {{-- <tr>
                            <th>#</th>
                            </tr> --}}
                            </thead>
                            <tbody>
                        @if($queueCount && $lastCalled)
                            <tr>
                                <td> <div>Total Waiting Time: <span class="float-right">{{$calledTime->diffForHumans($created_at,true,null)  }}</span> </div></td>
                            </tr>
                            <tr>
                                <td> <div>Queue Created: <span class="float-right">{{$lastCalled->queues->created_at->toFormattedDateTime()}} </span> </div></td>
                            </tr>
                            <tr>
                                <td> <div>Time Called: <span class="float-right">{{$lastCalled->queues->called->toFormattedDateTime()}} </span> </div></td>
                            </tr>
                            <tr>
                            <td> <div>Completed at: <span class="float-right">{{$servedMissed->toFormattedDateTime()}} </span> </div></td>
                            </tr>
                           

                            <tr>
                            <td ><div> Processing Time <span class="float-right">{{$calledTime->diffForHumans($servedMissed,true,null)}}</span> </div></td>
                           
                             </tr>

                        @endif
                            </tbody>
                        </table>
                        
                    </div>
                    {{-- <div class="card-footer">
                        <div class="btn btn-light" style="display: block">View All</div>
                    </div> --}}
                    </div>
                   
                </div>
                


        </div>
       
                    
        

</div>
