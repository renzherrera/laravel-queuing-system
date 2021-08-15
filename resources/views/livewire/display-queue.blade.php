
<div class="row h-100">
    <style>
        .top-1{
            z-index: 8;
            width: 100vw;

        }
        .th-queue{
            font-size: 45px;
            text-align: center;
        }
        .tr-queue{
            font-size: 60px;
            font-weight: bold;
            text-align: center;
        }
        .queue-container{
            height: 100vh;
            margin: 0 !important;
            padding: 0 !important;
        }
        .no-margin-padding{
            margin: 0 !important; 
            padding: 0!important;
        }
        .full-height{
            height: 100vh;
        }
        .h-100{
            height: 100%;
        }
        .video{
            position: relative;;
            top: 50%;
            left: 0;
            z-index: 0;
        }
        /* .logo{
            height: 100px;
            position: absolute;
            left: 20%;
            top: 0.5%;
        } */
        .sub-data {
            font-size: 25px;
            margin-top: -15px;
            font-weight: 100;
        }
     
    </style>
    
    <div class="col-md-4 h-100 no-margin-padding top-1 "  >
            <div class="card queue-container" style="overflow:hidden;" >
                <img style="position: absolute; left: -680px; height:100vh; opacity:1; z-index:2 " src="{{asset('images/sanfernando.jpg')}}" alt="">
                <div class="bg-primary" style="z-index: 3; height:100vh; width:100vw; position: absolute; opacity:0.9"></div>
                <div class=" text-white " style="z-index:4" wire:poll.1000ms><i class="fa fa-align-justify"></i> <h1 class=" text-center tr-queue">NOW SERVING</h1>
                        <div class="card-body "  style="height:100vh;">
                            <table id="queue-table" style="z-index: 4;" class="table table-responsive-sm table-bordered text-white ">
                                <thead class="th-queue ">
                                    <tr>
                                        <th style="width: 170px">Counter</th>
                                        <th>Ticket #</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                    @foreach ($counters as $item)
                                    <tr class="tr-queue  text-primary bg-white">
                                        <td class="">
                                            {{$item->counters->counter_number}}
                                            {{$item->served}}
                                        </td>
                                    @if ($item->served == null && $item->missed == null)
                                        
                                        @if ($item->counters->status == "active")
                                        <td  class=""  style="margin: 0!important;" ><span style="font-weight: 800"   id="ticket_number" >{{$item->counters->services->prefix.' - '. $item->ticketNumber}}</span>
                                        </td>
                                        @else
                                        <td width="min-width: 300px" height="100px"><span style="font-weight: 800"   id="ticket_number" >--</span></td>

                                        @endif
                                    @else
                                    <td style="min-width: 300px" height="100px"><span style="font-weight: 800"   id="ticket_number" >--</span></td>
                                    @endif
                                    </tr>  
                                    @endforeach
                                 
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

    </div>
    <div class="col-md-8 no-margin-padding video bg-white" >
        <div class="row"  style="height: 110px">
            <div class="text-center d-flex" style="margin:auto">
                <img class="logo" style="width:120px; z-index:9999" src="{{ asset("storage/logo/" . settings('logo'))}}" alt="">
                <h1 class=" mt-3">{{settings('system_name')}}</h1>
                {{-- <h4 class="ml-5 mb-3">Municipality</h4> --}}
            </div>
          
        </div>
       
        <video class="" autoplay loop muted >
            <source src="{{ asset("storage/video/" . settings('video'))}}" type="video/mp4" />
        </video>
        <div class="text-center ">
            <div class="align-items-center">
                <div>
                    <h1 class="tr-queue mt-3">{{ now()->format('h:i:s A')}}</h1>
                    <h2 >{{ now()->format('l F d, Y')}}</h2>

                </div>

            </div>
        </div>
    </div>


</div>
<script>
  $('#ticket_number').on("DOMSubtreeModified", function(){
    // $('#ticket_number').fadeOut(500).fadeIn(500, blink);
     var timeRun = 0;
     var interval = setInterval(function()  
        {
            timeRun += 1;
            

            myVar =  setTimeout(function()
                {

                $("#ticket_number").css("color","rgba(255,0,0,0.1)"); // If you want simply black/white blink of text
                $("#ticket_number").css("visibility","hidden"); // This is for Visibility of the element  

                },900);

                $("#ticket_number").css("color","rgba(255,0,0,1)");  // If you want simply black/white blink of text
                $("#ticket_number").css("visibility","visible");  // This is for Visibility of the element
                if(timeRun ==10){
                clearInterval(interval);
                 }
                },1000);
  });
  
</script>










