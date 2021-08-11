<div>

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
    </style>
   
     
                <div class="card">
                    <div class="card-header">
                        @if ($userCounter)
                        <h4 class="text-center call-header">
                            {{ 'Broadcast - '. $userCounter->counters->counter_name.
                        ' - ' .$userCounter->counters->services->name  }}
                        <input type="hidden" id="counter_id" value="{{$userCounter->counters->counter_name}}">
                        </h4>
                          @elseif(!$userCounter)
                          <h4 class="text-center call-header">
                            {{ 'Broadcast - Counter - Service ' }}
                        </h4>
                    @endif
                        
                    </div>

                    <div class="card-body" >
                        <form method="POST" action="{{ route('login') }}" wire:poll.3000ms>
                            @csrf
    
                            <div class="form-group row text-center">
                                <div class="col-md-4">
                                    <label for="email" class="col-md-6 col-form-label text-info text-md-center call-label">{{ __('Waiting') }}</label>
                                    <label for="total_waiting" class="col-md-6 col-form-label text-xl-center text-info"><h1 class="call-number-label" >{{ $waitingQueues}}</h1></label>
                                                                  
    
                                </div>
                                <div class="col-md-4">
                                    <label for="email" class="col-md-6 col-form-label text-md-center text-success call-label">{{ __('Served') }}</label>
                                    <label for="total_served" class="col-md-6 col-form-label text-xl-center text-success"><h1 class="call-number-label">{{ $queueServed }}</h1></label>
                                </div>
                                <div class="col-md-4">
                                    <label for="email" class="col-md-6 col-form-label text-md-center text-dark call-label">{{ __('Missed') }}</label>
                                    <label for="total_served" class="col-md-6 col-form-label text-xl-center text-dark"><h1 class="call-number-label">{{  $missed  }}</h1></label>
                                </div>
    
    
                                
                            </div>
    
                          
    
                            <div class="form-group row text-center">
                                <label for="password" class="col-md-12 col-form-label text-md-center"><h1>{{ __('NOW SERVING') }}</h1></label>
                                <label for="ticket_number" class="col-md-12 col-form-label text-md-center text-info "><h1 class="ticket-label" id="number">

                                    {{-- GET QUEUE TO VOICE MESSAGE WHO HAS NOT CALLED--}}
                                    @if ($firstqueue)
                                    <input type="hidden" id="ticket_number"  value="{{ $userCounter->counters->services->prefix .'-'. $firstqueue->ticket_number }}" readonly>
                                    @endif

                                    {{-- data for now serving --}}
                                    @if ($nowServing)
                                    {{$userCounter->counters->services->prefix.'-'. $nowServing->queues->ticket_number }}
                                    <input type="hidden" id="prev_ticket_number"  value="{{ $userCounter->counters->services->prefix.'-'. $nowServing->queues->ticket_number }}" readonly>
                                    <input type="hidden" name="queue_id" value="{{$nowServing->queue_id }}" readonly>

                                    @else
                                    0
                                    @endif

                                </h1></label>
                                <label for="password" class="col-md-12 col-form-label text-md-center text-warning">
                                <h3>
                                        {{$calls}}
                                call(s) attempt.
                                </h3></label>
                        
                            </div>
    
                            <div class="form-group row">
                                <div class="col-md-6 text-center ">
                                    {{-- <button class="btn btn-primary" type="button">
                                        <svg class="c-icon">
                                        <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-truck')}}"></use>
                                        </svg>&nbsp;Standard Button
                                        </button> --}}
                                    <button id="servedBtn"  wire:click.prevent="served()"  class="btn btn-success call-btn text-white font-weight-bold" @if (!$disableButton)
                                    disabled
                                   @endif>
                                          <svg class="c-icon">
                                            <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-check')}}"></use>
                                          </svg>&nbsp;&nbsp;Served</button>
                                    <button wire:click.prevent="noShow()" id="noShowBtn"  class="btn btn-secondary call-btn   font-weight-bold"   @if (!$disableButton)
                                    disabled
                                   @endif>
                                        <svg class="c-icon">
                                            <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-x-circle')}}"></use>
                                          </svg>&nbsp;&nbsp;No Show</button>
                                        
                                  
                                </div>
                                <audio id="audio" src="{{ asset("storage/sounds/ding.mp3")}}" autoplay="false" ></audio>
                                <div class="col-md-6 text-center">
                                    <button wire:click.prevent="callAgain()" onclick="replaySound();" id="callAgainBtn" class="btn btn-warning call-btn font-weight-bold text-white" @if (!$disableButton)
                                    disabled
                                   @endif >
                                        Re-call<svg class="c-icon ml-2">
                                            <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-reload')}}"></use>
                                          </svg></button>
                                    <button id="nextBtn"  onclick="playSound();" wire:click.prevent="call()"  
                                    class="btn btn-info call-btn text-white font-weight-bold"
                                     @if ($disableButton OR !$waitingQueues)
                                     disabled
                                    @endif>
                                        Next&nbsp;&nbsp;<svg class="c-icon">
                                            <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-chevron-double-right')}}"></use>
                                          </svg></button>
                                       

                                </div>
                            </div>
    
                           
                        </form>
                    </div>
                </div>
                
                <script>
                    
                     
                    
                    function playSound() {
                       

                    let counter = document.getElementById("counter_id").value
                    let text=  document.getElementById("ticket_number").value;
                    var sound = document.getElementById("audio");
                    sound.play();
                    
                    messageVoice = ("TicketNumber "+ text + "Please proceed to " + counter);
                      responsiveVoice.speak(messageVoice);
                      
            
                  }

                   
                  function replaySound() {
                       

                       let counter = document.getElementById("counter_id").value
                       let text=  document.getElementById("prev_ticket_number").value;
                       var sound = document.getElementById("audio");
                       sound.play();
                       
                       messageVoice = ("TicketNumber "+ text + "Please proceed to " + counter);
                         responsiveVoice.speak(messageVoice);
                         
               
                     }






                  
                </script>

                {{-- <script>
                    let utterance = new SpeechSynthesisUtterance("Hello world!");
                    speechSynthesis.speak(utterance);
                </script> --}}