
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
        .logo{
            height: 100px;
            position: absolute;
            left: 20%;
            top: 0.5%;
        }
        .sub-data {
            font-size: 25px;
            margin-top: -15px;
            font-weight: 100;
        }
     
      
    </style>
    <div class="col-md-4 h-100 no-margin-padding top-1 ">
      
            <div class="card queue-container">
                <div class="card-header bg-info text-white" wire:poll.1000ms><i class="fa fa-align-justify"></i> <h1 class=" text-center tr-queue">NOW SERVING</h1></div>
                        <div class="card-body bg-info ">
                            <table id="queue-table" class="table table-responsive-sm table-bordered text-white ">
                                <thead class="th-queue">
                                    <tr>
                                        <th>Counter #</th>
                                        <th>Ticket #</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($calls as $item)
                                    <tr class="tr-queue">
                                        <td>
                                            {{$item[0]->counter_id}}

                                            <h2 class="sub-data">({{$item[0]->name}})</h2>
                                        </td>
                                        <td id="ticket_number" class="" >{{$item[0]->prefix . '-' . $item[0]->ticket_number}}</td>
                                    </tr>  
                                    @endforeach
                                 
                                </tbody>
                            </table>
                        </div>
                </div>

    </div>
    <div class="col-md-8 no-margin-padding video bg-white" >
        <div class="text-center ">
            <img class="logo" src="{{ asset("storage/images/sf-logo.png")}}" alt="">
            <h1 class="ml-5 mt-3">San Fernando City, Pampanga</h1>
            <h4 class="ml-5 mb-3">Municipality</h4>
          
        </div>
      
        <video class="" autoplay loop muted >
            <source src="{{ asset("storage/videos/video.mp4")}}" type="video/mp4" />
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











