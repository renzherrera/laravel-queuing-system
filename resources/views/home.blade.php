@extends('layouts.app')

@section('content')
<style>
    .font-number{
        font-size: 34px;
    }

    .sub-label{
        font-size: 20px;
    }
</style>
<div class="c-body">
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <div class="row">
                    <div class="col-sm-6 col-lg-4">
                        <div class="card text-white bg-info">
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

                            <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                <canvas class="chart chartjs-render-monitor" id="card-chart1" height="70" style="display: block; width: 202px; height: 70px;" width="202"></canvas>
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
                            <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
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
                            <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                <canvas class="chart chartjs-render-monitor" id="card-chart4" height="70" width="202" style="display: block; width: 202px; height: 70px;"></canvas>
                            </div>
                        </div>
                    </div>
    
        </div>
 













        <div class="card">
            <div class="card-body">
            <div class="d-flex justify-content-between">
            <div>
            <h4 class="card-title mb-0">Traffic</h4>
            <div class="small text-muted">September 2019</div>
            </div>
            <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
            <div class="btn-group btn-group-toggle mx-3" data-toggle="buttons">
            <label class="btn btn-outline-secondary">
            <input id="option1" type="radio" name="options" autocomplete="off"> Day
            </label>
            <label class="btn btn-outline-secondary active">
            <input id="option2" type="radio" name="options" autocomplete="off" checked=""> Month
            </label>
            <label class="btn btn-outline-secondary">
            <input id="option3" type="radio" name="options" autocomplete="off"> Year
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
            <div class="c-chart-wrapper" style="height:400px; margin:20px">
                <canvas id="myChart" height="400px" ></canvas>

            </div>
            </div>
            




        </div>
        </div>
        </div>
        



<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js" integrity="sha512-VCHVc5miKoln972iJPvkQrUYYq7XpxXzvqNfiul1H4aZDwGBGC0lq373KNleaB2LpnC2a/iNfE5zoRYmB4TRDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
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
            borderWidth: 2
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
            borderWidth: 2
        },
    ]
    },
    
    options: {
        scales: {
            y: {
                    beginAtZero: true

            }
        }
    }
});
</script>

 {{-- 
//     </main>
//     <footer class="c-footer">
//     <div><a href="https://coreui.io">CoreUI</a> © 2020 creativeLabs.</div>
//     <div class="ml-auto">Powered by&nbsp;<a href="https://coreui.io/">CoreUI</a></div>
//     </footer>
//     </div> --}}
@endsection
