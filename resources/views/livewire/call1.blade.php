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

            <div class="card">
                <div class="card-header"><h4 class="text-center call-header">{{ __('Broadcast - ' .Auth::user()->counters->counter_name.
                   ' - ' . Auth::user()->counters->services->name)  }}</h4></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-6 col-form-label text-info text-md-center call-label">{{ __('Waiting') }}</label>

                            <label for="email" class="col-md-6 col-form-label text-md-center text-success call-label">{{ __('Served') }}</label>

                            
                        </div>

                        <div class="form-group row">
                            <label for="total_waiting" class="col-md-6 col-form-label text-xl-center text-info"><h1 class="call-number-label">{{ $queues->count() }}</h1></label>

                            <label for="total_served" class="col-md-6 col-form-label text-xl-center text-success"><h1 class="call-number-label">{{ $queueServed->count() }}</h1></label>

                            
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-12 col-form-label text-md-center"><h1>{{ __('NOW SERVING') }}</h1></label>
                            <label for="ticket_number" class="col-md-12 col-form-label text-md-center text-info "><h1 class="ticket-label">
                          {{-- @if ($queues->count() > 0)
                              {{ Auth::user()->counters->services->prefix.'-'. $queue->ticket_number }}
                              @else
                              0
                           @endif --}}
                         
0
                                  
                                
                            </h1></label>
                            <label for="password" class="col-md-12 col-form-label text-md-center text-warning"><h3>{{ __('3 TIME(s)') }}</h3></label>

                               
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 text-center">
                                <a type="submit" class="btn btn-warning call-btn" href="#">CALL AGAIN</a>
                              
                            </div>
                            <div class="col-md-6 text-center">
                                <a wire:click="call()" class="btn btn-primary call-btn" href="#">NEXT CALL</a>
                            </div>
                        </div>

                       
                    </form>
                </div>
            </div>



