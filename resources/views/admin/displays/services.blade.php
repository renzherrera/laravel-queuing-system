@extends('layouts.display')

@section('content')
<style>
    /* .btn-queue{
        padding: 50px !important;
        font-size: 25px;
        width: 25%;
    } */
   
    .btn-title{
        text-align: center
    }

    .print-div{
        width: 100%;
        text-align: center;
        color: rgb(0, 0, 0);
    }

    .ticket-number{
        font-size: 70px;
        font-weight: bold;
    }
    .title{
        font-size: 55px;
        font-weight: 100;
    }
  
  .sweet-alert{
    padding: 0 !important;
  }
   </style>

        <div id="noprint" class="card card-accent-info">
            <div class="card-header text-center"><h1 class="p-4">{{ __('Choose service') }}</h1></div>
                <div class="card-body p-5">
                  
                        <div class="container-fluid text-center ">
                            @foreach ($services as $service)
                            @if ($service->is_active)
                            <form action="{{route('admin.displays.ticket',$service)}}" method="POST">
                                @csrf
                                <input value="{{$service->id}}" type="hidden" name="id">
                                <input value="{{$service->default_number}}" type="hidden" name="default_number">
                            <button class="btn btn-queue btn-info mb-1 ml-1 text-uppercase" type="submit" onclick="printing()">{{$service->name}}</a>
                            </form>
                            @endif
                            @endforeach
                            

                        </div>
                </div>
        </div>

        {{-- <div id="print" class="card" style="display: none">
                <div class="card-body">
                  
                        <div class="container text-center">
                           
                            <div class="print-div">
                                <h2 class="title">TICKET #</h2>
                            <h1 style="margin-top: -90px;" class="ticket-number" >
                                <br>{{$service->prefix }} - {{ $ticketNumber + 1}}</h1> <br> 
                                    <h3>Time Created: {{now()->format('g:i:s a')}}</h3>
                                    <h3>Service: {{$service->name}}</h3>
            
                        </div>  

                        </div>
                </div>
        </div> --}}

</div>


@endsection
