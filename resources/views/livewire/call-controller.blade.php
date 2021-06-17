<div>

    <style>
        .call-header{
            font-size: 1.5rem;
            margin: 25px 0px 25px 0px;
        }
        .call-btn{
            padding:20px 25px 20px 25px;
            width: 75%;
            margin-top: 5%;
            margin-bottom: 10%;
            font-size: 19px;
        }
        .call-label{
            font-size: 1.8rem;
        }
        .call-number-label{
            font-size: 4.5rem;
        }
        .ticket-label{
            font-size: 3.5rem;
            letter-spacing: 10px;
        }
    </style>
   
     
                <div class="card"  >
                    <div class="card-header"><h4 class="text-center call-header">{{ __('Broadcast - ' .Auth::user()->counters->counter_name.
                       ' - ' . Auth::user()->counters->services->name)  }}</h4></div>
                        <input type="hidden" id="counter_id" value="{{Auth::user()->counters->counter_name}}">
                    <div class="card-body" >
                        <form method="POST" action="{{ route('login') }}" wire:poll.3000ms>
                            @csrf
    
                            <div class="form-group row">
                                <label for="email" class="col-md-6 col-form-label text-info text-md-center call-label">{{ __('Waiting') }}</label>
    
                                <label for="email" class="col-md-6 col-form-label text-md-center text-success call-label">{{ __('Served') }}</label>
    
                                
                            </div>
    
                            <div class="form-group row">
                                <label for="total_waiting" class="col-md-6 col-form-label text-xl-center text-info"><h1 class="call-number-label" >{{ $queues->count() }}</h1></label>
    
                                <label for="total_served" class="col-md-6 col-form-label text-xl-center text-success"><h1 class="call-number-label">{{ $queueServed->count() }}</h1></label>
    
                                
                            </div>
    
                            <div class="form-group row">
                                <label for="password" class="col-md-12 col-form-label text-md-center"><h1>{{ __('NOW SERVING') }}</h1></label>
                                <label for="ticket_number" class="col-md-12 col-form-label text-md-center text-info "><h1 class="ticket-label" id="number">
                                    @if ($firstqueue)
                                    
                                    <input type="hidden" id="ticket_number"  value="{{ Auth::user()->counters->services->prefix.'-'. $firstqueue->ticket_number }}">

                                   @endif
                                    @if($queue)
                                    {{ Auth::user()->counters->services->prefix.'-'. $lastcall->ticket_number }}
                                    <input type="hidden" id="prev_ticket_number"  value="{{ Auth::user()->counters->services->prefix.'-'. $lastcall->ticket_number }}">
                                    <input type="hidden" name="queue_id" value="{{$lastcall->queue_id }}">

                                    @else 
                                    0
                                    @endif
                                </h1></label>
                                <label for="password" class="col-md-12 col-form-label text-md-center text-warning">
                                <h3>
                                    @if ($calls)
                                        {{$calls->count()}}
                                    @endif
                                call(s) attempt.
                                </h3></label>
                        
                                   
                            </div>
    
                            <div class="form-group row">
                                <div class="col-md-6 text-center">
                                    @if ($queue)
                                    <a wire:click="callAgain()" onclick="replaySound();" class="btn btn-warning call-btn" href="#">CALL AGAIN</a>
                                        
                                    @endif
                                  
                                </div>
                                <audio id="audio" src="{{ asset("storage/sounds/ding.mp3")}}" autoplay="0" ></audio>
                                <div class="col-md-6 text-center">
                                    @if ($queues)

                                    <button id="callBtn"  onclick="playSound();" wire:click.prevent="call()"  class="btn btn-primary call-btn text-white">Call Next</button>

                                    @endif
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