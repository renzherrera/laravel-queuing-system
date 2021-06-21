@extends('layouts.app')

@section('content')
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"> </script>

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/0.2.0/Chart.min.js" type="text/javascript"></script> --}}

{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> --}}
{{-- <div class="c-body">
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <div class="row">
                    <div class="col-sm-6 col-lg-3">
                        <div class="card text-white bg-info">
                            <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="text-value-lg">9.823</div>
                                    <div>Total Served</div>
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
    
                    <div class="col-sm-6 col-lg-3">
                        <div class="card text-white bg-primary">
                            <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="text-value-lg">23</div>
                                    <div>Today Queued</div>
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
    
                    <div class="col-sm-6 col-lg-3">
                        <div class="card text-white bg-warning">
                            <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="text-value-lg">12</div>
                                    <div>Today Served</div>
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
                            <div class="c-chart-wrapper mt-3" style="height:70px;"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                <canvas class="chart chartjs-render-monitor" id="card-chart3" height="70" width="234" style="display: block; width: 234px; height: 70px;"></canvas>
                            </div>
                        </div>
                    </div>
    

                    <div class="col-sm-6 col-lg-3">
                        <div class="card text-white bg-danger">
                            <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="text-value-lg">3</div>
                                    <div>Today Missed</div>
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
 
        
        <div style="height:300px;margin-top:40px;">
        <canvas  id="barChart" height="300"></canvas>
        </div>
        
        </div>
        </div>
        </div> --}}
        
{{-- chart js  --}}
{{-- <script src="https://coreui.io/demo/free/3.4.0/vendors/@coreui/chartjs/js/coreui-chartjs.bundle.js"></script>
<script src="https://coreui.io/demo/free/3.4.0/vendors/@coreui/utils/js/coreui-utils.js"></script> --}}
{{-- <script>
Chart.defaults.global.pointHitDetectionRadius=1;Chart.defaults.global.tooltips.enabled=false;Chart.defaults.global.tooltips.mode='index';Chart.defaults.global.tooltips.position='nearest';Chart.defaults.global.tooltips.custom=coreui.ChartJS.customTooltips;Chart.defaults.global.defaultFontColor='#646470';Chart.defaults.global.responsiveAnimationDuration=1;document.body.addEventListener('classtoggle',function(event){if(event.detail.className==='c-dark-theme'){if(document.body.classList.contains('c-dark-theme')){cardChart1.data.datasets[0].pointBackgroundColor=coreui.Utils.getStyle('--primary-dark-theme');cardChart2.data.datasets[0].pointBackgroundColor=coreui.Utils.getStyle('--info-dark-theme');Chart.defaults.global.defaultFontColor='#fff';}else{cardChart1.data.datasets[0].pointBackgroundColor=coreui.Utils.getStyle('--primary');cardChart2.data.datasets[0].pointBackgroundColor=coreui.Utils.getStyle('--info');Chart.defaults.global.defaultFontColor='#646470';}
cardChart1.update();cardChart2.update();mainChart.update();}});var cardChart1=new Chart(document.getElementById('card-chart1'),{type:'line',data:{labels:['January','February','March','April','May','June','July'],datasets:[{label:'My First dataset',backgroundColor:'transparent',borderColor:'rgba(255,255,255,.55)',pointBackgroundColor:coreui.Utils.getStyle('--primary'),data:[65,59,84,84,51,55,40]}]},options:{maintainAspectRatio:false,legend:{display:false},scales:{xAxes:[{gridLines:{color:'transparent',zeroLineColor:'transparent'},ticks:{fontSize:2,fontColor:'transparent'}}],yAxes:[{display:false,ticks:{display:false,min:35,max:89}}]},elements:{line:{borderWidth:1},point:{radius:4,hitRadius:10,hoverRadius:4}}}});var cardChart2=new Chart(document.getElementById('card-chart2'),{type:'line',data:{labels:['January','February','March','April','May','June','July'],datasets:[{label:'My First dataset',backgroundColor:'transparent',borderColor:'rgba(255,255,255,.55)',pointBackgroundColor:coreui.Utils.getStyle('--info'),data:[1,18,9,17,34,22,11]}]},options:{maintainAspectRatio:false,legend:{display:false},scales:{xAxes:[{gridLines:{color:'transparent',zeroLineColor:'transparent'},ticks:{fontSize:2,fontColor:'transparent'}}],yAxes:[{display:false,ticks:{display:false,min:-4,max:39}}]},elements:{line:{tension:0.00001,borderWidth:1},point:{radius:4,hitRadius:10,hoverRadius:4}}}});var cardChart3=new Chart(document.getElementById('card-chart3'),{type:'line',data:{labels:['January','February','March','April','May','June','July'],datasets:[{label:'My First dataset',backgroundColor:'rgba(255,255,255,.2)',borderColor:'rgba(255,255,255,.55)',data:[78,81,80,45,34,12,40]}]},options:{maintainAspectRatio:false,legend:{display:false},scales:{xAxes:[{display:false}],yAxes:[{display:false}]},elements:{line:{borderWidth:2},point:{radius:0,hitRadius:10,hoverRadius:4}}}});var cardChart4=new Chart(document.getElementById('card-chart4'),{type:'bar',data:{labels:['January','February','March','April','May','June','July','August','September','October','November','December','January','February','March','April'],datasets:[{label:'My First dataset',backgroundColor:'rgba(255,255,255,.2)',borderColor:'rgba(255,255,255,.55)',data:[78,81,80,45,34,12,40,85,65,23,12,98,34,84,67,82],barPercentage:0.6}]},options:{maintainAspectRatio:false,legend:{display:false},scales:{xAxes:[{display:false}],yAxes:[{display:false}]}}});var mainChart=new Chart(document.getElementById('main-chart'),{type:'line',data:{labels:['M','T','W','T','F','S','S','M','T','W','T','F','S','S','M','T','W','T','F','S','S','M','T','W','T','F','S','S'],datasets:[{label:'My First dataset',backgroundColor:coreui.Utils.hexToRgba(coreui.Utils.getStyle('--info'),10),borderColor:coreui.Utils.getStyle('--info'),pointHoverBackgroundColor:'#fff',borderWidth:2,data:[165,180,70,69,77,57,125,165,172,91,173,138,155,89,50,161,65,163,160,103,114,185,125,196,183,64,137,95,112,175]},{label:'My Second dataset',backgroundColor:'transparent',borderColor:coreui.Utils.getStyle('--success'),pointHoverBackgroundColor:'#fff',borderWidth:2,data:[92,97,80,100,86,97,83,98,87,98,93,83,87,98,96,84,91,97,88,86,94,86,95,91,98,91,92,80,83,82]},{label:'My Third dataset',backgroundColor:'transparent',borderColor:coreui.Utils.getStyle('--danger'),pointHoverBackgroundColor:'#fff',borderWidth:1,borderDash:[8,5],data:[65,65,65,65,65,65,65,65,65,65,65,65,65,65,65,65,65,65,65,65,65,65,65,65,65,65,65,65,65,65]}]},options:{maintainAspectRatio:false,legend:{display:false},scales:{xAxes:[{gridLines:{drawOnChartArea:false}}],yAxes:[{ticks:{beginAtZero:true,maxTicksLimit:5,stepSize:Math.ceil(250/5),max:250}}]},elements:{point:{radius:0,hitRadius:10,hoverRadius:4,hoverBorderWidth:3}}}});

</script> --}}
<div style="height: 400px; width:900px; margin:auto;">
    <canvas id="barChart"></canvas>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js" type="text/javascript"></script>

<script>
    $(function(){

        var datas =  {{json_encode($datas)}};
        var barCanvas = $("#barChart");
        var barChart = new Chart(barCanvas,{
            type:'bar',
            data:{
                labels:['Jan','Feb','Mar','Apr','May','Jun','July','Aug','Sept','Oct','Nov','Dec'],
                datasets:[
                    {
                        label: 'New User Growth, 2020',
                        data: datas,
                        backgroundColor:['red','orange','yellow','green','blue','violet','purple','pink','silver','gold','brown']
                    }
                ]
            },
            options:{
                scales:{
                    yAxis:[
                        {
                            ticks:{
                                beginAtZero:true
                            }
                        }]
                }
            }
            
        });

    })
</script>
  <!-- Charting library -->
  
{{-- <script src="https://unpkg.com/chart.js@2.9.3/dist/Chart.min.js"></script> --}}
<!-- Chartisan -->
  <!-- Your application script -->
  



    </main>
    <footer class="c-footer">
    <div><a href="https://coreui.io">CoreUI</a> © 2020 creativeLabs.</div>
    <div class="ml-auto">Powered by&nbsp;<a href="https://coreui.io/">CoreUI</a></div>
    </footer>
    </div>
@endsection
