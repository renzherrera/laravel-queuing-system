@extends('layouts.app')

@section('content')
<style>
    .font-number{
        font-size: 34px;
    }

    .sub-label{
        font-size: 20px;
    }
    .page-title{
        margin-top: -40px;
        margin-bottom: 10px;
    }
</style>
<div class="c-body">
    <main class="c-main">
        <div class="container-fluid">
            <h2 class="page-title">Dashboard</h2>
            <div class="fade-in">
                <div class="row ">
                    <div class="col-6 col-lg-3">
                        <div class="card overflow-hidden">
                        <div class="card-body p-0 d-flex align-items-center">
                        <div class="bg-danger py-4 px-5 mfe-3">
                        <svg class="c-icon c-icon-xl">
                        <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-institution')}}"></use>
                        </svg>
                        </div>
                        <div>
                        <div class="text-value text-info">{{$departmentsCount}}</div>
                        <div class="text-muted text-uppercase font-weight-bold small">Departments</div>
                        </div>
                        </div>
                        </div>
                    </div>

                    <div class="col-6 col-lg-3">
                        <div class="card overflow-hidden">
                        <div class="card-body p-0 d-flex align-items-center">
                        <div class="bg-warning py-4 px-5 mfe-3">
                        <svg class="c-icon c-icon-xl">
                        <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-group')}}"></use>
                        </svg>
                        </div>
                        <div>
                        <div class="text-value text-info">{{$usersCount}}</div>
                        <div class="text-muted text-uppercase font-weight-bold small">Users</div>
                        </div>
                        </div>
                        </div>
                    </div>

                    <div class="col-6 col-lg-3">
                        <div class="card overflow-hidden">
                        <div class="card-body p-0 d-flex align-items-center">
                        <div class="bg-success py-4 px-5 mfe-3">
                        <svg class="c-icon c-icon-xl">
                        <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-truck')}}"></use>
                        </svg>
                        </div>
                        <div>
                        <div class="text-value text-info">{{$servicesCount}}</div>
                        <div class="text-muted text-uppercase font-weight-bold small">Services</div>
                        </div>
                        </div>
                        </div>
                    </div>

                    <div class="col-6 col-lg-3">
                        <div class="card overflow-hidden">
                        <div class="card-body p-0 d-flex align-items-center">
                        <div class="bg-info py-4 px-5 mfe-3">
                        <svg class="c-icon c-icon-xl">
                        <use xlink:href="{{asset('vendors/@coreui/icons/svg/free.svg#cil-window')}}"></use>
                        </svg>
                        </div>
                        <div>
                        <div class="text-value text-info">{{$countersCount}}</div>
                        <div class="text-muted text-uppercase font-weight-bold small">Counters</div>
                        </div>
                        </div>
                        </div>
                    </div>

                   
                  
    
                  </div><!--/.row-->
                <div class="row">

                    <div class="col-sm-6 col-lg-4">
                        <div class="card text-white bg-info  ">
                            <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="text-value-lg font-number">{{$todayQueuesCount}}</div>
                                    <div class="sub-label">No. of Queued Today</div>
                                </div>
                            <div class="btn-group">
                                <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <svg class="c-icon">
                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
                                    </svg>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                            </div>
                            </div>

                            <div class="c-chart-wrapper pb-3 px-3" style="height:70px;"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                <canvas class="chart chartjs-render-monitor " id="card-chart1" height="70" style=" width: 60vh; height: 70vh;" ></canvas>
                            </div>
                        </div>
                    </div>
    
                    <div class="col-sm-6 col-lg-4">
                        <div class="card text-white bg-primary">
                            <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="text-value-lg font-number">{{$todayServedCount}}</div>
                                    <div class="sub-label">No. of Served Today</div>
                                </div>
                                <div class="btn-group">
                                    <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg class="c-icon">
                                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
                                        </svg>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                                </div>
                            </div>
                            <div class="c-chart-wrapper pb-3 mx-3 " style="height:70px;"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                <canvas class="chart chartjs-render-monitor" id="card-chart2" height="70" width="202" style="display: block; width: 202px; height: 70px;"></canvas>
                            </div>
                        </div>
                    </div>
    
                    
                    



                    <div class="col-sm-6 col-lg-4">
                        <div class="card text-white bg-danger">
                            <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="text-value-lg font-number">{{$todayMissedCount}}</div>
                                    <div class="sub-label">No. of Missed Today</div>
                                </div>
                                <div class="btn-group">
                                    <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg class="c-icon">
                                             <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
                                        </svg>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                                </div>
                            </div>
                            <div class="c-chart-wrapper pb-3 mx-3" style="height:70px;"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                <canvas class="chart chartjs-render-monitor" id="card-chart3" height="70" width="202" style="display: block; width: 202px; height: 70px;"></canvas>
                            </div>
                        </div>
                    </div>
    
        </div>
 













        <div class="card">
            <div class="card-body">
            <div class="d-flex justify-content-between">
            <div>
            <h4 class="card-title mb-0">Queues</h4>
            {{-- <div class="small text-muted">September 2019</div> --}}
         
            </div>

           

            <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
            <div class="btn-group btn-group-toggle mx-3" data-toggle="buttons">
            <label class="btn btn-outline-secondary">
            <input id="line" type="radio" name="options" autocomplete="off" onchange="changeline();"> Day
            </label>
            <label class="btn btn-outline-secondary active">
            <input id="bar" type="radio" name="options" autocomplete="off" onchange="changebar();" checked=""> Month
            </label>
            <label class="btn btn-outline-secondary">
            <input id="option3" type="radio" name="options" autocomplete="off" onchange="dayChart()"> Year
            </label>


            </div>
            
           
            <button class="btn btn-primary" type="button">
            <svg class="c-icon">
            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-cloud-download"></use>
            </svg>
            </button>
            </div>
            </div>


            {{-- //CHART  --}}
            <div class="c-chart-wrapper" style="height:400px; margin:20px position: relative; height:40vh; width:80vw">
                <canvas id="myChart" height="400px" ></canvas>

            </div>

           


            </div>
            




        </div>
        </div>
        </div>
        

 <script src="https://coreui.io/demo/free/3.4.0/vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js" integrity="sha512-VCHVc5miKoln972iJPvkQrUYYq7XpxXzvqNfiul1H4aZDwGBGC0lq373KNleaB2LpnC2a/iNfE5zoRYmB4TRDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>

    const line = document.getElementById('line');
    const bar = document.getElementById('bar');

    line.addEventListener('click', changeline);
    bar.addEventListener('click', changebar);
var datas =  <?php echo json_encode($queueArr)?>;
var servedData =  <?php echo json_encode($servedArr)?>;
var missedData =  <?php echo json_encode($missedArr)?>;
var ctx = document.getElementById('myChart');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels:['Jan','Feb','Mar','Apr','May','Jun','July','Aug','Sept','Oct','Nov','Dec'],

        datasets: [{
            label: 'Total Queued',
            data: datas,
            backgroundColor: [
                'rgba(153, 102, 255, 0.2)',
       
            ],
            borderColor: [
                'rgba(153, 102, 255, 1)',
         
            ],
            borderWidth: 2,
            tension: 0.5,

            
        },
        {
            label: 'Total Served',
            data: servedData,
            backgroundColor: [
                'rgba(54, 162, 235, 0.2)',
       
            ],
            borderColor: [
                'rgba(54, 162, 235, 1)',
         
            ],
            borderWidth: 2,
            tension: 0.5,

        },
        {
            label: 'Total Missed',
            data: missedData,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',

       
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',

         
            ],
            borderWidth: 2,
            tension: 0.5,

        },
    ]
    },
    
    options: {
       
        maintainAspectRatio: false,
        responsive: true,
        scales: {
            y: {
                    beginAtZero: true

            }
        }
        
    }
});

    function changeline() {
        const updatetype ='line';
        myChart.config.type = updatetype;
        myChart.update();
    }  
    function changebar() {
        const updatetype ='bar';
        myChart.config.type = updatetype;
        myChart.update();
    }

    function dayChart(){
    };




</script>


<script>

var WeekQueue = {{json_encode($weekArr)}};
var ctx = document.getElementById('card-chart1');


var cardChart = new Chart(ctx, {
    
    plugins: {
    datalabels: {
        display: false,
    },
},
    type: 'line',
    data: {
        labels:['Sun','Mon','Tue','Wed','Thur','Fri','Sat'],


        datasets: [{
            data: WeekQueue,
            backgroundColor: [
                'rgba(255, 255, 255, 0.2)',
       
            ],
            borderColor: [
                'rgba(255, 255, 255, 1)',
         
            ],
            borderWidth: 1,
            tension: 0.1,
            
        }
    ]
    },
   
    options: {
        plugins:{   
             legend: {
               display: false
                     },
             },
        maintainAspectRatio: false,
        responsive: true,
        scales: {
            y: {
                    beginAtZero: true,
                    display:false

            } ,
            x: {
                    display:false,

            }
        }
        
    }
});



<!-- TODAY SERVED -->




var WeekServed = {{json_encode($weekServedArr)}};
var ctx = document.getElementById('card-chart2');


var cardChart = new Chart(ctx, {
    
    plugins: {
    datalabels: {
        display: false,
    },
},
    type: 'line',
    data: {
        labels:['Sun','Mon','Tue','Wed','Thur','Fri','Sat'],

        datasets: [{
            data: WeekServed,
            backgroundColor: [
                'rgba(255, 255, 255, 0.2)',
       
            ],
            borderColor: [
                'rgba(255, 255, 255, 1)',
         
            ],
            borderWidth: 1,
            tension: 0.1,
            
        }
    ]
    },
   
    options: {
        plugins:{   
             legend: {
               display: false
                     },
             },
        maintainAspectRatio: false,
        responsive: true,
        scales: {
            y: {
                    beginAtZero: true,
                    display:false

            } ,
            x: {
                    display:false,

            }
        }
        
    }
});







<!-- TODAY MISSED -->




var WeekMissed = {{json_encode($weekMissedArr)}};
var ctx = document.getElementById('card-chart3');


var cardChart = new Chart(ctx, {
    
    plugins: {
    datalabels: {
        display: false,
    },
},
    type: 'line',
    data: {
        labels:['Sun','Mon','Tue','Wed','Thur','Fri','Sat'],


        datasets: [{
            data: WeekMissed,
            backgroundColor: [
                'rgba(255, 255, 255, 0.2)',
       
            ],
            borderColor: [
                'rgba(255, 255, 255, 1)',
         
            ],
            borderWidth: 1,
            tension: 0.1,
            
        }
    ]
    },
   
    options: {
        plugins:{   
             legend: {
               display: false
                     },
             },
        maintainAspectRatio: false,
        responsive: true,
        scales: {
            y: {
                    beginAtZero: true,
                    display:false

            } ,
            x: {
                    display:false,

            }
        }
        
    }
});


</script>
    </main>

    
@endsection
