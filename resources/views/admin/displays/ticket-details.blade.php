@extends('layouts.display')

@section('content')
<style>
  
  .btn-queue{
      font-size: 35px;
      padding: 10px 55px;
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
        font-size: 55px;
        font-weight: 100;
    }
    .more-details{
        align-items: center;
        width: 50%;
        position: relative;
        left: 38%;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 25px;
    }
  
  .sweet-alert{
    padding: 0 !important;
  }
   </style>

        <div id="print" class="card">
                <div class="card-body">
                  
                        <div class="container text-center">
                           @php
                               $minutes = 250;
                                $zero    = new DateTime('@0');
                                $offset  = new DateTime('@' . $minutes * 60);
                                $diff    = $zero->diff($offset);
                                // echo $diff->format('%a Days, %h Hours, %i Minutes');
                           @endphp
                            <div class="print-div">
                                <h2 class="title">TICKET #</h2>
                            <h1 style="margin-top: -90px;" class="ticket-number" >
                            <form action="{{route('admin.displays.store',$service)}}" method="POST">
                                 @csrf
                                 <input value="{{$service->id}}" type="hidden" name="id">
                                 <input value="{{$service->default_number}}" type="hidden" name="default_number">
                                <br>{{$service->prefix }} - {{ $queue->ticket_number + 1}}</h1> <br> 
                                <div class="text-left more-details">
                                    <h3>Time Created: {{now()->format('g:i:s a')}}</h3>
                                    <h3>Type: {{$service->name}}</h3>
                                    <h3>On queued: {{$waitingQueue->count()}}</h3>
                                    {{-- <h3>Estimated waiting time:  {{$diff->format('%h Hours, %i Minutes')}}</h3> --}}

                                </div>
                                
                                <button type="submit" class="btn btn-queue btn-info mb-2 mt-5 text-white" onclick="printing()" >GET TICKET</button>
                        </form>
                             </div>  

                        </div>

                </div>
        </div>

</div>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

function printing() {
  
    window.print();

    Swal.fire({

    title: 'Printing',
    html: '<h1 class="bg-success">Ticket # {{$queue->ticket_number + 1}}</h1> <br> <h2>Time created: {{now()->format('g:i:s a')}}</h2>',    
    imageUrl: '{{ asset('storage/images/printing.gif')}}',
    imageAlt: 'Printer GIF',
    showConfirmButton: false,
    allowOutsideClick: false,
})

}

</script>
@endsection
